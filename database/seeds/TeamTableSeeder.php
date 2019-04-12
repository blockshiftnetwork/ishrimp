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
     $fincas = array ([ 
     	'name' => 'fincaPrueba1',
     	'owner_id' => '1'
     ],
     [
        'name' => 'fincaPrueba2',
        'owner_id' => '2'
     ]
    );

     $team_users = array ([
     	'team_id' => '1',
     	'user_id' => '1',
     	'role' => 'owner'
     ],
     [
        'team_id' => '2',
        'user_id' => '2',
        'role' => 'owner'
     ]
 );
       /* $user = array_where($user, function ($value, $key) {
            return !DB::table('users')->where('code', $value['code'])->exists();
        });*/
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('teams')->insert($fincas);
        DB::table('team_users')->insert($team_users);
    }
}
