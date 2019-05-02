<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaylyParameters extends Model
{
    protected $table = 'daily_parameters';

    protected $fillable = [
        'pool_id',
        'ph',
        'ppt',
        'ppm',
        'temperature',
        'co3',
        'hco3',
        'ppm_d',
        'ppm_a',
        'ppm_h',
        'green_colonies',
        'yellow_colonies',
        'laboratory_id',
        'date',
        'hour'
    ];
}
