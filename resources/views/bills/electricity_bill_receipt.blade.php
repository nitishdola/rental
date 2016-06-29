@extends('layouts.admin_default')
@section('title') Renters Electricity Bills @stop
@section('pageTitle')  View Renters Electricity Bills @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <h3> Electricity Bill</h3>
        <div class="portlet-body">
            <div class="table">
                @if(count($bill_receipt))
                    <style>
                    @media print {
                        .header,.alert_msg, .print_button, .left-side, .content-header,#other-btn {
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
                        @if($bill_receipt)
                        <?php $total = 0; ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Bill Month</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center">
                            @foreach($bill_receipt as $k => $v)
                                <tr>
                                    <td> {{ date('F Y', strtotime($v['monthyear'])) }}</td>
                                    <td> {{ $v['bill_amount'] }} </td>
                                </tr>
                                <?php $total+= $v['bill_amount']; ?>
                            @endforeach
                                <tr>
                                    <td> Total </td>
                                    <td> {{ $total }} </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <button class="btn btn-success print_button" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> PRINT </button>

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

@section('pageSpecificScripts')
<script type="text/javascript">

    function PrintElem(elem)
    {
       Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Tender</title>');
        /*optional stylesheet*/ 
        mywindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
@stop