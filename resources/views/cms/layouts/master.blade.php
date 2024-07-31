<!doctype html>
<html lang="en" dir="ltr">

<head>
    @include ('cms.layouts.partials.metadata')
</head>

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
        </form>
    </div>

    <div class="mobile-author-actions"></div>

    @include ('cms.layouts.partials.header')

    <main class="main-content">
        <aside class="sidebar-wrapper">
            @include ('cms.layouts.partials.sidebar')
        </aside>

        <div class="contents mt-3" id="main-page-content">
            @yield ('content')
        </div>
        @include ('cms.layouts.partials.footer')
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
    @include ('cms.layouts.partials.modal')
    @include ('cms.layouts.partials.script')
</body>

</html>