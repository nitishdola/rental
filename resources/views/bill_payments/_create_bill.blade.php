<div class="form-group">
  <div class="col-md-10">
    <input type="checkbox" id="selecctall"/> <b>Selecct All</b></li>
  </div>
</div>
@foreach($renters as $k => $v)
<div class="form-group">
  <div class="col-md-10">
    <input type="checkbox" class="checkbox1" name="renters[]" value="{{ $v->id }}">{{ $v->name }}
  </div>
</div>

@endforeach

@section('pageSpecificScripts')
<script>
$("#selecctall").change(function(){
  $(".checkbox1").prop('checked', $(this).prop("checked"));
});
</script>
@stop