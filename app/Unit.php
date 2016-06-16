<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = array('name', 'area', 'fare');
	protected $table    = 'units';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'name' 		=>  'required',
    	'area'  	=>  'required|numeric',
    	'fare'  	=>  'required|numeric',
    ];
}
