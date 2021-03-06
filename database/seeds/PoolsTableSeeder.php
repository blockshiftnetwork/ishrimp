<?php

 use Illuminate\Database\Seeder;

 class PoolsTableSeeder extends Seeder
 {
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {
     $pools = array(
        [
            'id' => '1',
            'team_id' => '1',
            'name' => 'piscina #1',
            'size' => '20.12',
            'coordinates' => '[{"lat":-2.291877279996737,"lng":-79.78167786007634}]'
        ],
        [ 
     	    'id' => '2',
     	    'team_id' => '1',
     	    'name' => 'piscina #2',
     	    'size' => '45.20',
     	    'coordinates' => '[{"lat":-2.291877279996733,"lng":-79.78167786007631}]'
        ],
        [
     	    'id' => '3',
     	    'team_id' => '2',
     	    'name' => 'piscina #3',
     	    'size' => '10.25',
     	    'coordinates' => '[{"lat":-2.291877279996732,"lng":-79.78167786007638}]'
        ]);
     
       $pools = array_where($pools, function ($value, $key) {
            return !DB::table('pools')->where('id', $value['id'])->exists();
       });
        
        /****************************************************************************
        * Do the bulk insert with the remaining (non-existant) countries
        ****************************************************************************/
        DB::table('pools')->insert($pools);  
    }
 }
