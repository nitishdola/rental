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

    public static function get_unit_cost($units) {
        $e_units = ElectricityUnit::get();

        foreach($e_units as $k => $v) {
            $unit_range = $v->unit_range;
            $unit_arr = explode('-', $unit_range);

            if($unit_arr[1] != '') {
                if($units >= $unit_arr[0]  && $units <= $unit_arr[1] ) {
                    return $v->cost*$units;
                }
            }else{
                return $v->cost*$units;
            }
           
        }
    }

    public static function get_unit_price($units) {
        $e_units = ElectricityUnit::get();

        foreach($e_units as $k => $v) {
            $unit_range = $v->unit_range;
            $unit_arr = explode('-', $unit_range);

            if($unit_arr[1] != '') {
                if($units >= $unit_arr[0]  && $units <= $unit_arr[1] ) {
                    return $v->cost;
                }
            }else{
                return $v->cost;
            }
           
        }
    }

}
