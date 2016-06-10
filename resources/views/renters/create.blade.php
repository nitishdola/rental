@extends('layouts.admin_default')
@section('title') Add a unit @stop
@section('pageTitle')  Add Unit @stop
@section('pageCss') 
<link href="{{ asset('vendors/multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('pageJs')
<script type="text/javascript" src="{{ asset('vendors/multiselect/js/bootstrap-multiselect.js') }}"></script>
@stop
@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('route' => 'renter.store', 'id' => 'unit_store', 'class' => 'form-horizontal row-border')) !!}
            @include('renters._create')
            {!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection