<div class="clearfix"></div>
<!-- BEGIN SIDEBAR MENU -->
<ul id="menu" class="page-sidebar-menu">
    <li class="active">
        <a href="{{ route('admin_dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="brush" data-c="#F89A14" data-hc="#F89A14" data-size="18" data-loop="true"></i>
            <span class="title">Eelctricity Bill</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('bill.create')}}">
                    <i class="fa fa-angle-double-right"></i>
                    Add Bills
                </a>
            </li>
            <li>
                <a href="{{ route('bill.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    View Bills
                </a>
            </li>
        </ul>
    </li>

    <!-- <li>
        <a href=" {{ route('bill_payment.create') }}">
            <i class="livicon" data-name="map" data-c="#F89A55" data-hc="#F89A55" data-size="18" data-loop="true"></i>
            <span class="title">Generate bill</span>
            <span class="fa arrow-right"></span>
        </a>
    </li>

    <li>
        <a href=" {{ route('renter.notification') }}">
            <i class="livicon" data-name="map" data-c="#F89A55" data-hc="#F89A55" data-size="18" data-loop="true"></i>
            <span class="title">View Bill Notification</span>
            <span class="fa arrow-right"></span>
        </a>
    </li> -->
    

    <li>
         <a href="#">
            <i class="livicon" data-name="brush" data-c="#F89A14" data-hc="#F89A14" data-size="18" data-loop="true"></i>
            <span class="title">Pay Bills</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('bill_payment.rent.view_renters')}}">
                    <i class="fa fa-angle-double-right"></i>
                    Pay Rent Bill
                </a>
            </li>

            <li>
                <a href="{{ route('bill_payment.electricity.view_renters')}}">
                    <i class="fa fa-angle-double-right"></i>
                    Pay Electricity Bill
                </a>
            </li>

            <li>
                <a href=" {{ route('bill.report_search') }}">
                    <i class="livicon" data-name="barchart" data-c="#F89A55" data-hc="#F89A55" data-size="18" data-loop="true"></i>
                    <span class="title">Bill Payment Report</span>
                    <span class="fa arrow-right"></span>
                </a>
            </li>

        </ul>
        
    </li>
    <hr>
    <li>
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
            <span class="title">Unit Information</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('unit.create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Unit
                </a>
            </li>
            <li>
                <a href="{{ route('unit.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    View All Units
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="livicon" data-name="doc-portrait" data-c="#5bc0de" data-hc="#5bc0de" data-size="18" data-loop="true"></i>
            <span class="title">Renter Information</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('renter.create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Renter
                </a>
            </li>
            <li>
                <a href="{{ route('renter.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    View All renter
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="brush" data-c="#F89A14" data-hc="#F89A14" data-size="18" data-loop="true"></i>
            <span class="title">Electricity Units</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('electricity_units.create')}}">
                    <i class="fa fa-angle-double-right"></i>
                    Add 
                </a>
            </li>
            <li>
                <a href="{{ route('electricity_units.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    View 
                </a>
            </li>
        </ul>
    </li>
    

    
    
</ul>
<!-- END SIDEBAR MENU -->