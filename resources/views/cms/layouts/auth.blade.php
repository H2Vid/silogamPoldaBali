<!doctype html>
<html lang="en" dir="ltr">

<head>
    @include ('cms.layouts.partials.metadata')
</head>

<body class="layout-light side-menu overlayScroll">
    <main class="main-content">
        <div class="signUP-admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-5 col-md-5 p-0">
                        <?php
                        $login_background = Setting::get('general.login_background');
                        ?>
                        @if ($login_background)
                        <div class="signUP-admin-left signIn-admin-left position-relative" style="background:url('{{ Storage::url($login_background) }}') no-repeat; background-size:cover;"></div>
                        @else
                        <div class="signUP-admin-left signIn-admin-left position-relative" style="background:url('{{ asset('img/login-screen.jpg') }}') no-repeat; background-size:cover;"></div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-8" id="main-page-content">
                        @yield ('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>
    @stack ('modal')
    @include ('cms.layouts.partials.script')
</body>

</html>