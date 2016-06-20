@extends('layouts.admin_default')
@section('title') Add a electricity unit range @stop
@section('pageTitle')  Add Electricity Unit Range @stop
@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('route' => 'electricity_units.store', 'id' => 'unit_store', 'class' => 'form-horizontal row-border')) !!}
            @include('electricity_units._create')
            {!! Form::label('', '', array('class' => 'col-md-2 control-label')) !!}
            {!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection