<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>
                    <a href="{{ route('admin.index') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> @lang('Dasboard') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> @lang('Users') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> @lang('Categories') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.categories.multi') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> @lang('Categories multi') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.products.index') }}">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> @lang('Products') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders.index') }}">
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
