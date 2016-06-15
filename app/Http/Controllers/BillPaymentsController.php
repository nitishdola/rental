<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect;

use App\BillPayment, App\Bill, App\Renter, App\Unit, App\RenterUnit;

class BillPaymentsController extends Controller
{

    public function create_bill() {
        $monthyear = date('Y-m');
        $monthyear = $monthyear.'-01';
        $generated_bills = BillPayment::where('monthyear', $monthyear)->get();

        $bill_renters = [];
        foreach($generated_bills as $k => $v) {
            $bill_renters[] = $v->renter_id;
        }

        $renters = Renter::orderBy('name')->whereNotIn('id', $bill_renters)->paginate(20);

        return view('bill_payments.create_bill', compact('renters'));
    }

    public function generate_bill(Request $request) {
        $monthyear  = date('Y-m');
        for($i = 0; $i < count($request->renters); $i++) {
            $renter_id = $request->renters[$i];

            $bills = Bill::where(['renter_id' => $renter_id, 'monthyear' => $monthyear])->get();
            
            $add_bill = 0;
            foreach($bills as $k1 => $v1) {
                $add_bill += $v1->bill_amount;
            }


            $rentInfo = RenterUnit::where('renter_id', $renter_id)->get();

            $unit_rent = 0;

            foreach($rentInfo as $k => $v) {
                $unitInfo = Unit::findOrFail($v->unit_id);
                $unit_rent += $unitInfo->fare;
            }

            $data['renter_id']  = $renter_id;
            $data['rent']       = $unit_rent;
            $data['total_payble'] = $unit_rent + $add_bill;
            $data['monthyear']  = date('Y-m-d', strtotime($monthyear));
            $data['paid']       = 'no';

            BillPayment::create($data);
        }
        $message = 'Bill successfully generated for '.count($request->renters). ' renters !';
        return Redirect::route('bill_payment.create')->with('message', $message);
    }


    public function make_payment(Request $request) {

    	$bill_payment = BillPayment::findOrFail($request->bill_payment_id);

        $bill_payment->paid = 'yes';
        $bill_payment->pay_date = date('Y-m-d');
        $message  = '';

    	if($bill_payment->save()) {
            	$message .= 'Bill paid successfully !';
        }else{
            $message .= 'Unable to pay bill !';
        }

        return Redirect::route('bill.view', $bill_payment->renter_id)->with('message', $message);
    }

    public function report_search() {
    	$renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
    	return view('bill_payments.report_search', compact('renters'));
    }

    public function report_search_result(Request $request) {
        $matchThese = [];
        if($request->renter_id) {
            $matchThese['renter_id'] = $request->renter_id;
        }

        $from   = '1970-1-1';
        $to     = date('Y-m-d');

        if($request->monthyear_from) {
            $from = date('Y-m-d', strtotime('1-'.$request->monthyear_from));
        }

        if($request->monthyear_to) {
            $to = date('Y-m-d', strtotime('1-'.$request->monthyear_to));
        }


        $results = BillPayment::where($matchThese)->where('monthyear', '>=', $from)->where('monthyear', '<=', $to)->with('renter')->paginate(50);
    	return view('bill_payments.report_search_result', compact('results'));
    }
}
