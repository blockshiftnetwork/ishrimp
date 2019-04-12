<?php

use Illuminate\Database\Seeder;

class LaboratoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $laboratories = array(
        [
            'id' => '1',
            'name' => 'Dex lab',
            'phone' => '+521542352142',
            'address' => 'Peru',
            'email' => 'dexlab@gmail.com'
        ],
        [ 
     	    'id' => '2',
     	    'name' => 'Ter lab',
     	    'phone' => '+585245214258',
     	    'address' => 'Venezuela',
     	    'email' => 'terlab@gmail.com'
        ]);
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('laboratories')->insert($laboratories);
    }
}
