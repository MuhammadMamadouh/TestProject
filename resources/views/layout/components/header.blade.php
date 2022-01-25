  <!-- Page Header Start-->
  <div class="page-main-header">
    <div class="main-header-left">
        <div class="logo-wrapper"><a href="{{route('orders.index')}}" class="btn btn-info"><i class="right_side_toggle" data-feather="order"></i> Orders</a></div>
        <div class="logo-wrapper"><a href="{{route('trucks.index')}}" class="btn btn-info"><i class="right_side_toggle" data-feather="order"></i>Trucks</a></div>
    </div>
    <div class="main-header-right ">
        <div class="mobile-sidebar">
            <div class="media-body text-end switch-sm">
                <label class="switch">
                    <input id="sidebar-toggle" type="checkbox" checked="checked"><span class="switch-state"></span>
                </label>
            </div>
        </div>
        <div class="nav-right col">
            <ul class="nav-menus">
                <li>
                    <form class="form-inline search-form">
                        <div class="form-group">
                            <input class="form-control-plaintext" type="search" placeholder="Search.."><span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                        </div>
                    </form>
                </li>

                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>

                <li><a href="javascript:void(0)"><i class="right_side_toggle" data-feather="message-square"></i><span class="dot"></span></a></li>

            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
        </div>
    </div>
</div>
<!-- Page Header Ends -->
