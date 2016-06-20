<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectricityUnit extends Model
{
    protected $fillable = array('unit_range', 'cost');
	protected $table    = 'electricity_units';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'unit_range' 	=>  'required|unique:electricity_units|max:255',
    	'cost'  		=>  'required|numeric',
    ];

    public static $update_rules = [
    	'unit_range' 	=>  'required|max:255',
    	'cost'  		=>  'required|numeric',
    ];

}
