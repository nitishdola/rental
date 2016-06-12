@extends('layouts.admin_default')
@section('title') Renters @stop
@section('pageTitle')  View All Renters @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div class="table-scrollable">
                @include('renters._index')
            </div>
        </div>
    </div>
</div>
@stop