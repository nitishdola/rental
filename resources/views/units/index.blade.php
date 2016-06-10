@extends('layouts.admin_default')
@section('title') Units @stop
@section('pageTitle')  View All Units @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div class="table-scrollable">
                @include('units._index')
            </div>
        </div>
    </div>
</div>
@stop