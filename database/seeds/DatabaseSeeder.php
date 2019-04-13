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
         $this->call(UserTableSeeder::class);
         $this->call(TeamTableSeeder::class);         
         $this->call(PoolsTableSeeder::class);
         $this->call(ProviderTableSeeder::class);
         $this->call(LaboratoriesTableSeeder::class);
         $this->call(CategoryResourcesTableSeeder::class);
         $this->call(ResourcesTableSeeder::class);
         $this->call(PresentationResourcesTableSeeder::class);
    }
}
