<?php

use Illuminate\Database\Seeder;

class CategoryResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $categoryResource = array([ 
     	'name' => 'Medicina',
     	'parent_id' => '1',
     	'team_id' => '1'
     ],
     [
     	'name' => 'Alimento',
     	'parent_id' => '1',
     	'team_id' => '1'
     ],
     [
     	'name' => 'Suplemento',
     	'parent_id' => '1',
     	'team_id' => '1'
     ]);
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('category_resources')->insert($categoryResource);
    }
    
}
