<?php

use Illuminate\Database\Seeder;

class ReceptionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory('App\ReceptionDetail',6)->create();
    }
}
