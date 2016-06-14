@section('pageCss') 
<link href="{{ asset('vendors/datatables/css/dataTables.colReorder.min.css') }}" rel="stylesheet" type="text/css" /><link href="{{ asset('vendors/datatables/css/dataTables.scroller.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('pageJs')

<script type="text/javascript" src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/dataTables.tableTools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/dataTables.colReorder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/dataTables.bootstrap.js') }}"></script>
@stop
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
            <th>
                Renter Name
            </th>

            <th class="hidden-xs">
                Bill Type
            </th>
            <th>
                Amount
            </th>
            <th>
                View Bill
            </th>
            <th>
                Action
            </th>
            <th>
                Remove
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $k => $v)
        <tr>
            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
            <td> {{ date('F , Y', strtotime($v->monthyear)) }}</td>
            <td> {{ $v->renter['name'] }}</td>
            <td class="hidden-xs"> {{ $v->bill_type }} </td>
            <td> {{ $v->bill_amount }} </td>
            

            <td>
                <a href=" {{ route('bill.view', $v->id) }}">
                    <i class="fa fa-eye"></i>View Bill
                </a>
            </td>

            <td>
                <a href=" {{ route('bill.edit', $v->id) }}">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>

            <td>
                <a  style="color:red" onclick="return confirm('Are you sure you want to delete this item? This action can not be undone');" href=" {{ route('bill.disable', $v->id) }}">
                    <i class="fa fa-trash"></i>Delete
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
{!! $results->render() !!}
</div>

@section('pageSpecificScripts')
<script>

$('#table2').dataTable( {"paging":   false, "info":     false});</script>
@stop