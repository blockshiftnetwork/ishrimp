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
     $user = [ 
     	'name' => 'admin',
     	'email' => 'admin@gmail.com',
     	'password' => bcrypt('123456')
     ];
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('users')->insert($user);
    }
}
