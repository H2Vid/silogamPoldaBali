<header class="header-top">
    <nav class="navbar navbar-light">
        <div class="navbar-left">

            <a class="navbar-brand" href="#">
                @if (Setting::get('general.logo_wide'))
                    <img class="dark" src="{{ Setting::getURL('general.logo_wide') }}" alt="black">
                    <img class="light" src="{{ Setting::getURL('general.logo_wide') }}" alt="light">
                @else
                    <img class="dark" src="{{ asset('img/logo-wide.png') }}" alt="black">
                    <img class="light" src="{{ asset('img/logo-wide.png') }}" alt="light">
                @endif
            </a>
            @if (config('cms.feature.enable_global_search'))
            <form action="/" class="search-form">
                <span data-feather="search"></span>
                <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
            </form>
            @endif
        </div>
        <!-- ends: navbar-left -->

        <div class="navbar-right">
            <ul class="navbar-right__menu">
                @if (config('cms.feature.enable_global_search'))
                <li class="nav-search d-none">
                    <a href="#" class="search-toggle">
                        <i class="la la-search"></i>
                        <i class="la la-times"></i>
                    </a>
                    <form action="/" class="search-form-topMenu">
                        <span class="search-icon" data-feather="search"></span>
                        <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
                    </form>
                </li>
                @endif

                @if (config('cms.feature.enable_notification'))
                <li class="nav-notification">
                    <div class="dropdown-custom">
                        <a href="javascript:;" class="nav-item-toggle">
                            <span data-feather="bell"></span></a>
                        <div class="dropdown-wrapper">
                            <h2 class="dropdown-wrapper__title">Notifications <span class="badge-circle badge-warning ml-1">4</span></h2>
                            <ul>
                                <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                    <div class="nav-notification__type nav-notification__type--primary">
                                        <span data-feather="inbox"></span>
                                    </div>
                                    <div class="nav-notification__details">
                                        <p>
                                            <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                            <span>sent you a message</span>
                                        </p>
                                        <p>
                                            <span class="time-posted">5 hours ago</span>
                                        </p>
                                    </div>
                                </li>
                                <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                    <div class="nav-notification__type nav-notification__type--secondary">
                                        <span data-feather="upload"></span>
                                    </div>
                                    <div class="nav-notification__details">
                                        <p>
                                            <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                            <span>sent you a message</span>
                                        </p>
                                        <p>
                                            <span class="time-posted">5 hours ago</span>
                                        </p>
                                    </div>
                                </li>
                                <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                    <div class="nav-notification__type nav-notification__type--success">
                                        <span data-feather="log-in"></span>
                                    </div>
                                    <div class="nav-notification__details">
                                        <p>
                                            <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                            <span>sent you a message</span>
                                        </p>
                                        <p>
                                            <span class="time-posted">5 hours ago</span>
                                        </p>
                                    </div>
                                </li>
                                <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                    <div class="nav-notification__type nav-notification__type--info">
                                        <span data-feather="at-sign"></span>
                                    </div>
                                    <div class="nav-notification__details">
                                        <p>
                                            <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                            <span>sent you a message</span>
                                        </p>
                                        <p>
                                            <span class="time-posted">5 hours ago</span>
                                        </p>
                                    </div>
                                </li>
                                <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                    <div class="nav-notification__type nav-notification__type--danger">
                                        <span data-feather="heart"></span>
                                    </div>
                                    <div class="nav-notification__details">
                                        <p>
                                            <a href="" class="subject stretched-link text-truncate" style="max-width: 180px;">James</a>
                                            <span>sent you a message</span>
                                        </p>
                                        <p>
                                            <span class="time-posted">5 hours ago</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <a href="" class="dropdown-wrapper__more">See all incoming activity</a>
                        </div>
                    </div>
                </li>
                @endif

                @if (config('cms.feature.enable_language'))
                <li class="nav-flag-select">
                    <div class="dropdown-custom">
                        <a href="javascript:;" class="nav-item-toggle"><img src="{{ asset('img/flag.png') }}" alt="" class="rounded-circle"></a>
                        <div class="dropdown-wrapper dropdown-wrapper--small">
                            <a href=""><img src="{{ asset('img/eng.png') }}" alt=""> English</a>
                            <a href=""><img src="{{ asset('img/ind.png') }}" alt=""> Indonesian</a>
                        </div>
                    </div>
                </li>
                <!-- ends: .nav-flag-select -->
                @endif

                <?php
                $user = CMS::adminUser();
                ?>
                @if ($user)
                <li class="nav-author">
                    <div class="dropdown-custom">
                        <?php
                        $user_image = asset('img/default-user.png');
                        if ($user->image) {
                            if (Storage::exists($user->image)) {
                                $user_image = Storage::url($user->image);
                            }
                        }
                        ?>
                        <a href="javascript:;" class="nav-item-toggle"><img src="{{ $user_image }}" alt="" class="rounded-circle"></a>
                        <div class="dropdown-wrapper">
                            <div class="nav-author__info">
                                <div class="author-img">
                                    <img src="{{ $user_image }}" alt="" class="rounded-circle">
                                </div>
                                <div>
                                    <h6>{{ $user->name }}</h6>
                                    <span>
                                        @foreach ($user->roles as $role)
                                            <span>{{ $role->name }}</span>
                                            @if (!$loop->last)
                                            ,
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="nav-author__options">
                                <ul>
                                    <li>
                                        <a href="{{ route('cms.profile') }}" class="ajax-priority"><span data-feather="user"></span> Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cms.change-password') }}" class="ajax-priority"><span data-feather="key"></span> Change Password</a>
                                    </li>
                                    @if (Permission::has('cms.setting'))
                                    <li>
                                        <a href="{{ route('cms.setting') }}">
                                            <span data-feather="settings"></span> Settings</a>
                                    </li>
                                    @endif
                                </ul>
                                <a href="{{ route('cms.auth.logout') }}" class="nav-author__signout">
                                    <span data-feather="log-out"></span> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- ends: .dropdown-wrapper -->
                    </div>
                </li>
                <!-- ends: .nav-author -->
                @endif
            </ul>
            <!-- ends: .navbar-right__menu -->
            @if (config('cms.feature.enable_global_search'))
            <div class="navbar-right__mobileAction d-md-none">
                <a href="#" class="btn-search">
                    <span data-feather="search"></span>
                    <span data-feather="x"></span></a>
                <a href="#" class="btn-author-action">
                    <span data-feather="more-vertical"></span></a>
            </div>
            @endif
        </div>
        <!-- ends: .navbar-right -->
    </nav>
</header>