@php
   $id = Auth::user()->id;
   $adminData = App\Models\User::find($id);
   $user = Auth::user();
   $reviewCount = Auth::user()->unreadNotifications()->count()
@endphp



<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

{{--            <li class="d-none d-lg-block">--}}
{{--                <form class="app-search">--}}
{{--                    <div class="app-search-box dropdown">--}}
{{--                        <div class="dropdown-menu dropdown-lg" id="search-dropdown">--}}
{{--                                               <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <i class="fe-home me-1"></i>--}}
{{--                                <span>Analytics Report</span>--}}
{{--                            </a>--}}


{{--                            <!-- item-->--}}
{{--                            <div class="dropdown-header noti-title">--}}
{{--                                <h6 class="text-overflow mb-2 text-uppercase">Пользователи</h6>--}}
{{--                            </div>--}}

{{--                            <div class="notification-list">--}}
{{--                                <!-- item-->--}}
{{--                                <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                    <div class="d-flex align-items-start">--}}
{{--                                        <img class="d-flex me-2 rounded-circle" src="{{ asset('backend/assets/images/users/user-2.jpg') }}" alt="Generic placeholder image" height="32">--}}
{{--                                        <div class="w-100">--}}
{{--                                            <h5 class="m-0 font-14">Erwin E. Brown</h5>--}}
{{--                                            <span class="font-12 mb-0">UI Designer</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}


{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </li>--}}

{{--            <li class="dropdown notification-list topbar-dropdown">--}}
{{--                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">--}}
{{--                    <i class="fe-bell noti-icon"></i>--}}
{{--                    <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $reviewCount }}</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-end dropdown-lg">--}}

{{--                    <!-- item-->--}}
{{--                    <div class="dropdown-item noti-title">--}}
{{--                        <h5 class="m-0">--}}
{{--                            <span class="float-end">--}}
{{--                                <a href="" class="text-dark">--}}
{{--                                    <small>Очистить все</small>--}}
{{--                                </a>--}}
{{--                            </span>Уведомление--}}
{{--                        </h5>--}}
{{--                    </div>--}}

{{--                    <div class="noti-scroll" data-simplebar>--}}



{{--                        @forelse($user->notifications as $notification)--}}
{{--                        <!-- item-->--}}
{{--                        <a href="{{ route('pending.review')}}" class="dropdown-item notify-item active">--}}
{{--                            <div class="notify-icon">--}}
{{--                                <img src="{{ asset('backend/assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" /> </div>--}}
{{--                            <p class="notify-details">{{ $notification->data['message'] }}</p>--}}
{{--                            <p class="text-muted mb-0 user-msg">--}}
{{--                                <small>{{ Carbon\Carbon::parse( $notification->created_at)->diffForHumans() }}</small>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        @empty--}}

{{--                        @endforelse--}}

{{--                    </div>--}}

{{--                    <!-- All-->--}}
{{--                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">--}}
{{--                        Посмотреть все--}}
{{--                        <i class="fe-arrow-right"></i>--}}
{{--                    </a>--}}

{{--                </div>--}}
{{--            </li>--}}



            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ ( !empty($adminData->photo)) ? url('upload/images/admin/'.$adminData->photo): url('upload/no-image.jpg') }}"
                         class="rounded-circle"
                         alt="profile-image"
                         id="showImage"
                    >
                    <span class="pro-user-name ms-1">   {{  $adminData->name }} <i class="mdi mdi-chevron-down"></i>   </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Добро пожаловать !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('admin.profile') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Мой аккаунт</span>
                    </a>

                    <a href="{{ route('admin.change.password') }}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Изменить пароль</span>
                    </a>


                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Выйти</span>
                    </a>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{ route('admin.dashboard') }}" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ '/'. $siteSettings->logo }}" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                <span class="logo-lg">
                                <img src="{{ '/'. $siteSettings->logo }}" alt="" height="50">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{ '/'. $siteSettings->logo }}" alt="" height="70">
                            </span>
                <span class="logo-lg">
                                <img src="{{ '/'. $siteSettings->logo }}" alt="" height="70">
                            </span>
            </a>

        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
