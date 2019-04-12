<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
     $users = array (
        [ 
     	'name' => 'admin',
     	'email' => 'admin@gmail.com',
     	'password' => bcrypt('123456')
     ],
     [
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => bcrypt('123456')
     ]
    );
       $users = array_where($users, function ($value, $key) {
            return !DB::table('users')->where('email', $value['email'])->exists();
        });
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('users')->insert($users);
    }
}
