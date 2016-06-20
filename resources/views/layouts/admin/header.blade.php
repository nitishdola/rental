<style>
a.logo{
    color: #FFF !important;
    font-weight: bold;
    font-size: 22px;
}
</style>
<a href="{{ route('admin_dashboard') }}" class="logo">
    Rental Management
</a>
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <div>
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <div class="responsive_nav"></div>
        </a>
    </div>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="riot">
                        <div>
                            Admin
                            <span>
                                <i class="caret"></i>
                            </span>
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href=" {{ route('admin.logout') }}">
                            <i class="livicon" data-name="sign-out" data-s="18"></i>
                                Logout
                        </a>
                    </li>
                    
                </ul>
            </li>
        </ul>
    </div>
</nav>