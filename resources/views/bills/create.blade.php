@extends('layouts.admin_default')
@section('title') Add a Bill @stop
@section('pageTitle')  Add Bill @stop

@section('pageCss') 
<link href="{{ asset('vendors/select2/select2.css') }}" rel="stylesheet" type="text/css" /><link href="{{ asset('vendors/select2/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('pageJs')
<script type="text/javascript" src="{{ asset('vendors/select2/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
@stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('route' => 'bill.store', 'id' => 'bill_store', 'class' => 'form-horizontal row-border')) !!}
            @include('bills._create')
            {!! Form::label('', '', array('class' => 'col-md-2 control-label')) !!}
            {!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection

@section('pageSpecificScripts')
<script>
$('.select2').select2();
$('#renter_id').change(function() {
	if($('#renter_id').val() != '') {
		$.blockUI();
		data = '';
		url  = '';
		data += '&renter_id='+$(this).val();
		url  += '{{ route("electricity.previous_reading")}}';

		$.ajax({
			data: data,
			type: 'get',
			url : url,

			error : function(resp) {
				console.log(resp);
				$.unblockUI();
			},
			success : function(resp) {
				$.unblockUI();
				$('#previous_meter_reading').val(resp);
			}
		});	
	}
});
</script>
@stop