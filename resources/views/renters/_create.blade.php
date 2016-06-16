<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('name', 'Renter Name', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::text('name', null, ['class' => 'form-control required', 'id' => 'name', 'placeholder' => 'Renter Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
  {!! Form::label('phone_number', 'Mobile Number', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::number('phone_number', null, ['class' => 'form-control required', 'id' => 'phone_number', 'placeholder' => 'Phone Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('phone_number', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('permanent_address') ? 'has-error' : ''}}">
  {!! Form::label('permanent_address', 'Parmanent Address', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::text('permanent_address', null, ['class' => 'form-control required', 'id' => 'permanent_address', 'placeholder' => 'Parmanent Address', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('permanent_address', '<span class="help-inline">:message</span>') !!}
</div>


@section('pageSpecificScripts')
<script>
$('.multiselect').multiselect();
</script>
@stop
