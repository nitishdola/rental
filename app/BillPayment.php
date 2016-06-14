<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    protected $fillable = array('renter_id', 'rent', 'total_payble', 'pay_date', 'paid', 'monthyear');
	protected $table    = 'bill_payments';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'renter_id' =>  'required|exists:renters,id',
    	'rent'  	=>  'required|numeric',
    	'total_payble' 	=> 'required|numeric',
    	'pay_date' 	=> 'required|date_format:Y-m-d',
    	'monthyear' => 'required|date_format:Y-m'
    ];
}
