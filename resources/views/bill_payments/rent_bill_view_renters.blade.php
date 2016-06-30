@extends('layouts.admin_default')
@section('title') Pay Electricity Bill @stop
@section('pageTitle')  Pay Electricity Bill @stop

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
    	@if(count($renters))
        {!! Form::open(array('method' => 'post', 'route' => array('bill_payment.rent_bill_pay'), 'id' => 'bill_search', 'class' => 'form-horizontal row-border')) !!}
            @include('bill_payments._search_renter')
            {!! Form::label('', '', array('class' => 'col-md-2 control-label')) !!}
            {!! Form:: submit('PAY', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
        @else
        	<div class="alert alert-success fade in">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>Ooops ! No renters found.</strong> 
		    </div>
        @endif
    </div>
</div>
@endsection

@section('pageSpecificScripts')
<script>
$('.select2').select2();
</script>
@stop