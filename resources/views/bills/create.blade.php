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

$('#bill_type_id').change(function() {
  if($(this).val() == 1) {
    $('#number_of_electricity_unit_div').fadeIn();
  }else{
    $('#number_of_electricity_unit_div').fadeOut();
  }
});

$('#number_of_electricity_unit').change(function() {
	var number_of_units = $(this).val();

	var data = '';
	var url = '';

	data += '&number_of_units='+number_of_units;
	url += '{{ route("electricity_units.cost")}}';

	$.ajax({
		data: data,
		type: 'get',
		url : url,

		error : function(resp) {
			console.log(resp);
		},
		success : function(resp) {
			$('#bill_amount').val(resp);
		}
	});	
});

</script>
@stop