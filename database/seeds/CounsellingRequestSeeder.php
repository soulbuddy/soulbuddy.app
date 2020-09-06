<?php

use Illuminate\Database\Seeder;

class CounsellingRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CounsellingRequest::class, 50)->create();
    }
}
