<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenterUnit extends Model
{
    protected $fillable = array('renter_id', 'unit_id');
	protected $table    = 'renter_units';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'renter_id' =>  'required|exists:renters,id',
    	'unit_id'  	=>  'required|exists:units,id',
    ];

    public function renter()
	{
	  return $this->belongsTo('App\Renter', 'renter_id');
	}

	public function unit()
	{
	  return $this->belongsTo('App\Unit', 'unit_id');
	}

	public function renter_unit() 
	{
		return $this->hasManyThrough( 'App\RenterUnit','App\Renter',   'id', 'unit_id');
	}
}
