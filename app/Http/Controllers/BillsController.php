<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect;

use App\Bill, App\Renter, App\Unit, App\RenterUnit, App\BillPayment,App\BillType, App\ElectricityUnit;

class BillsController extends Controller
{
    public function index() {
        $results = Bill::with('renter')->with('bill_type')->orderBy('created_at', 'DESC')->paginate(20);
    	return view('bills.index', compact('results'));
    }

    public function create() {
        $bill_types = BillType::orderBy('name')->lists('name', 'id')->toArray();
    	$renters    = Renter::orderBy('name')->lists('name', 'id')->toArray();
    	return view('bills.create', compact('renters', 'bill_types'));
    }

    public function view( $id ) {
        /*$billInfo = Bill::findOrFail($id);
        
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

        $check_paid = BillPayment::where('renter_id', $renter_id)->where('monthyear',$monthyear)->count();*/

        return view('bills.view', compact('result', 'renterInfo', 'monthyear', 'unit_rent', 'check_paid'));
    }

    public function store(Request $request ) {
        
    	$validator = Validator::make($data = $request->all(), Bill::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
        //dd($request);
        $data['period_from'] = date('Y-m-d', strtotime( $data['period_from'] ));
        $data['period_to'] = date('Y-m-d', strtotime( $data['period_to'] ));

        $data['bill_amount'] = ElectricityUnit::get_unit_cost($request->current_meter_reading-$request->previous_meter_reading);

    	$message = '';
    	if($bill = Bill::create($data)) {
            	$message .= 'Bill added successfully !';
        }else{
            $message .= 'Unable to add renter !';
        }

        return Redirect::route('bill.index')->with('message', $message);
    }

    public function edit($id) {
        $bill_types = BillType::orderBy('name')->lists('name', 'id')->toArray();
        $renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
        $bill    = Bill::findOrFail($id);
        $bill['monthyear'] = date('m-Y', strtotime($bill->monthyear));

        if($bill->paid == 'unpaid') {
            return view('bills.edit', compact('renters', 'bill', 'bill_types'));
        }else{
            $message = 'Bill already paid ! cant update the info ';
            return Redirect::route('bill.index')->with('message', $message);
        }
        
    }

    public function update(Request $request, $id ) {
        $validator = Validator::make($data = $request->all(), Bill::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $data['period_from'] = date('Y-m-d', strtotime( $data['period_from'] ));
        $data['period_to'] = date('Y-m-d', strtotime( $data['period_to'] ));

        $data['bill_amount'] = ElectricityUnit::get_unit_cost($request->current_meter_reading-$request->previous_meter_reading);

        $message = '';
        $bill = Bill::findOrFail($id);
        $bill->fill($data);

        if($bill = $bill->save()) {
                $message .= 'Bill updated successfully !';
        }else{
            $message .= 'Unable to update renter !';
        }

        return Redirect::route('bill.index')->with('message', $message);
    }

    public function delete($id) {
        $bill = Bill::findOrFail($id);
        if($bill->paid == 'paid') {
            $message = 'Bill aready paid !';
        }else{
            Bill::destroy($id);
            $message = 'Bill Removed !';
        }
        
        return Redirect::route('bill.index')->with('message', $message);
    }

    public function all_electricity_bills($renter_id) {
        $renterInfo = Renter::findOrFail($renter_id);
        $results = Bill::where(['bill_type_id' => 1, 'renter_id' => $renter_id, 'paid' => 'unpaid'])->get();
        return view('bills.all_electricity_bills', compact('results', 'renterInfo'));
    }

    public function electricity_bill_pay(Request $request) {
        $ids = $request->bill_ids;
        if(!empty($ids)) {
            foreach($ids as $k => $v) {
               $bill = BIll::findOrFail($v); 
               $bill->paid = 'paid';
               $bill->save();
            }
        }
        $message = 'Bill Paid successfully';
        return Redirect::route('electricity.receipt', json_encode($ids))->with('message', $message);
    }   

    public function electricity_bill_receipt($ids) {
        $bill_receipt = [];
        if(!empty(json_decode($ids))) {
            foreach(json_decode($ids) as $k => $v) {
               $bill = Bill::findOrFail($v);
               $bill_receipt[$k]['current_meter_reading'] = $bill->current_meter_reading;
               $bill_receipt[$k]['previous_meter_reading']=$bill->previous_meter_reading;
               $bill_receipt[$k]['bill_amount'] = $bill->bill_amount;
               $bill_receipt[$k]['period_from'] = date('d-m-Y', strtotime($bill->period_from));
               $bill_receipt[$k]['period_to']   = date('d-m-Y', strtotime($bill->period_to));
               $bill_receipt[$k]['unit_cost']   = ElectricityUnit::get_unit_cost($bill->current_meter_reading-$bill->previous_meter_reading);

               $bill_receipt[$k]['bill_words']  = BillPayment::convertNumber($bill->bill_amount) ;

               $renter_id = $bill->renter_id;
            }
        }
        $renterInfo = Renter::findOrFail($renter_id);
        return view('bills.electricity_bill_receipt', compact('bill_receipt', 'renterInfo'));
    }
}
