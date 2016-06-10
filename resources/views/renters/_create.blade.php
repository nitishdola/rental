<div class="panel-body">
    <div class="form-group col-md-6 col-xs-12">
        <label>Normal Select</label>
        <div class="input-group  col-md-8">
            <select class="multiselect" multiple="multiple">
                <option value="cheese">Cheese</option>
                <option value="tomatoes">Tomatoes</option>
                <option value="mozarella">Mozzarella</option>
                <option value="mushrooms">Mushrooms</option>
                <option value="pepperoni">Pepperoni</option>
                <option value="onions">Onions</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('name', 'Renter Name', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::text('name', null, ['class' => 'form-control required', 'id' => 'name', 'placeholder' => 'Renter Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
  {!! Form::label('phone_number', 'Phone Number', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::number('phone_number', null, ['class' => 'form-control required', 'id' => 'phone_number', 'placeholder' => 'Phone Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('phone_number', '<span class="help-inline">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('permanent_address') ? 'has-error' : ''}}">
  {!! Form::label('permanent_address', 'Parmanent Address', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::number('permanent_address', null, ['class' => 'form-control required', 'id' => 'permanent_address', 'placeholder' => 'Parmanent Address', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('permanent_address', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('units') ? 'has-error' : ''}}">
  {!! Form::label('units', 'Units Allocated', array('class' => 'col-md-2 control-label')) !!}
  <div class="col-md-10">
    {!! Form::select('units[]', $units,  null, ['class' => 'multiple form-control required', 'id' => 'units', 'placeholder' => 'Parmanent Address', 'multiple' => "multiple", 'required' => 'true']) !!}
  </div>
  {!! $errors->first('units', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group col-md-6 col-xs-12">
    <label>Normal Select</label>
    <div class="input-group  col-md-8">
        <select class="multiselect" multiple="multiple">
            <option value="cheese">Cheese</option>
            <option value="tomatoes">Tomatoes</option>
            <option value="mozarella">Mozzarella</option>
            <option value="mushrooms">Mushrooms</option>
            <option value="pepperoni">Pepperoni</option>
            <option value="onions">Onions</option>
        </select>
    </div>
</div>