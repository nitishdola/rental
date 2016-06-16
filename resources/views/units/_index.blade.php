<?php $count = 1; ?>
<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th class="hidden-xs">
                Unit Name
            </th>
            <th>
                Area
            </th>

            <th>
                Fare
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $k => $v)
        <tr>
            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
            <td class="hidden-xs"> {{ $v->name }} </td>
            <td> {{ $v->area }} </td>
            <td> {{ $v->fare }} </td>
            <td>
                <a href=" {{ route('unit.edit', $v->id) }}">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
{!! $results->render() !!}
</div>