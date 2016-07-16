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

@section('pageCss')
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