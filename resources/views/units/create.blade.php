@extends('layouts.admin_default')
@section('title') Add a unit @stop
@section('pageTitle')  Add Unit @stop
@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('route' => 'unit.store', 'id' => 'unit_store', 'class' => 'form-horizontal row-border')) !!}
            @include('units._create')
            {!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection