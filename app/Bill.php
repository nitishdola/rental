<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = array('renter_id', 'rent_amount', 'bill_amount', 'bill_month');
	protected $table    = 'bills';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'renter_id' 	=> 'required|exists:renters, id',
    	'bill_amount' 	=> 'required|numeric',
    	'bill_month' 	=> 'required|numeric'
    ];
}
