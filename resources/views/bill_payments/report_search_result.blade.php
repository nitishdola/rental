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
		        @foreach($results as $k => $v)
		        <tr @if($v->paid == 'no') class="danger" @endif>
		            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
		            <td class="hidden-xs"> {{ $v->renter['name'] }} </td>
		            <td> {{ $v->renter['phone_number'] }} </td>
		            <td> {{ $v->monthyear }} </td>
		            <td> {{ $v->paid }}  @if($v->paid == 'yes') / {{ $v->total_payble }} / Paid on {{$v->pay_date}} @endif </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
		<div class="pagination">
		{!! $results->render() !!}
		</div>
    </div>
</div>
@endsection