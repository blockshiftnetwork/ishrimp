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
     $categoryResource = array(
        [
            'name' => 'Balanceado',
            'parent_id' => '1'
        ],
        [ 
     	    'name' => 'Medicina',
     	    'parent_id' => '1'
        ],
        [
     	    'name' => 'Suplemento',
     	    'parent_id' => '1'
        ]);
       $categoryResource = array_where($categoryResource, function ($value, $key) {
            return !DB::table('category_resources')->where('name', $value['name'])->exists();
        });
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('category_resources')->insert($categoryResource);
    }
    
}
