<?php

use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $providers = array(
        [
            'id' => '1',
            'name' => 'juan',
            'phone' => '+15236521241',
            'address' => 'Florida',
            'email' => 'jf@gmail.com'
        ],
        [ 
     	    'id' => '2',
     	    'name' => 'pedro',
     	    'phone' => '+345236521452',
     	    'address' => 'Barcelona',
     	    'email' => 'pb@gmail.com'
        ],
        [
     	    'id' => '3',
     	    'name' => 'john',
     	    'phone' => '+575232157459',
     	    'address' => 'Bogota',
     	    'email' => 'jb@gmail.com'
        ]);
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('providers')->insert($providers); 
    }
}
