<style>
@media print {
    .header, .left-side, .content-header,#other-btn {
     display:none;
    }

    #prnt {
     display:block;
    }
    .pending_amount {
        display: none;
    }
}
</style>
<div id="prnt">
<div class="row">
    <ul class="timeline">
        <li>
            <div class="timeline-badge">
                <i class="livicon" data-name="users" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
            </div>
            <div class="timeline-panel" style="display:inline-block;">
                <div class="timeline-heading">
                    <h4 class="timeline-title">{{ $renterInfo->name }}</h4>
                </div>
                <div class="timeline-body">
                   
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="row">
    @if($results)
    <?php $total = 0; ?>
    {!! Form::open(array('route' => 'electricity_bill.pay', 'id' => 'electricity_bill_pay', 'class' => 'form-horizontal row-border')) !!}
    <table class="table">
        <thead>
            <tr>
                <th>Bill Month</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody style="text-align:center">
        @foreach($results as $k => $v) 
            <tr>
                <td> {{ date('F Y', strtotime($v->monthyear)) }}</td>
                <td> {{ $v->bill_amount }} </td>
            </tr>
            <input type="hidden" name="bill_ids[]" value="{{ $v->id }}">
            <?php $total+= $v->bill_amount; ?>
        @endforeach
            <tr>
                <td> Total </td>
                <td> {{ $total }} </td>
            </tr>
        </tbody>
    </table>
    @endif

    
    {!! Form::label('', '', array('class' => 'col-md-4 control-label')) !!}
    {!! Form:: submit('Pay', ['class' => 'btn btn-success']) !!}
    {!!form::close()!!}
</div>
