<div class="form-group {{ $errors->has('renter_id') ? 'has-error' : ''}}">
  {!! Form::label('renter_id', 'Renter', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-6">
    {!! Form::select('renter_id', $renters, null, ['class' => 'select2 form-control required', 'id' => 'renter_id', 'placeholder' => 'All']) !!}
  </div>
  {!! $errors->first('renter_id', '<span class="help-inline">:message</span>') !!}
</div>