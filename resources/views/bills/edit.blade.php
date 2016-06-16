@extends('layouts.admin_default')
@section('title') Update Bill @stop
@section('pageTitle')  Update Bill @stop

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
        {!! Form::model($bill, array('route' => ['bill.update', $bill->id], 'id' => 'bill_store', 'class' => 'form-horizontal row-border')) !!}

            @include('bills._create')
            {!! Form:: submit('Update', ['class' => 'btn btn-success']) !!}
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