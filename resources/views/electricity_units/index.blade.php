@extends('layouts.admin_default')
@section('title')Eelctricty  Units @stop
@section('pageTitle')  View All Eelctricty Units @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div class="table-scrollable">
            	@if(count($results))
                	@include('electricity_units._index')
                @else

				    <div class="alert alert-danger fade in">

				        <a href="#" class="close" data-dismiss="alert">&times;</a>

				        <strong>Oops!</strong> No results found 

				    </div>
				@endif
            </div>
        </div>
    </div>
</div>
@stop