<!-- Sidebar -->
<div class="sidebar" data-color="orange" data-background-color="white">
    <!-- Brand Logo -->
    <div class="logo flex-column logo-normal">
        <div class="">
            @php $logo = App\SiteSetting::where('name','logo')->pluck('value')->first(); @endphp

        </div>
        <div>
            <a href="{{ url('/') }}" class="simple-text logo-normal">
                <img src="{{ url('/assets/logo/' . $logo) }}" height="50" width="50">

            </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper">
        <ul class="nav" data-widget="treeview" role="menu" data-accordion="false">
            @if (in_array('dashboard', $permission))
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
            @endif
            @if (in_array('challanges', $permission))
                <li class="nav-item {{ request()->is('dashboard/challanges*') ? 'active' : '' }}">
                    <a href="{{ route('admin.challanges.index') }}" class="nav-link">
                        <p>
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                            <span>{{ trans('challanges') }}</span>
                        </p>
                    </a>
                </li>
            @endif
            {{-- <li class="nav-item {{ request()->is('dashboard/challange-result*') ? 'active' : '' }}">
                <a href="{{ route('admin.challange-result') }}" class="nav-link">
                    <p>
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                        <span>{{ trans('Challanges Result') }}</span>
                    </p>
                </a>
            </li> --}}
            @if (in_array('pages', $permission))
                <li class="nav-item {{ request()->is('dashboard/pages') ? 'active' : '' }}">
                    <a href="{{ route('admin.pages.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-file-alt"></i>
                            <span>{{ trans('global.pages') }}</span>
                        </p>
                    </a>
                </li>
            @endif
            @if (in_array('withdrwal_request', $permission))
                <li class="nav-item {{ request()->is('dashboard/wihdrawal-request') ? 'active' : '' }}">
                    <a href="{{ route('admin.wihdrawal-request.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-donate"></i>
                            <span>{{ trans('global.withdrawal_requests') }} @if (isset($TransactionData) && count($TransactionData) > 0)
                                    ({{ count($TransactionData) }})
                                @endif
                            </span>
                        </p>
                    </a>
                </li>
            @endif
            @if (in_array('fund_request', $permission))
                <li class="nav-item {{ request()->is('dashboard/fund-request') ? 'active' : '' }}">
                    <a href="{{ route('admin.fund-request.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-donate"></i>
                            <span>{{ trans('global.fund_requests') }}</span>
                        </p>
                    </a>
                </li>
            @endif
            {{-- @if (in_array('kyc_documents', $permission)) --}}
                <li class="nav-item {{ request()->is('dashboard/kyc-documents') ? 'active' : '' }}">
                    <a href="{{ route('admin.kyc-documents.index') }}" class="nav-link">
                        <p>
                            <i class="fas fa-donate"></i>
                            <span>KYC Document List</span>
                        </p>
                    </a>
                </li>
            {{-- @endif --}}
            <li class="nav-item {{ request()->is('dashboard/challange-type') ? 'active' : '' }}">
                <a href="{{ route('admin.challange-type.index') }}" class="nav-link">
                    <p>
                        <i class="fa fa-file" aria-hidden="true"></i>
                        <span>Challange Type</span>
                    </p>
                </a>
            </li>
            @if (in_array('users', $permission))
                <li
                    class="nav-item {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <p>
                            <i class="fa-fw fas fa-user"></i>
                            <span>{{ trans('cruds.user.title') }}</span>
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="fa-fw fas fa-user"></i>
                    <span>{{ trans('cruds.user.title') }}</span>
                </a>
            </li> -->
            @endif
            @if (in_array('settings', $permission))
                <li class="nav-item {{ request()->is('dashboard/site-seting*') ? 'active' : '' }}">
                    <a href="{{ route('admin.site-seting.index') }}" class="nav-link">
                        <p>
                            <i class="fa fa-cog"></i>
                            <span>Site setings</span>
                        </p>
                    </a>

                </li>
            @endif

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <p>
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        <span>{{ trans('global.logout') }}</span>
                    </p>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
