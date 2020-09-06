<?php

namespace App\Http\Controllers;

use App\Secret;
use App\SecretImage;
use App\TransactionStatus;
use App\TransactionType;
use App\User;
use App\UserBalance;
use App\UserTransaction;
use App\UserUnlockSecret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SecretController extends Controller
{
    public function getUserUnlockedSecrets(Request $request)
    {
        return response()->json(['error' => false, 'data' => UserUnlockSecret::whereUserId(Auth::id())->get()]);
    }

    public function getPaginatedSecrets(Request $request)
    {
        $secrets = Secret::with('author')->orderBy('created_at', 'desc')->paginate($request->numOfItems);
        return response()->json(['error' => false, 'data' => $secrets]);
    }

    public function getAllSecrets()
    {
        $secrets = Secret::orderBy('created_at', 'desc')->get('id', 'title');
        return response()->json(['error' => false, 'data' => $secrets]);
    }

    public function createSecret(Request $request)
    {
        $user = Auth::user();
        $title = $request->title;
        $description = $request->description;
        $body = $request->body;
        $images = $request->images;
        $price = $request->price;
        $isFree = $price == 0;


        $secret = Secret::create([
            'title' => $title,
            'description' => $description,
            'body' => $body,
            'user_id' => $user->id,
            'price' => $price,
            'is_free' => $isFree
        ]);

        if ($images !== null) {
            foreach ($images as $image) {
                $imagePath = Storage::disk('uploads')->put($user->email . '/secret/' . $secret->id, $image);
                SecretImage::create([
                    'secret_image_caption' => $title,
                    'secret_image_path' => '/uploads/' . $imagePath,
                    'secret_id' => $secret->id,
                ]);
            }
        }

        return response()->json(['error' => false, 'data' => $secret]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function unlockSecret(Request $request)
    {
        $secretId = $request->secret_id;
        try {
            $userUnlockSecret = $this->unlockSecretService(Auth::id(), $secretId);
        } catch (\Exception $e) {
            throw new \Exception('Unable to unlock secret!' . $e);
        }
        if ($userUnlockSecret !== null)
            return response()->json(['error' => false, 'data' => $userUnlockSecret, 'message' => 'success']);

        return response()->json(['error' => true, 'message' => 'Secret does not exist!']);
    }

    /**
     * @param int $userId
     * @param int $secretId
     * @return UserUnlockSecret|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    private function unlockSecretService(int $userId, int $secretId)
    {
        $secret = Secret::whereId($secretId)->first();
        error_log($secret);
        $secretPrice = $secret->price;
        $secretOwnedBy = $secret->author;
        $buyerBalance = UserBalance::where('user_id', '=', $userId)->first();
//        error_log('test  ' . $test);
//        $buyerBalance = UserBalance::where('user_id', '=', $userId)->firstOrCreate(['user_id' => $userId,
//            'balance' => 0,
//            'is_locked' => false,]);
        $sellerBalance = UserBalance::where('user_id', '=', $secretOwnedBy->id)->firstOrCreate(['user_id' => $secretOwnedBy->id,
            'balance' => 0,
            'is_locked' => false,]);;
        if ($secret !== null) {
            // perform transaction
            //error_log('balance' . $buyerBalance->balance . ' buyerbalance' . $buyerBalance);
            if ($secretPrice <= $buyerBalance->balance) {
                try {
                    $newBalance = $buyerBalance->balance - $secretPrice;
                    $buyerBalance->balance = $newBalance;
                    $newBalance = $sellerBalance->balance + $secretPrice;
                    $sellerBalance->balance = $newBalance;
                    $buyerBalance->save();
                    $sellerBalance->save();
                    $typeSellingSecret = TransactionType::where('type', 'Selling Secret')->first();
                    $typeBuyingSecret = TransactionType::where('type', 'Purchase Secret')->first();
                    $statusCompleted = TransactionStatus::where('status', 'completed')->first();
                    $referenceId = $secret->userId . '|' . $userId . '|' . $secret->id;
                    UserTransaction::create([
                        'to_user_id' => $userId,
                        'amount' => -$secretPrice,
                        'transaction_type' => $typeBuyingSecret->id,
                        'status' => $statusCompleted->id,
                        'reference_id' => $referenceId,
                    ]);
                    UserTransaction::create([
                        'to_user_id' => $secret->user_id,
                        'amount' => $secretPrice,
                        'transaction_type' => $typeSellingSecret->id,
                        'status' => $statusCompleted->id,
                        'reference_id' => $referenceId,
                    ]);
                    return UserUnlockSecret::firstOrCreate(
                        ['user_id' => $userId, 'secret_id' => $secretId,]);
                } catch (\Exception $e) {
                    //$this->rollBackUnlockSecretService($userId, $userId);
                    throw new \Exception('Transaction is not completed, rolling back..' . $e);
                }
            }
        }
        return null;
    }

    private function rollBackUnlockSecretService(int $userId, int $secretId)
    {
        $statusCancelled = TransactionStatus::whereStatus('cancelled');
        $secret = Secret::whereId($secretId)->get();
        $secretOwnedBy = $secret->user;
        $buyer = User::whereId($userId);
        $buyerBalance = $buyer->userBalance;
        $sellerBalance = $secretOwnedBy->userBalance;
        $userUnlockSecret = UserUnlockSecret::findUniquePair($secretId, $userId);
        $referenceId = $secret->userId . '|' . $userId . '|' . $secret->id;

        if ($userUnlockSecret !== null) {
            UserUnlockSecret::destroy($userUnlockSecret->id);
            UserTransaction::find($referenceId)->update(['status' => $statusCancelled]);
            $secretPrice = $secret->price;
            $newBalance = $buyerBalance->balance - $secretPrice;
            $buyerBalance->balance = $newBalance;
            $newBalance = $sellerBalance->balance + $secretPrice;
            $sellerBalance->balance = $newBalance;
            $buyerBalance->save();
            $sellerBalance->save();

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function show(Secret $secret)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function edit(Secret $secret)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secret $secret)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secret $secret)
    {
        //
    }
}
