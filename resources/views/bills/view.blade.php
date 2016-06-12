@extends('layouts.admin_default')
@section('title') Renters Bill @stop
@section('pageTitle')  View Renters Bill @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div class="table-scrollable">
	            @include('bills._view')
            </div>
        </div>
    </div>
</div>
@stop