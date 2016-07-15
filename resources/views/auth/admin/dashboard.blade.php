@extends('layouts.admin_default')
@section('title') Dashboard @stop
@section('pageTitle') Dashboard @stop
@section('content')
<style>
    .number a {
        color: #FFF;
    }
</style>
<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
    <!-- Trans label pie charts strats here-->
    <div class="palebluecolorbg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-7 pull-left">
                        <span>Renters</span>
                        <div class="number"><a href="{{ route('renter.index') }}"> {{ $renters }}</a></div>
                    </div>
                    <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
    <!-- Trans label pie charts strats here-->
    <div class="lightbluebg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-7 text-right">
                        <span>Units</span>
                        <div class="number"><a href="{{ route('unit.index') }}"> {{ $units }}</a></div>
                    </div>
                    <i class="livicon  pull-right" data-name="fa-home" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
    <!-- Trans label pie charts strats here-->
    <div class="redbg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-7 pull-left">
                        <span>Bills Added</span>
                        <div class="number"><a href="{{ route('bill.index') }}">{{ $bills }}</a></div>
                    </div>
                    <i class="livicon pull-right" data-name="piggybank" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-5 fadeInUpBig">
    <!-- Trans label pie charts strats here-->
    <div class="lightbluebg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-12 pull-left">
                        <div class="number"><a href="{{ route('bill_payment.create') }}">GENERATE BILL</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-5 fadeInUpBig">
    <!-- Trans label pie charts strats here-->
    <div class="lightbluebg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-12 pull-left">
                        <div class="number" style="text-align: center;"><a href="{{ route('renter.notification') }}">BILL NOTIFICATION</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
