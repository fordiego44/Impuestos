<?php

use Illuminate\Database\Seeder;

class DeliverierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Deliverier',5)->create();
    }
}
