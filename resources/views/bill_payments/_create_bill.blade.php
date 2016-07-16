

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('monthyear_from', 'Month', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-3">
    {!! Form::text('monthyear', date('m-Y', strtotime('last month')), ['class' => 'monthpicker form-control required', 'id' => 'monthpicker', 'data-date-format' => "mm/yyyy",  'data-date-viewmode' => "years" , 'data-date-minviewmode' => "months", 'required' => 'true']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-10">
    <input type="checkbox" id="selecctall"/> <b>Selecct All</b></li>
  </div>
</div>

@foreach($renters as $k => $v)
<div class="form-group">
  <div class="col-md-10">
    <input type="checkbox" class="checkbox1" name="renters[]" value="{{ $v->id }}">{{ $v->name }} ( <b><span id="renter_{{$v->id}}"><img src="{{ asset('img/ajax-loader.gif') }}" /><script>countUnits({{$v->id}});</script></span></b> Unit )
  </div>
</div>
@endforeach

@section('pageSpecificScripts')
<script>
//$('#selecctall').prop('selected', true);
$("#selecctall").change(function(){
  $(".checkbox1").prop('checked', $(this).prop("checked"));
});
</script>
@stop
@section('pageJs')
<script type="text/javascript" src="{{ asset('vendors/datepicker/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/select2.js') }}"></script>
<script>
$('.monthpicker').datepicker({
    format: 'mm-yyyy'
});
</script>
@stop
@section('pageCss')
<link href="{{ asset('vendors/datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
<script>
	function countUnits(renter_id) {
		data = '';
		url = '';

		data += '&renter_id='+renter_id;
		url  += '{{ route("renter.count_units") }}';

		$.ajax({
			data : data,
			url  : url,
			type : 'get',

			error : function(resp) {
				console.log(resp);
			},

			success : function(resp) {
				$('#renter_'+renter_id).text(resp);
			}
		});
	}
</script>
@stop

@section('pageSpecificScripts')
<script>
$('.monthpicker').datepicker({
    format: 'mm-yyyy'
});
</script>
@stop