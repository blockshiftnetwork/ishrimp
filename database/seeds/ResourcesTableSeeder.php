<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $resources = array(
        [
            'id' => '1',
            'name' => 'Lorica - Gisis',
            'category_id' => '1',
            'provider_id' => 'Juan',
            'team_id' => '1'
        ],
        [ 
     	    'id' => '2',
     	    'name' => 'Nature Wellness',
     	    'category_id' => '3',
     	    'provider_id' => 'Pedro',
     	    'team_id' => '1'
        ],
        [
     	    'id' => '3',
     	    'name' => 'Optiline',
     	    'category_id' => '2',
     	    'provider_id' => 'John',
     	    'team_id' => '1'
        ],
        [
            'id' => '4',
            'name' => 'Lorica - Gisis',
            'category_id' => '1',
            'provider_id' => 'Juan',
            'team_id' => '2'
        ],
        [ 
     	    'id' => '5',
     	    'name' => 'Nature Wellness',
     	    'category_id' => '3',
     	    'provider_id' => 'Pedro',
     	    'team_id' => '2'
        ],
        [
     	    'id' => '6',
     	    'name' => 'Optiline 25% #2',
     	    'category_id' => '2',
     	    'provider_id' => 'John',
     	    'team_id' => '2'
        ]);
       $resources = array_where($resources, function ($value, $key) {
            return !DB::table('resources')->where('id', $value['id'])->exists();
        });
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('resources')->insert($resources); 
    }
}
