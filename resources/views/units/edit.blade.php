@extends('layouts.admin_default')
@section('title') Edit a unit @stop
@section('pageTitle')  Edit Unit @stop
@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::model($unit, array('route' => ['unit.update', $unit->getRouteKey()], 'id' => 'unit_store', 'class' => 'form-horizontal row-border')) !!}
            @include('units._create')
            {!! Form:: submit('Edit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection