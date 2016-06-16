<div class="form-group {{ $errors->has('bill_type') ? 'has-error' : ''}}">
  {!! Form::label('bill_type', 'Bill type', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::text('bill_type', null, ['class' => 'form-control required', 'id' => 'bill_type', 'placeholder' => 'Bill Type eg Electricity Bill', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('bill_amount', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('monthyear', 'Bill Month', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::text('monthyear', null, ['class' => 'monthpicker form-control required', 'id' => 'monthpicker', 'data-date-format' => "mm/yyyy",  'data-date-viewmode' => "years" , 'data-date-minviewmode' => "months", 'placeholder' => 'Bill Month', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('renter_id') ? 'has-error' : ''}}">
  {!! Form::label('renter_id', 'Renter', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::select('renter_id', $renters, null, ['class' => 'select2 form-control required', 'id' => 'renter_id', 'placeholder' => 'Select Renter','required' => 'true']) !!}
  </div>
  {!! $errors->first('renter_id', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('bill_amount') ? 'has-error' : ''}}">
  {!! Form::label('bill_amount', 'Bill Amount', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::number('bill_amount', null, ['class' => 'form-control required', 'id' => 'bill_amount', 'placeholder' => 'Bill Amount', 'step' => '0.01', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('bill_amount', '<span class="help-inline">:message</span>') !!}
</div>