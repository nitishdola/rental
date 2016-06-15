@extends('layouts.admin_default')
@section('title') Generate Bill for {{ date('F,Y') }} @stop
@section('pageTitle')  Generate Bill for {{ date('F,Y') }} @stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('method' => 'post', 'route' => 'bill_payment.generate', 'id' => 'bill_search', 'class' => 'form-horizontal row-border')) !!}
            @include('bill_payments._create_bill')
            {!! Form:: submit('Generate', ['class' => 'btn btn-success']) !!}
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