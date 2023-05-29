<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>
                    <a href="{{ route('web.index') }}" target="_blank">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> @lang('Web Site') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('client.index') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> @lang('Dasboard') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('client.orders.index') }}">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> @lang('Orders') </span>
                    </a>
                </li>

              
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
