<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect;

use App\Bill, App\Renter;

class BillsController extends Controller
{
    public function index() {
        $results = Bill::orderBy('created_by', 'DESC')->paginate(20);
    	return view('bills.index', compact('results'));
    }

    public function create() {
    	$renters = Renter::orderBy('name')->lists('name', 'id')->toArray();
    	return view('bills.create', compact('renters'));
    }

    public function store(Request $request ) {
    	$validator = Validator::make($data = $request->all(), Bill::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

    	$message = '';
    	if($renter = Bill::create($data)) {
            	$message .= 'Bill added successfully !';
            }
        }else{
            $message .= 'Unable to add renter !';
        }

        return Redirect::route('bill.index')->with('message', $message);
    }
}
