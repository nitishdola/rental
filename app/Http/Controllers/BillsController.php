<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect;

use App\Bill, App\Renter, App\Unit, App\RenterUnit;

class BillsController extends Controller
{
    public function index() {
        $results = Bill::orderBy('created_at', 'DESC')->paginate(20);
    	return view('bills.index', compact('results'));
    }

    public function create() {
    	$renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
    	return view('bills.create', compact('renters'));
    }

    public function view( $id ) {
        $billInfo = Bill::findOrFail($id);
        
        $renter_id = $billInfo->renter_id;
        $monthyear = $billInfo->monthyear;

        $result = Bill::where(['renter_id' => $renter_id, 'monthyear' => $monthyear])->with('renter')->get();
        $renterInfo = Renter::findOrFail($renter_id);

        $rentInfo = RenterUnit::where('renter_id', $renterInfo->id)->get();

        $unit_rent = 0;

        foreach($rentInfo as $k => $v) {
            $unitInfo = Unit::findOrFail($v->unit_id);
            $unit_rent += $unitInfo->fare;
        }

        return view('bills.view', compact('result', 'renterInfo', 'monthyear', 'unit_rent'));
    }

    public function store(Request $request ) {
    	$validator = Validator::make($data = $request->all(), Bill::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $data['monthyear'] = '01-'.$request->monthyear;
        $data['monthyear'] = date('Y-m-d', strtotime( $data['monthyear'] ));
    	$message = '';
    	if($bill = Bill::create($data)) {
            	$message .= 'Bill added successfully !';
        }else{
            $message .= 'Unable to add renter !';
        }

        return Redirect::route('bill.view', $bill->id)->with('message', $message);
    }
}
