<?php $count = 1; ?>
<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th class="hidden-xs">
                Unit Range
            </th>
            <th>
                Cost
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $k => $v)
        <tr>
            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
            <td class="hidden-xs"> {{ $v->unit_range }} </td>
            <td> {{ $v->cost }} </td>
            <td>
                <a href=" {{ route('electricity_units.edit', $v->id) }}">
                    <i class="fa fa-edit"></i>Edit
                </a>

                <a  style="color:red" onclick="return confirm('Are you sure you want to delete this item?');" href=" {{ route('electricity_units.disable', $v->id) }}">
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