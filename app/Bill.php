<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = array('bill_type_id', 'renter_id', 'rent_amount', 'bill_amount', 'monthyear');
	protected $table    = 'bills';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'renter_id' 	=> 'required|exists:renters,id',
    	'bill_amount' 	=> 'required|numeric',
    	'monthyear' 	=> 'required|date_format:m-Y'
    ];

    public function renter() 
	{
		return $this->belongsTo('App\Renter', 'renter_id');
	}

    public function bill_type() 
    {
        return $this->belongsTo('App\BillType', 'bill_type_id');
    }
}
