@extends('layouts.admin_default')
@section('title') Renters Electricity Bills @stop
@section('pageTitle')  View Renters Electricity Bills @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
    	<h3> Electricity Bill</h3>
        <div class="portlet-body">
            <div class="table">
            	@if(count($results))
	            	@include('bills._all_electricity_bills')
	            @else
				    <div class="alert alert-danger fade in">
				        <a href="#" class="close" data-dismiss="alert">&times;</a>
				        <strong>Oops !</strong> No results found .
				    </div>
	            @endif
            </div>
        </div>
    </div>
</div>
@stop