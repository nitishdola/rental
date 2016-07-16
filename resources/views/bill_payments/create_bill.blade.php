@extends('layouts.admin_default')
@section('title') Generate Bill for {{ date('F,Y') }} @stop
@section('pageTitle')  Generate Bill for {{ date('F,Y') }} @stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body"> 
    	@if(count($renters))
        **<strong>Electricity Bill will not be includd with this bill. </strong>
        <br><br> 
        {!! Form::open(array('method' => 'post', 'route' => 'bill_payment.generate', 'id' => 'bill_search', 'class' => 'form-horizontal row-border')) !!}
            @include('bill_payments._create_bill')
            {!! Form:: submit('Generate', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
        @else
        	<div class="alert alert-success fade in">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>All bills have been generated for {{ date('F,Y') }}</strong> 
		    </div>
        @endif
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