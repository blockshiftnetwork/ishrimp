<?php

use Illuminate\Database\Seeder;

class PresentationResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $presentationResources = array(
        [
            'id' => '1',
            'resource_id' => '1',
            'name' => 'Lorica 1',
            'quantity' => '1',
            'price' => '10',
            'unity' => 'Kg'
        ],
        [ 
     	    'id' => '2',
     	    'resource_id' => '1',
     	    'name' => 'Lorica 3',
     	    'quantity' => '3',
     	    'price' => '15',
     	    'unity' => 'Kg'
        ],
        [
     	    'id' => '3',
     	    'resource_id' => '1',
     	    'name' => 'Lorica 5',
     	    'quantity' => '5',
     	    'price' => '20',
     	    'unity' => 'Kg'
        ],
        [
            'id' => '4',
            'resource_id' => '2',
            'name' => 'Nature Wellness 42%',
            'quantity' => '1',
            'price' => '14',
            'unity' => 'L'
        ],
        [ 
     	    'id' => '5',
     	    'resource_id' => '2',
     	    'name' => 'Nature Wellness 82%',
     	    'quantity' => '1',
     	    'price' => '17',
     	    'unity' => 'L'
        ],
        [
     	    'id' => '6',
     	    'resource_id' => '3',
     	    'name' => 'Optiline 35%',
     	    'quantity' => '50',
     	    'price' => '100',
     	    'unity' => 'Gr'
        ]);
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('presentation_resources')->insert($presentationResources);
    }
}
