@extends('layouts.admin_default')
@section('title') Bill Report @stop
@section('pageTitle')  Bill Report @stop

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
        {!! Form::open(array('method' => 'get', 'route' => 'bill.report_search_result', 'id' => 'bill_search', 'class' => 'form-horizontal row-border')) !!}
            @include('bill_payments._report_search')
            {!! Form:: submit('Search', ['class' => 'btn btn-success']) !!}
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