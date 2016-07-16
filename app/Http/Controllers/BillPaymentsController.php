<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect;

use App\BillPayment, App\Bill, App\Renter, App\Unit, App\RenterUnit;

class BillPaymentsController extends Controller
{

    public function create_bill() {
        $monthyear = date('Y-m', strtotime('last month'));
        $monthyear = $monthyear.'-01';
        $generated_bills = BillPayment::where('monthyear', $monthyear)->get();

        $bill_renters = [];
        /*foreach($generated_bills as $k => $v) {
            $bill_renters[] = $v->renter_id;
        }*/
        $renters = Renter::orderBy('name')->whereNotIn('id', $bill_renters)->where('status',1)->get();
        return view('bill_payments.create_bill', compact('renters'));
    }

    public function generate_bill(Request $request) {
        
        if(count($request->renters)) {
            $monthyear  = date('Y-m', strtotime('01-'.$request->monthyear));
            for($i = 0; $i < count($request->renters); $i++) {
                $renter_id = $request->renters[$i];

                $additional_bill = 0;

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
        }else{
            $message = 'No renter selected !';return Redirect::route('bill_payment.create')->with('message', $message);
        }
        return Redirect::route('bill_payment.create')->with('message', $message);
        
    }


    public function make_payment(Request $request) {
        $message  = '';
        $success_bill = 0;
        $success_ebill = 0;
        for($i = 0; $i < count($request->bill_payment_id); $i++) {
            $bill_payment = BillPayment::findOrFail($request->bill_payment_id[$i]);

            $bill_payment->paid = 'yes';
            $bill_payment->pay_date = date('Y-m-d');
            

            if($bill_payment->save()) {
                $success_bill++;
            }
        }

        for($j = 0; $j < count($request->bill_ids); $j++) {
            $bill = Bill::findOrFail($request->bill_ids[$j]);

            $bill->paid = 'paid';
            //$bill_payment->pay_date = date('Y-m-d');
            

            if($bill->save()) {
                $success_ebill++;
            }
        }

        $message    .= ' Bill paid successfully !';
        /*return Redirect::route('renter.renter_bill_receipt', $bill_payment->renter_id)->with('message', $message);*/
        return Redirect::route('bill.receipt', array(json_encode($request->bill_payment_id), json_encode($request->bill_ids)))->with('message', $message);
    }

    public function report_search() {
    	$renters = Renter::orderBy('name')->where('status', 1)->lists('name', 'id')->toArray();
    	return view('bill_payments.report_search', compact('renters'));
    }

    public function report_search_result(Request $request) {
        $matchThese = [];
        $matchThese2 = [];
        if($request->paid) {
            $matchThese['paid'] = $request->paid;
            if($request->paid == 'no') {
               $matchThese2['paid'] = 'unpaid'; 
            }else{
                $matchThese2['paid'] = 'paid'; 
            }
        }
        
        if($request->renter_id) {
            $matchThese['renter_id']  = $request->renter_id;
            $matchThese2['renter_id'] = $request->renter_id;
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

        $bill_results = Bill::where($matchThese2)->where('period_to', '>=', $from)->where('period_to', '<=', $to)->with('renter')->paginate(50);

        $renters = Renter::orderBy('name')->where('status', 1)->lists('name', 'id')->toArray();

    	return view('bill_payments.report_search_result', compact('renters', 'results', 'bill_results'));
    }

    public function electricity_bill_view_renters() {
        $renters = Renter::orderBy('name')->where('status', 1)->lists('name', 'id')->toArray();
        return view('bill_payments.electricity_bill_view_renters', compact('renters'));
    }

    public function electricity_bill_pay(Request $request) {
        $renter_id = $request->renter_id;
        return Redirect::route('electricity.all_bills', $renter_id);
    }

    public function rent_bill_view_renters() {
        $renters = Renter::orderBy('name')->where('status', 1)->lists('name', 'id')->toArray();
        return view('bill_payments.rent_bill_view_renters', compact('renters'));
    }

    public function rent_bill_pay(Request $request) {
        $renter_id = $request->renter_id;
        return Redirect::route('renter.view_bill', $renter_id);
    }

    public function renter_bill_receipt($renter_id) {
        $monthyear  = date('Y-m', strtotime('last month'));

        $renterInfo = Renter::findOrFail($renter_id);
        $bill_details = BillPayment::where(['renter_id' => $renter_id, 'monthyear' => $monthyear.'-01'])->first();

        $previous_bills = [];

        $previous_bill_obj = BillPayment::where('monthyear', '<', $monthyear.'-1')->where('paid', 'no');

        if($previous_bill_obj->count()) {
            $previous_bills = $previous_bill_obj->get();
        }

        $p_bill = 0;
        foreach($previous_bill_obj->get() as $k => $v) {
            $p_bill += $v->total_payble;
        }

        $total_bill = $bill_details->total_payble + $p_bill;

        $words = BillPayment::convertNumber( number_format($total_bill,2,".",","));

        return view('bills.rent_bill_receipt', compact('bill_details', 'renterInfo', 'monthyear', 'previous_bills', 'words'));
    }

    public function create_notification() {
        $renters = Renter::whereStatus(1)->orderBy('name')->get();
        $bill = [];
        foreach($renters as $k => $v) {
            
            $bill[$k]['renter_name'] = $v->name;
            //rent bill
            $rent_bills = BillPayment::where('paid', 'no')->where('renter_id', $v->id)->get();
            foreach($rent_bills as $kr => $vr) {
                $bill[$k]['bill_info']['rent_bill'][$vr->monthyear] = $vr->total_payble;
                //$bill[$k]['bill_info']['rent_bill_month'][$kr] = $vr->monthyear;
            }

            //electricity bill
            $electricity_bills = Bill::where('paid', 'unpaid')->where('renter_id', $v->id)->get();
            foreach($electricity_bills as $ke => $ve) {
                $bill[$k]['bill_info']['electricity_bill'][date('F', strtotime($ve->period_to))] = $ve->bill_amount;
            }
        }
        return view('bill_payments.notification', compact('bill'));
    }
    
}
