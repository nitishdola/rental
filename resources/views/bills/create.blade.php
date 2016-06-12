@extends('layouts.admin_default')
@section('title') Add a Bill @stop
@section('pageTitle')  Add Bill @stop

@section('pageCss') 
<link href="{{ asset('vendors/select2/select2.css') }}" rel="stylesheet" type="text/css" /><link href="{{ asset('vendors/select2/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('pageJs')
<script type="text/javascript" src="{{ asset('vendors/datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/select2.js') }}"></script>

@stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('route' => 'bill.store', 'id' => 'bill_store', 'class' => 'form-horizontal row-border')) !!}
            @include('bills._create')
            {!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection

@section('pageSpecificScripts')
<script>
$('.monthpicker').datepicker({
	format: 'mm-yyyy'
});

$('.select2').select2();
</script>
@stop