<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaylySample extends Model
{
    protected $table = 'daily_samples';

    protected $fillable = [
        'pool_id',
        'weight',
        'quantity',
        'abw',
        'wg',
        'survival_percent',
        'abw_date',
        'abw_hour'
    ];
}
