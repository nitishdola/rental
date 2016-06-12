@extends('layouts.admin_default')
@section('title') Add a renter @stop
@section('pageTitle')  Add renter @stop
@section('pageCss') 
<link href="{{ asset('vendors/multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('pageJs')
<script type="text/javascript" src="{{ asset('vendors/multiselect/js/bootstrap-multiselect.js') }}"></script>
@stop
@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::open(array('route' => 'renter.store', 'id' => 'renter_store', 'class' => 'form-horizontal row-border')) !!}
            @include('renters._create')
            <div class="form-group {{ $errors->has('units') ? 'has-error' : ''}}">
			  {!! Form::label('units', 'Units Allocated', array('class' => 'col-md-2 control-label')) !!}
			  <div class="col-md-10">
			    {!! Form::select('units[]', $units,  null, ['class' => 'multiselect form-control required', 'id' => 'units', 'multiple' => "multiple", 'required' => 'true']) !!}
			  </div>
			  {!! $errors->first('units', '<span class="help-inline">:message</span>') !!}
			</div>
            {!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
        {!!form::close()!!}
    </div>
</div>
@endsection