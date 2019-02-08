<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    protected $table = 'pools';

    protected $fillable = [
    
   		'team_id',
   		'name',
   		'size',
   		'coordinates'
	];
}
