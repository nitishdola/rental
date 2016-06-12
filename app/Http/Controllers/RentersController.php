<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Unit, App\Renter, App\RenterUnit;
use Redirect, DB, Validator;

class RentersController extends Controller
{
    public function create() {
    	$units = Unit::orderBy('name')->lists('name', 'id')->toArray();
    	return view('renters.create', compact('units'));
    }

    public function store(Request $request ) {
    	$validator = Validator::make($data = $request->all(), Renter::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

    	$message = '';
    	if($renter = Renter::create($data)) {
            $renterunit = [];
            for($i = 0; $i < count($data['units']); $i++ ) {
            	$renterunit['renter_id'] 	= $renter->id;
            	$renterunit['unit_id'] 		= $data['units'][$i];
            	
            	RenterUnit::create($renterunit);

            	$message .= 'Renter unit successfully !';
            }
        }else{
            $message .= 'Unable to add renter !';
        }

        return Redirect::route('renter.index')->with('message', $message);
    }

    public  function index() {
    	/*return $renters = DB::table('renters')
            ->select('renters.name as renterName', 'units.name as unitName' )
            ->join('renter_units', 'renter_units.renter_id', '=', 'renters.id')
            ->join('units', 'renter_units.unit_id', '=', 'units.id')

            ->get(); dump($renters);*/
        $results = Renter::with('renter_unit')->paginate(20);
        return view('renters.index', compact('results'));
    }

    public function unit_details() {
        if(isset($_GET['id']) && $_GET['id'] != '') {
            $renter_id = $_GET['id'];
            return RenterUnit::with('unit')->where('renter_id', $renter_id)->get();
        }
    }
}
