<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UserSeeder::class);
       $this->call(ProductSeeder::class);
       $this->call(CategorySeeder::class);
       $this->call(DeliverierSeeder::class);
       $this->call(AttributeSeeder::class);
       $this->call(VariationSeeder::class);
       $this->call(CostumerSeeder::class);
       $this->call(ReceptionSeeder::class);
       $this->call(ReceptionDetailSeeder::class);
    }
}
