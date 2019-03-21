<?php

namespace App;
use App\Provider;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';

    protected $fillable = [
    
   		'name',
   		'category_id',
   		'provider_id',
   		'team_id'
	];
}
