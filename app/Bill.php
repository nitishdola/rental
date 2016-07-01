<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = array('bill_type_id', 'renter_id', 'period_from', 'bill_amount', 'monthyear', 'period_to', 'current_meter_reading', 'previous_meter_reading');
	protected $table    = 'bills';
    protected $guarded  = ['_token'];

    public static $rules = [
        'bill_type_id'  => 'required|exists:bill_types,id',
    	'renter_id' 	=> 'required|exists:renters,id',
    	'period_from' 	=> 'required|date_format:Y-m-d',
        'period_to'     => 'required|date_format:Y-m-d',
    	'current_meter_reading' 	=> 'required|numeric',
        'previous_meter_reading'    => 'required|numeric',
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
