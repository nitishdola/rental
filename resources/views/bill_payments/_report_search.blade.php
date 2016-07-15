<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('monthyear_from', 'Bill Month From', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-3">
    {!! Form::text('monthyear_from', null, ['class' => 'monthpicker form-control required', 'id' => 'monthpicker', 'data-date-format' => "mm/yyyy",  'data-date-viewmode' => "years" , 'data-date-minviewmode' => "months", 'placeholder' => 'All']) !!}
  </div>

  {!! Form::label('monthyear_to', 'Bill Month To', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-3">
    {!! Form::text('monthyear_to', null, ['class' => 'monthpicker form-control required', 'id' => 'monthpicker', 'data-date-format' => "mm/yyyy",  'data-date-viewmode' => "years" , 'data-date-minviewmode' => "months", 'placeholder' => 'All']) !!}
  </div>
</div>

<div class="form-group {{ $errors->has('renter_id') ? 'has-error' : ''}}">
  {!! Form::label('renter_id', 'Renter', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-3">
    {!! Form::select('renter_id', $renters, null, ['class' => 'select2 form-control required', 'id' => 'renter_id', 'placeholder' => 'All']) !!}
  </div>
  
  <?php
  $pay_status['yes']  = 'Paid';
  $pay_status['no']   = 'Un-paid';
  ?>
    {!! Form::label('paid', 'Pay Status', array('class' => 'col-md-2 control-label')) !!}
    <div class="col-md-3">
      {!! Form::select('paid', $pay_status, null, ['class' => 'form-control required', 'id' => 'paid', 'placeholder' => 'All']) !!}
    </div>
</div>