@extends('layouts.admin_default')
@section('title')  Bills for {{ $renter->name }} @stop
@section('pageTitle')  View Previous Bills of  {{ $renter->name }}@stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div class="table">
            	@if(count($results))
	            	<?php $count = 1; ?>
					<table class="table table-striped table-bordered" id="table2"> 
					    <thead>
					        <tr>
					            <th>
					                #
					            </th>
					            <th class="hidden-xs">
					                Month
					            </th>
					            <th class="hidden-xs">
					                Total Bill
					            </th>
					            
					            <th>
					                Pay Status
					            </th>

					            <th>
					                View/Print
					            </th>
					        </tr>
					    </thead>
					    <tbody>
					        @foreach($results as $k => $v)
					        <tr @if($v->paid == 'no') class="danger" @else class="success" @endif>
					            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
					            <td> {{ date('F , Y', strtotime($v->monthyear)) }}</td>
					            <td> {{ $v->total_payble }}</td>
					            <td class="hidden-xs"> {{ ucfirst($v->paid) }} </td>
					            <td> <a href="{{ route('renter.view_bill', $renter->id) }}"> View/Print Bill for {{ date('F , Y', strtotime($v->monthyear)) }}</a> </td>
					     
					        </tr>
					        @endforeach
					    </tbody>
					</table>
					<div class="pagination">
					{!! $results->render() !!}
					</div>
	            @else
				    <div class="alert alert-danger fade in">
				        <a href="#" class="close" data-dismiss="alert">&times;</a>
				        <strong>Oops !</strong> No results found .
				    </div>
	            @endif
            </div>
        </div>
    </div>
</div>
@stop