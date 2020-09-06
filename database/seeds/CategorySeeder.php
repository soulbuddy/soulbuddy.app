<?php


class CategorySeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $categories = \Illuminate\Support\Collection::make(['Love', 'Career', 'Mood', 'School', 'Friendship', 'Family', 'Others']);
        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'category' => $cat
            ]);
        }
    }
}
