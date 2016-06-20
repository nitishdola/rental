<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\BillPayment, App\Unit, App\Renter, App\RenterUnit, App\Bill;
use Redirect, DB, Validator;

class RentersController extends Controller
{
    public function create() {
        $renter_units = RenterUnit::get();

        $allocated_units = [];

        foreach($renter_units as $k => $v) {
            $allocated_units[] = $v->unit_id;
        }
    	$units = Unit::orderBy('name')->whereNotIn('id', $allocated_units)->lists('name', 'id')->toArray();
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
        $results = Renter::whereStatus(1)->with('renter_unit')->paginate(20);
        return view('renters.index', compact('results'));
    }

    public function unit_details() {
        if(isset($_GET['id']) && $_GET['id'] != '') {
            $renter_id = $_GET['id'];
            return RenterUnit::with('unit')->where('renter_id', $renter_id)->get();
        }
    }


    public function edit($id) {
        $units = Unit::orderBy('name')->get();
        $units_allocated = RenterUnit::where('renter_id', $id)->get();
        $renter = Renter::findOrFail($id);
        return view('renters.edit', compact('units', 'renter', 'units_allocated'));
    }

    public function update(Request $request , $id) {
        $validator = Validator::make($data = $request->all(), Renter::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $renter = Renter::findOrFail($id);

        $message = '';

        $renter->fill($data);
        if($renter->save()) {
            
            DB::table('renter_units')->where('renter_id', $renter->id)->delete();

            $renterunit = [];
            for($i = 0; $i < count($data['units']); $i++ ) {
                $renterunit['renter_id']    = $renter->id;
                $renterunit['unit_id']      = $data['units'][$i];
                
                RenterUnit::create($renterunit);

                $message .= 'Renter unit edited successfully !';
            }
        }else{
            $message .= 'Unable to edit  renter !';
        }

        return Redirect::route('renter.index')->with('message', $message);
    }

    public function delete($id) {
        $renter = Renter::findOrFail($id);
        $renter->status = 0;

        $message = '';
        if($renter->save()) {
            $message .= 'Renter Removed !';
        }
        return Redirect::route('renter.index')->with('message', $message);
    }
    public function view_bill($renter_id) {
        $monthyear  = date('Y-m');

        $renterInfo = Renter::findOrFail($renter_id);
        $bill_details = BillPayment::where(['renter_id' => $renter_id, 'monthyear' => $monthyear.'-01'])->first();

        $other_bills = Bill::where(['renter_id' => $renter_id, 'monthyear' => $monthyear.'-01'])->get();

        $previous_bills = BillPayment::where('monthyear', '<', $monthyear.'-1')->where('paid', 'no')->get();

        return view('bills.view', compact('bill_details', 'renterInfo', 'monthyear', 'other_bills', 'previous_bills'));
    }

    public function view_previous_bill( $renter_id ) {
        $renter =Renter::findOrFail($renter_id);
        $results = BillPayment::where('renter_id', $renter_id)->orderBy('created_at', 'DESC')->paginate(30);

        return view('bill_payments.view_previous_bill', compact('renter', 'results'));
    }
}
