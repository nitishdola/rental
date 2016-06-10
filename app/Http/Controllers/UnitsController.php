<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator,Redirect;

use App\Unit;

class UnitsController extends Controller
{

	public function index() {
        $results = Unit::orderBy('name')->paginate(20);
    	return view('units.index', compact('results'));
    }

    public function create() {
    	return view('units.create');
    }

    public function store(Request $request) {
    	$validator = Validator::make($data = $request->all(), Unit::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

    	$message = '';

        if(Unit::create($data)) {
            $message .= 'Unit created successfully !';
         }else{
           $message .= 'Unable to add unit !';
         }

        return Redirect::route('unit.index')->with('message', $message);
    }

    public function edit($id) {
        $unit = Unit::findOrFail($id);
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($data = $request->all(), Unit::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $message = 'Unit information has been updated successfully';

        $unit = Unit::findOrFail($id);

        $unit->fill($data);

        if (!$unit->save())
            return Redirect::back()->withInput()->with('message', 'Error Updating your data, Please contact Technical Support');
        else
            return Redirect::route('unit.index')->with('message', $message); 
    }
}
