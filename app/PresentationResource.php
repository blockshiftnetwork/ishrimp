<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentationResource extends Model
{
    protected $table = 'presentation_resources';

    protected $fillable = [
    
   		'name',
   		'quantity',
   		'price',
   		'unity'
	];
}
