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
       $fincas = array_where($fincas, function ($value, $key) {
            return !DB::table('teams')->where('name', $value['name'])->exists();
        });
        

        $team_users = array_where($team_users, function ($value, $key) {
            return !DB::table('team_users')->where('user_id', $value['user_id'])->exists();
        });
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('teams')->insert($fincas);
        DB::table('team_users')->insert($team_users);
    }
}
