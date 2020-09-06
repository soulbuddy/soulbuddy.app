<?php

use Illuminate\Database\Seeder;

class SecretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Secret::class, 100)->create();
    }
}
