<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoolSowing extends Model
{
    protected $table = 'pools_sowing';

    protected $fillable = [
    
   		'pool_id',
   		'planted_larvae',
   		'larvae_type',
   		'planted_at'
	];
}
