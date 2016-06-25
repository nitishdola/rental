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
                Permanent Address
            </th>
            <th>
                Number of units allocated
            </th>
            <th> View Electricity Bills</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $k => $v)
        <tr>
            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
            <td class="hidden-xs"> {{ $v->name }} </td>
            <td> {{ $v->phone_number }} </td>
            <td> {{ $v->permanent_address }} </td>
            
            <td> <a href="#" title="View Units" onclick="showUnits({{$v->id}}, event)"> {{ count($v->renter_unit) }}</a> 
            <span id="units_{{$v->id}}"></span>
            </td>
            <td> <a href="{{ route('electricity.all_bills', $v->id) }}"> View </a>
            <td> <a href=" {{ route('renter.view_bill', $v->id) }}">
                    <i class="fa fa-eye"></i> View Bill for {{ date('M Y')}}
                </a> 
            </td>

            <td>
                <a href=" {{ route('renter.edit', $v->id) }}">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>

            <td>
                <a  style="color:red" onclick="return confirm('Are you sure you want to delete this item?');" href=" {{ route('renter.disable', $v->id) }}">
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
function showUnits(id, event) {
    event.preventDefault();
    if(id != '') {
        var data = '';
        var url  = '';

        data += '&id='+id;
        url  += "{{ URL::to('renter/unit-details')}}";

        $.ajax({
            data : data,
            url  : url,
            type : "GET",
            dataType : "JSON",

            error : function(resp) {
                alert('Please try again !');
                //$.unblockUI();
            },

            success : function(resp) {
                //$.unblockUI();
                if(jQuery.isEmptyObject(resp)) {
                    alert('No Course found !');
                }else{
                    render_ui(resp, id);
                }
            }
        });
    }
}

function render_ui(resp, id) { console.log(resp);
    var html = '';
    jQuery.each(resp, function(index, data) {
        html += '<b style="text-decoration: underline; padding : 0 8px; ">'+data.unit['name']+' '+'</b>';
    });

    $('#units_'+id).html(html);
}
</script>
@stop