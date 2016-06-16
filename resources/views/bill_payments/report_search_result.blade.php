@extends('layouts.admin_default')
@section('title') Bill Report @stop
@section('pageTitle')  Bill Report @stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body">
        <?php $count = 1; ?>
		<table class="table table-striped table-bordered table-advance table-hover">
		    <thead>
		        <tr>
		            <th>
		                #
		            </th>
		            <th class="hidden-xs">
		                Renter Name
		            </th>
		            <th>
		                Phone Number
		            </th>

		            <th>
		                Month
		            </th>
		            <th>
		                Payment Status/Amount Paid
		            </th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $paid = 0; $unpaid = 0; ?>
		        @foreach($results as $k => $v)
		        
		        

		        <tr @if($v->paid == 'no') class="danger" @endif>

			        @if($v->paid == 'no')
			        	<?php $unpaid += $v->total_payble; ?>
			        @endif

			        @if($v->paid == 'yes')
			        	<?php $paid += $v->total_payble; ?>
			        @endif


		            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
		            <td class="hidden-xs"> {{ $v->renter['name'] }} </td>
		            <td> {{ $v->renter['phone_number'] }} </td>
		            <td> {{ date('F,Y', strtotime($v->monthyear)) }} </td>
		            <td> {{ strtoupper($v->paid) }} , Pending Amount : {{ $v->total_payble }}   @if($v->paid == 'yes') / {{ $v->total_payble }} / Paid on {{$v->pay_date}} @endif </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>

		<div>
			<b> Total Un-Paid : {{ number_format($unpaid,2,".",",") }}</b>
			<br> <b> Total Paid : {{ number_format($paid,2,".",",") }}</b>
		</div>

		<div class="pagination">
		{!! $results->render() !!}
		</div>
    </div>
</div>
@endsection