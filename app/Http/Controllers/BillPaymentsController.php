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

            $bills = Bill::where(['paid' => 'unpaid', 'renter_id' => $renter_id, 'monthyear' => $monthyear.'-1'])->where('bill_type_id' , '!=', 1)->get();
            
            $additional_bill = 0;
            foreach($bills as $k1 => $v1) {
                $additional_bill += $v1->bill_amount;
            }


            $rentInfo = RenterUnit::where('renter_id', $renter_id)->get();

            $unit_rent = 0;

            foreach($rentInfo as $k => $v) {
                $unitInfo = Unit::findOrFail($v->unit_id);
                $unit_rent += $unitInfo->fare;
            }

            $data['renter_id']  = $renter_id;
            $data['rent']       = $unit_rent;
            $data['total_payble'] = $unit_rent + $additional_bill;
            $data['monthyear']  = date('Y-m-d', strtotime($monthyear));
            $data['paid']       = 'no';

            BillPayment::create($data);
        }
        $message = 'Bill successfully generated for '.count($request->renters). ' renters !';
        return Redirect::route('bill_payment.create')->with('message', $message);
    }


    public function make_payment(Request $request) {

        $message  = '';
        $success_bill = 0;

        for($i = 0; $i < count($request->bill_payment_id); $i++) {
            $bill_payment = BillPayment::findOrFail($request->bill_payment_id[$i]);

            $bill_payment->paid = 'yes';
            $bill_payment->pay_date = date('Y-m-d');
            

            if($bill_payment->save()) {
                $success_bill++;
            }
        }
        $message    .= $success_bill.' Bill paid successfully !';
        return Redirect::route('renter.view_bill', $bill_payment->renter_id)->with('message', $message);
    }

    public function report_search() {
    	$renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
    	return view('bill_payments.report_search', compact('renters'));
    }

    public function report_search_result(Request $request) {
        $matchThese = [];

        if($request->paid) {
            $matchThese['paid'] = $request->paid;
        }
        
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

    public function electricity_bill_view_renters() {
        $renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
        return view('bill_payments.electricity_bill_view_renters', compact('renters'));
    }

    public function electricity_bill_pay(Request $request) {
        $renter_id = $request->renter_id;
        return Redirect::route('electricity.all_bills', $renter_id);
    }

    public function rent_bill_view_renters() {
        $renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
        return view('bill_payments.rent_bill_view_renters', compact('renters'));
    }

    public function rent_bill_pay(Request $request) {
        $renter_id = $request->renter_id;
        return Redirect::route('renter.view_bill', $renter_id);
    }
    
}
