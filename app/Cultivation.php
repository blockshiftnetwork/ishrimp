<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cultivation extends Model
{
    protected $table = 'pools_resources_used';

    protected $fillable = [
    	'resource_id',
    	'quantity',
    	'presentation_id',
    	'team_id'
    ];
}
