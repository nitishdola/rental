<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ElectricityUnit;
use Redirect, DB, Validator;

class ElectricityUnitsController extends Controller
{
    public function create() {
    	return view('electricity_units.create', compact('units'));
    }

    public function store(Request $request ) {
    	$validator = Validator::make($data = $request->all(), ElectricityUnit::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

    	$message = '';
    	if(ElectricityUnit::create($data)) {
            	$message .= 'Electricity unit created successfully !';
        }else{
            $message .= 'Unable to add unit !';
        }

        return Redirect::route('electricity_units.index')->with('message', $message);
    }

    public  function index() {
        $results = ElectricityUnit::paginate(20);
        return view('electricity_units.index', compact('results'));
    }

    public function edit($id) {
        $electricity_unit = ElectricityUnit::findOrFail($id);
        return view('electricity_units.edit', compact('electricity_unit'));
    }

    public function update(Request $request , $id) {
        $validator = Validator::make($data = $request->all(), ElectricityUnit::$update_rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $electricity_unit = ElectricityUnit::findOrFail($id);

        $message = '';

        $electricity_unit->fill($data);
        if($electricity_unit->save()) {
            $message .= 'Electricity unit edited successfully !';
        }else{
            $message .= 'Unable to edit  unit !';
        }

        return Redirect::route('electricity_units.index')->with('message', $message);
    }

    public function delete($id) {
        ElectricityUnit::destroy($id);
        $message = 'Unit Removed !';
        return Redirect::route('electricity_units.index')->with('message', $message);
    }
}
