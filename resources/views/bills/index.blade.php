@extends('layouts.admin_default')
@section('title') Renters Bills @stop
@section('pageTitle')  View Renters Bills @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div class="table">
            	@if(count($results))
	            	@include('bills._index')
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