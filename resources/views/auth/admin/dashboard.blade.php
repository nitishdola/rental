@extends('layouts.admin_default')
@section('title') Dashboard @stop
@section('pageTitle') Dashboard @stop
@section('content')
<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
    <!-- Trans label pie charts strats here-->
    <div class="lightbluebg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-7 text-right">
                        <span>Views Today</span>
                        <div class="number" id="myTargetElement1"></div>
                    </div>
                    <i class="livicon  pull-right" data-name="eye-open" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <small class="stat-label">Last Week</small>
                        <h4 id="myTargetElement1.1"></h4>
                    </div>
                    <div class="col-xs-6 text-right">
                        <small class="stat-label">Last Month</small>
                        <h4 id="myTargetElement1.2"></h4>
                    </div>
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
                        <span>Today's Sales</span>
                        <div class="number" id="myTargetElement2"></div>
                    </div>
                    <i class="livicon pull-right" data-name="piggybank" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <small class="stat-label">Last Week</small>
                        <h4 id="myTargetElement2.1"></h4>
                    </div>
                    <div class="col-xs-6 text-right">
                        <small class="stat-label">Last Month</small>
                        <h4 id="myTargetElement2.2"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
    <!-- Trans label pie charts strats here-->
    <div class="palebluecolorbg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-7 pull-left">
                        <span>Registered Users</span>
                        <div class="number" id="myTargetElement4"></div>
                    </div>
                    <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <small class="stat-label">Last Week</small>
                        <h4 id="myTargetElement4.1"></h4>
                    </div>
                    <div class="col-xs-6 text-right">
                        <small class="stat-label">Last Month</small>
                        <h4 id="myTargetElement4.2"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
    <!-- Trans label pie charts strats here-->
    <div class="palebluecolorbg no-radius">
        <div class="panel-body squarebox square_boxs">
            <div class="col-xs-12 pull-left nopadmar">
                <div class="row">
                    <div class="square_box col-xs-7 pull-left">
                        <span>Registered Users</span>
                        <div class="number" id="myTargetElement4"></div>
                    </div>
                    <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <small class="stat-label">Last Week</small>
                        <h4 id="myTargetElement4.1"></h4>
                    </div>
                    <div class="col-xs-6 text-right">
                        <small class="stat-label">Last Month</small>
                        <h4 id="myTargetElement4.2"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
