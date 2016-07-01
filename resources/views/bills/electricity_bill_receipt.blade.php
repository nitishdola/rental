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
                        @if($bill_receipt)
                        <?php $total = 0; ?>
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                                <h3>VAISHALI COMPLEX</h3>
                                <h5>GS Road, Paltan Bazar, Guwahati - 781008</h5>
                            </div>

                            <div class="col-md-12" style="text-align: left;">
                            <h4>Tenant : {{ $renterInfo->name }}</h4>
                            </div>
                        </div>

                        @foreach($bill_receipt as $k => $v)
                        <div class="row">
                            <div class="col-md-3">
                                Bill period : 
                            </div>
                            <div class="col-md-3">
                                From <span style="text-decoration: underline;">{{ $v['period_from'] }}</span> 
                            </div>
                            <div class="col-md-1">To </div>
                            <div class="col-md-5">
                                <span style="text-decoration: underline;">{{ $v['period_to'] }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                Current Meter Reading : 
                            </div>
                            <div class="col-md-2">
                                 <span style="text-decoration: underline;">{{ $v['current_meter_reading'] }}</span> 
                            </div>

                            <div class="col-md-3">
                                Previous Meter Reading : 
                            </div>
                            <div class="col-md-2">
                                 <span style="text-decoration: underline;">{{ $v['previous_meter_reading'] }}</span> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                Units Consumed : 
                            </div>
                            <div class="col-md-2">
                                 <span style="text-decoration: underline;">{{ $v['current_meter_reading'] - $v['previous_meter_reading'] }}</span> 
                            </div>


                            <div class="col-md-3">
                                Electricity Charges : 
                            </div>
                            <div class="col-md-3">
                                  @Rs {{ $v['unit_cost']  }} per unit
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                ( Rupees {{ $v['bill_words'] }} ) only
                            </div> 
                        </div>

                         <div class="row">
                            <span style="font-size: 22px;">&#x20b9; {{ $v['bill_amount'] }}</span>
                         </div>
                        @endforeach
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