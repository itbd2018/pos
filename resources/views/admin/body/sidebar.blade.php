@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
<style>
    .submenu {
        background-color: #FF914D !important;
    }

    .submenu a:before {
        content: none !important;
    }

    .submenu a {
        padding-right: 0 !important;
    }
</style>
<aside class="navbar-aside" id="offcanvas_aside" style="background-color: white;">
    <div class="aside-top">
        <a href="{{ route('admin.dashboard') }}" class="brand-wrap">
            @php
                $logo = get_setting('site_logo');
            @endphp
            @if ($logo != null)
                <img src="{{ asset(get_setting('site_logo')->value ?? ' ') }}" alt="{{ env('APP_NAME') }}"
                    style="height: 40px !important; width:100px !important; min-width: 100px !important;">
            @else
                <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                    style="height: 30px !important; width: 80px !important; min-width: 80px !important;">
            @endif
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="fa fa-arrow-left text-black"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ $route == 'admin.dashboard' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('admin.dashboard') }}" style="background-color: transparent">
                    <i class="fa-solid fa-house fontawesome_icon_custom"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>


            {{-- product menu --}}
            @php
                $user = Auth::guard('admin')->user();
                $staffRolePermissions = [];

                if ($user->role != '1' && isset($user->staff->role->permissions)) {
                    $staffRolePermissions = json_decode($user->staff->role->permissions, true);
                    $staffRolePermissions = array_map('strval', $staffRolePermissions);
                }
                // All permission IDs related to product menu
                $productPermissions = ['1', '2', '3', '4', '5'];

                // Check if user has any product-related permission
                $hasProductPermission =
                    $user->role == '1' || count(array_intersect($productPermissions, $staffRolePermissions)) > 0;
            @endphp
            <li
                class="menu-item has-submenu
                    {{ $prefix == 'admin/product' || $prefix == 'admin/category' || $prefix == 'admin/unit' || $route == 'attribute.index' || $prefix == 'admin/brand' ? 'active' : '' }}
                ">
                @if ($hasProductPermission)
                    <a class="menu-link" href="#">
                        <i class="fa-solid fa-cart-shopping fontawesome_icon_custom"></i>
                        <span class="text">Products</span>
                    </a>
                @endif

                <div class="submenu vendor-submenu">
                    @if ($user->role == '1' || in_array('1', $staffRolePermissions))
                        <a class="{{ $route == 'product.add' ? 'active' : '' }}"
                            href="{{ route('product.add') }}">Product Add</a>
                    @endif

                    @if ($user->role == '1' || in_array('2', $staffRolePermissions))
                        <a class="{{ $route == 'product.all' ? 'active' : '' }}"
                            href="{{ route('product.all') }}">Products</a>
                    @endif

                    @if (Auth::guard('admin')->user()->role == '1' ||
                            in_array('9', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                        <a class="{{ $prefix == 'admin/category' ? 'active' : '' }}"
                            href="{{ route('category.index') }}">Brand</a>
                    @endif
                </div>
            </li>

            <li class="menu-item has-submenu {{ $prefix == 'admin/supplier' ? 'active' : '' }}">
                @if (Auth::guard('admin')->user()->role == '1' ||
                        in_array('45', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                    <a class="menu-link " href="#">
                        <i class="fas fa-truck fontawesome_icon_custom"></i>
                        <span class="text">Suppliers</span>
                    </a>
                @endif
                <div class="submenu vendor-submenu">
                    @if (Auth::guard('admin')->user()->role == '1' ||
                            in_array('45', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                        <a class="{{ $route == 'supplier.all' ? 'active' : '' }}"
                            href="{{ route('supplier.all') }}">Supplier List</a>
                    @endif
                    @if (Auth::guard('admin')->user()->role == '1' ||
                            in_array('46', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                        <a class="{{ $route == 'supplier.create' ? 'active' : '' }}"
                            href="{{ route('supplier.create') }}">Supplier Add</a>
                    @endif
                </div>
            </li>

            <li
                class="menu-item has-submenu
            {{ $route == 'all_orders.index' ? 'active' : '' }}
            {{ $route == 'order.cancellation.requests' ? 'active' : '' }}
            ">
                @if (Auth::guard('admin')->user()->role == '1' ||
                        in_array('17', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                    <a class="menu-link" href="#">
                        <i class="fas fa-list fontawesome_icon_custom"></i>
                        <span class="text">Sales</span>
                    </a>
                @endif
                <div class="submenu">
                    @if (Auth::guard('admin')->user()->role == '1' ||
                            in_array('17', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                        <a class="{{ $route == 'all_orders.index' ? 'active' : '' }}"
                            href="{{ route('all_orders.index') }}">All Orders</a>
                    @endif
                    @if (Auth::guard('admin')->user()->role == '1')
                        <a class="d-none{{ $route == 'order.cancellation.requests' ? 'active' : '' }}"
                            href="{{ route('order.cancellation.requests') }}">Orders Cancellation Request</a>
                    @endif
                </div>
            </li>


            {{-- <li class="menu-item has-submenu d-none {{ $route == 'return-request.all' ? 'active' : '' }}">
                @if (Auth::guard('admin')->user()->role == '1')
                    <a class="menu-link" href="#">
                        <i class="fas fa-exchange fontawesome_icon_custom"></i>
                        <span class="text">Return Requests</span>
                    </a>
                @endif
                <div class="submenu">
                    @if (Auth::guard('admin')->user()->role == '1')
                        <a class="{{ $route == 'return-request.all' ? 'active' : '' }}"
                            href="{{ route('return-request.all') }}">All Requests</a>
                    @endif
                </div>
            </li> --}}

            {{-- <li
                class="menu-item has-submenu
                {{ $route == 'staff.index' ? 'active' : '' }}
                {{ $route == 'staff.create' ? 'active' : '' }}
                {{ $route == 'staff.edit' ? 'active' : '' }}
                {{ $route == 'roles.index' ? 'active' : '' }}
                {{ $route == 'roles.create' ? 'active' : '' }}
                {{ $route == 'roles.edit' ? 'active' : '' }}
            ">
                @if (Auth::guard('admin')->user()->role == '1' || in_array('25', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                    <a class="menu-link" href="#">
                        <i class="fas fa-people-group fontawesome_icon_custom"></i>
                        <span class="text">Staff</span>
                    </a>
                @endif
                <div class="submenu">
                    @if (Auth::guard('admin')->user()->role == '1' || in_array('25', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                        <a class="{{ $route == 'staff.index' ? 'active' : '' }}" href="{{ route('staff.index') }}">All
                            Staff</a>
                    @endif
                    @if (Auth::guard('admin')->user()->role == '1' || in_array('29', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                        <a class="{{ $route == 'roles.index' ? 'active' : '' }}"
                            href="{{ route('roles.index') }}">Staff Premissions</a>
                    @endif
                </div>
            </li> --}}

            @if (Auth::guard('admin')->user()->role == '1')
                <li
                    class="menu-item has-submenu
                {{ $route == 'stock_report.index' ? 'active' : '' }}
            ">
                    <a class="menu-link" href="#">
                        <i class="fas fa-file-text fontawesome_icon_custom"></i>
                        <span class="text">Report</span>
                    </a>
                    <div class="submenu vendor-submenu">
                        <a class="{{ $route == 'stock_report.index' ? 'active' : '' }}"
                            href="{{ route('stock_report.index') }}">Product Stock</a>
                    </div>
                </li>
            @endif


            @if (Auth::guard('admin')->user()->role == '1')
                <li
                    class="menu-item has-submenu
                {{ $route == 'pos.index' ? 'active' : '' }}
            ">
                    <a class="menu-link" href="#">
                        <i class="fas fa-file-text fontawesome_icon_custom"></i>
                        <span class="text">Pos</span>
                    </a>
                    <div class="submenu vendor-submenu">
                        <a class="{{ $route == 'pos.index' ? 'active' : '' }}" href="{{ route('pos.index') }}">Product
                            Pos</a>
                    </div>
                </li>
            @endif


            @if (Auth::guard('admin')->user()->role == '1')
                <li
                    class="menu-item has-submenu
                {{ $route == 'customer.index' ? 'active' : '' }}
                ">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Customers</span>
                    </a>

                    <div class="submenu">
                        <a class="{{ $route == 'customer.index' ? 'active' : '' }}"
                            href="{{ route('customer.index') }}">Customer list</a>
                    </div>
                </li>
            @endif

            {{-- @if (Auth::guard('admin')->user()->role == '1')
                <li
                    class="menu-item has-submenu
                {{ $route == 'coupons.index' ? 'active' : '' }}
                {{ $route == 'coupons.create' ? 'active' : '' }}
                {{ $route == 'coupons.edit' ? 'active' : '' }}
            ">
                    <a class="menu-link" href="#">
                        <i class="fa-solid fa-ticket fontawesome_icon_custom"></i>
                        <span class="text">Coupons</span>
                    </a>
                    <div class="submenu">
                        <a class="{{ $route == 'coupons.index' ? 'active' : '' }}"
                            href="{{ route('coupons.index') }}">Coupon List</a>
                        <a class="{{ $route == 'coupons.create' ? 'active' : '' }}"
                            href="{{ route('coupons.create') }}">Coupon Add</a>
                    </div>
                </li>
            @endif --}}
        </ul>
        <hr />
        @if (Auth::guard('admin')->user()->role == '1')
            <ul class="menu-aside">
                <li
                    class="menu-item has-submenu
                {{ $route == 'setting.index' ? 'active' : '' }}
                {{ $route == 'shipping.index' ? 'active' : '' }}
                {{ $route == 'shipping.create' ? 'active' : '' }}
                {{ $route == 'shipping.edit' ? 'active' : '' }}
                ">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-settings"></i>
                        <span class="text">Settings</span>
                    </a>
                    <div class="submenu">
                        <a class="{{ $route == 'setting.index' ? 'active' : '' }}"
                            href="{{ route('setting.index') }}">Home</a>
                        {{-- {{-- <a class="{{ ($route == 'setting.activation') ? 'active':'' }}" href="{{ route('setting.activation') }}">Activation</a> --}}
                        {{-- <a class="{{ $route == 'shipping.index' || $route == 'shipping.create' || $route == 'shipping.edit' ? 'active' : '' }}"
                            href="{{ route('shipping.index') }}">Shipping Methods</a> --}}
                        {{-- <a class="{{ ($route == 'paymentMethod.config') ? 'active':'' }}" href="{{ route('paymentMethod.config') }}">Payment Methods</a> --}}
                    </div>
                </li>
            </ul>
        @endif


        {{-- <br />
        <br /> --}}
        {{-- <div class="sidebar-widgets">
           <div class="copyright text-center m-25">
              <p>
                 <strong class="d-block">Admin Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved
              </p>
           </div>
        </div> --}}
    </nav>
</aside>
