@extends('layouts.admin_default')
@section('title') Renters Electricity Bills @stop
@section('pageTitle')  View Renters Electricity Bills @stop
@section('content')
<div class="col-xs-10 col-offset-1">
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

                        #print {
                         display:block;
                         padding: 40px;
                         font-size: 6px;
                        }
                        .pending_amount {
                            display: none;
                        }
                    }
                    </style>
                    <div>
                    <div  id="print">
                        <div class="row">
                            <div class="col-xs-12">
                                @if($bill_receipt)
                                <div class="row">
                                    <div class="col-xs-offset-3 col-xs-6" style="text-align: center;">
                                        <h3>VAISHALI COMPLEX</h3>
                                        <h5>GS Road, Paltan Bazar, Guwahati - 781008</h5>
                                    </div>

                                    <div class="col-xs-2"> Date : {{ date('d-m-Y') }} </div>

                                    <div class="col-xs-12" style="text-align: left;">
                                    <h4>Tenant : {{ $renterInfo->name }}</h4>
                                    </div>
                                </div>

                                @foreach($bill_receipt as $k => $v)

                                <br>
                                <div class="row">
                                    <div class="col-xs-3">
                                        {{ $k+1 }} . Bill period : 
                                    </div>
                                    <div class="col-xs-3">
                                        From <span style="text-decoration: underline;">{{ $v['period_from'] }}</span> 
                                    </div>
                                    <div class="col-xs-1">To </div>
                                    <div class="col-xs-5">
                                        <span style="text-decoration: underline;">{{ $v['period_to'] }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-3">
                                        Current Meter Reading : 
                                    </div>
                                    <div class="col-xs-2">
                                         <span style="text-decoration: underline;">{{ $v['current_meter_reading'] }}</span> 
                                    </div>

                                    <div class="col-xs-3">
                                        Previous Meter Reading : 
                                    </div>
                                    <div class="col-xs-2">
                                         <span style="text-decoration: underline;">{{ $v['previous_meter_reading'] }}</span> 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-3">
                                        Units Consumed : 
                                    </div>
                                    <div class="col-xs-2">
                                         <span style="text-decoration: underline;">{{ $v['current_meter_reading'] - $v['previous_meter_reading'] }}</span> 
                                    </div>


                                    <div class="col-xs-3">
                                        Electricity Charges : 
                                    </div>
                                    <div class="col-xs-3">
                                          @Rs {{ $v['unit_cost']  }} per unit
                                    </div>
                                </div>
                                @endforeach

                                <div class="row">
                                    <div class="col-xs-12">
                                        <span style="font-size: 18px;">Rs. {{ number_format($total_electricity_bill,2,".",",")}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                    ( Rupees {{ $electrcity_bill_words}} ) only
                                    </div> 
                                </div>

                                @endif

                            <!--BILLDETAILS-->

                                @else
                                    <div class="alert alert-danger fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Oops !</strong> No results found .
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Rent Bill -->
                        <hr>
                        @if($rent_bill)
                            <div class="row" style="margin-top:50px">
                                <div class="col-xs-12">
                                <div class="col-xs-offset-3 col-xs-6" style="text-align: center;">
                                    <h3>VAISHALI COMPLEX</h3>
                                    <h5>GS Road, Paltan Bazar, Guwahati - 781008</h5>
                                </div>
                                <div class="col-xs-2"> Date : {{ date('d-m-Y') }} </div>

                                <div class="col-xs-12" style="text-align: left;">
                                    <h5 style="line-height: 23px">Received with thanks from M/s {{ $renterInfo->name }} a sum of Rs. {{ number_format($total_rbill,2,".",",") }} only in cash/cheque for the following accounts</h5>
                                </div>

                                <br>
                                @if(count($rent_bill))
                                    @foreach($rent_bill as $k2 => $v2)
                                    <div class="col-xs-12" style="text-align: left;">
                                    <p style="line-height: 24px;"> Rent( {{ date('F y', strtotime($v2['monthyear'])) }}) : {{$v2['rent']}} </p>
                                    </div>
                                    @endforeach
                                @endif

                                <div class="col-xs-12" style="text-align: left;">
                                    <div style="font-size: 18px">
                                        Rs. {{ number_format($total_rbill,2,".",",") }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        ( Rupees {{ $rent_bill_words}} ) only
                                    </div> 
                                </div>

                                <div class="col-xs-6"></div>
                                <div class="col-xs-5" style="text-align: center"><p> For Landlords of </p> <p><h4>VAISHALI COMPLEX</h4></p></div>
                                </div>
                            </div>
                        </div>
                        @endif
                        </div>

                        <button class="btn btn-success print_button" onclick="PrintElem('#print')" ><span class="glyphicon glyphicon-print"></span> PRINT 
                        </button>
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
        var css_path = '';
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        /*optional stylesheet*/ 
        css_path += "{{ asset('css/bootstrap.min.css') }}";
        mywindow.document.write('<link rel="stylesheet" href="'+css_path+'" type="text/css" />');
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