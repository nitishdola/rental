<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('name', 'Unit Name', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::text('name', null, ['class' => 'form-control required', 'id' => 'name', 'placeholder' => 'Unit Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('area') ? 'has-error' : ''}}">
  {!! Form::label('area', 'Unit Area', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::number('area', null, ['class' => 'form-control required', 'id' => 'area', 'placeholder' => 'Unit Area', 'autocomplete' => 'off', 'step' => '0.01', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('area', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('fare') ? 'has-error' : ''}}">
  {!! Form::label('fare', 'Unit Fare', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::number('fare', null, ['class' => 'form-control required', 'id' => 'fare', 'placeholder' => 'Unit Fare', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('fare', '<span class="help-inline">:message</span>') !!}
</div>