<div class="form-group {{ $errors->has('bill_type_id') ? 'has-error' : ''}}">
  {!! Form::label('bill_type_id', 'Bill type', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-5">
    {!! Form::select('bill_type_id', $bill_types, null, ['class' => 'form-control required', 'id' => 'bill_type_id', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('bill_type_id', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('period_from') ? 'has-error' : ''}}">
  {!! Form::label('period_from', 'Period From', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-5">
    {!! Form::text('period_from', date('Y-m-3',  strtotime("-1 month")), ['class' => 'datepicker form-control required', 'id' => 'period_from', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('period_from', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('period_to') ? 'has-error' : ''}}">
  {!! Form::label('period_to', 'Period To', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-5">
    {!! Form::text('period_to', date('Y-m-2'), ['class' => 'datepicker form-control required', 'id' => 'period_to', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('period_to', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('current_meter_reading') ? 'has-error' : ''}}">
  {!! Form::label('current_meter_reading', 'Current Meter Reading', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-5">
    {!! Form::number('current_meter_reading', null, ['class' => 'form-control required', 'id' => 'current_meter_reading', 'placeholder' => 'Current Reading','autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('current_meter_reading', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('previous_meter_reading') ? 'has-error' : ''}}">
  {!! Form::label('previous_meter_reading', 'Previous Meter Reading', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-5">
    {!! Form::number('previous_meter_reading', null, ['class' => 'form-control required', 'id' => 'previous_meter_reading', 'placeholder' => 'Previous Reading', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('previous_meter_reading', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('renter_id') ? 'has-error' : ''}}">
  {!! Form::label('renter_id', 'Renter', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-5">
    {!! Form::select('renter_id', $renters, null, ['class' => 'select2 form-control required', 'id' => 'renter_id', 'placeholder' => 'Select Renter','required' => 'true']) !!}
  </div>
  {!! $errors->first('renter_id', '<span class="help-inline">:message</span>') !!}
</div>

