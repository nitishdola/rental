<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $fillable = array('name', 'phone_number', 'permanent_address');
	protected $table    = 'renters';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'name' 				=>  'required',
    	'phone_number'  	=>  'required|digits:10|numeric',
    	'permanent_address' =>  'required|min:3',
    ];

    public function renter_unit() 
	{
		return $this->hasMany('App\RenterUnit');
	}
}
