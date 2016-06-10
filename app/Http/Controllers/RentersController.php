<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Unit, App\Renter;

class RentersController extends Controller
{
    public function create() {
    	$units = [''=>'Select Units'] + Unit::orderBy('name')->lists('name', 'id')->toArray();
    	return view('renters.create', compact('units'));
    }
}
