<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect;

use App\BillPayment, App\Bill, App\Renter, App\Unit, App\RenterUnit;

class BillPaymentsController extends Controller
{
    public function make_payment(Request $request) {

    	$data = $request->all();
    	$data['pay_date'] 	= date('Y-m-d');
    	$data['paid'] 		= 'yes';

    	$validator = Validator::make($data, BillPayment::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $data['monthyear'] = date('Y-m-d', strtotime( $data['monthyear'] ));

    	$message = '';

    	if(BillPayment::create($data)) {
            	$message .= 'Bill paid successfully !';
        }else{
            $message .= 'Unable to pay bill !';
        }

        return Redirect::route('bill.view', $request->renter_id)->with('message', $message);
    }

    public function report_search() {
    	$renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
    	return view('bill_payments.report_search', compact('renters'));
    }

    public function report_search_result(Request $request) {
    	$renters = Renter::orderBy('name')->lists('name', 'id')->toArray();

    	dd($request);
    	return view('bill_payments.report_search', compact('renters'));
    }
}
