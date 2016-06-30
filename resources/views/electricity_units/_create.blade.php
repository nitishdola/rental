<div class="form-group {{ $errors->has('unit_range') ? 'has-error' : ''}}">
  {!! Form::label('unit_range', 'Unit Range', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-7">
    {!! Form::text('unit_range', null, ['class' => 'form-control required', 'id' => 'unit_range', 'placeholder' => 'Unit Range eg 0-199', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('unit_range', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('cost') ? 'has-error' : ''}}">
  {!! Form::label('cost', 'Cost', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-7">
    {!! Form::number('cost', null, ['class' => 'form-control required', 'id' => 'cost', 'placeholder' => 'Cost', 'autocomplete' => 'off', 'step' => '0.01', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('cost', '<span class="help-inline">:message</span>') !!}
</div>