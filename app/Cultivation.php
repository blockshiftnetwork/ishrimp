<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cultivation extends Model
{
    protected $table = 'inventory_resources';

    protected $fillable = [
    	'resource_id',
    	'quantity',
    	'presentation_id',
    	'team_id'
    ];
}
