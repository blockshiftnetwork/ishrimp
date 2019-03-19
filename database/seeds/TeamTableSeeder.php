<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $finca = [ 
     	'name' => 'fincaPrueba',
     	'owner_id' => '1'
     ];

     $team_user = [
     	'team_id' => '1',
     	'user_id' => '1',
     	'role' => 'owner'
     ]
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('teams')->insert($finca);
        DB::table('team_users')->insert($team_user);
    }
}
