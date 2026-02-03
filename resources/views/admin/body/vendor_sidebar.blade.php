@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
<aside class="navbar-aside" id="offcanvas_aside" style="background-color: #FFECCA;">
    <div class="aside-top">
        <a href="{{ route('admin.dashboard') }}" class="brand-wrap">
            @php
                $logo = get_setting('site_footer_logo');
            @endphp
            @if ($logo != null)
                <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}"
                    style="height: 30px !important; width: 100px !important; min-width: 100px !important;">
            @else
                <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                    style="height: 30px !important; width: 80px !important; min-width: 80px !important;">
            @endif
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="fa fa-arrow-left text-white"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ $route == 'admin.dashboard' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-house fontawesome_icon_custom"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li
                class="menu-item has-submenu

                        {{ $route == 'withdraw-requests.index' ? 'active' : '' }}
                        {{ $route == 'withdraw-requests.create' ? 'active' : '' }}
                        {{ $route == 'transaction.index' ? 'active' : '' }}">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-attach_money"></i>
                    <span class="text">Affliate Accounts</span>
                </a>
                <div class="submenu">
                    <a class="{{ $route == 'withdraw-requests.index' ? 'active' : '' }}"
                        href="{{ route('withdraw-requests.index') }}">Withdrawal Requests</a>
                    <a class="{{ $route == 'withdraw-requests.create' ? 'active' : '' }}"
                        href="{{ route('withdraw-requests.create') }}">Add Withdrawal Request</a>
                    <a class="{{ $route == 'transaction.index' ? 'active' : '' }}"
                        href="{{ route('transaction.index') }}">View Transactions</a>
                </div>
            </li>


        </ul>
        <hr />
        <br />
        <br />
        {{--        <div class="sidebar-widgets"> --}}
        {{--           <div class="copyright text-center m-25"> --}}
        {{--              <p> --}}
        {{--                 <strong class="d-block">Admin Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved --}}
        {{--              </p> --}}
        {{--           </div> --}}
        {{--        </div> --}}
    </nav>
</aside>
