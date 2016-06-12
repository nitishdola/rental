@extends('layouts.admin_default')
@section('title') Edit a unit @stop
@section('pageTitle')  Edit Renter @stop
@section('pageCss') 
<link href="{{ asset('vendors/multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('pageJs')
<script type="text/javascript" src="{{ asset('vendors/multiselect/js/bootstrap-multiselect.js') }}"></script>
@stop
@section('content')


<div class="panel panel-primary">
    <div class="panel-body">
        {!! Form::model($renter, array('route' => ['renter.update', $renter->id], 'id' => 'renter_store', 'class' => 'form-horizontal row-border')) !!}
            @include('renters._create')

            <div class="form-group {{ $errors->has('permanent_address') ? 'has-error' : ''}}">
			  {!! Form::label('units', 'Units Allocated', array('class' => 'col-md-2 control-label')) !!}
			  <div class="col-md-10">
	            <select multiple="multiple" class="multiselect form-control required" name="units[]" id="units">
					@foreach($units as $k => $v)
					<option value="{{$v->id}}" @foreach($units_allocated as $k1 => $v1) @if($v->id == $v1->unit_id)selected="selected"@endif @endforeach>{{$v->name}}</option>
					@endforeach
				</select>
			</div>

            {!! Form:: submit('Update', ['class' => 'btn btn-success']) !!}
            

        {!!form::close()!!}
    </div>
</div>
@endsection