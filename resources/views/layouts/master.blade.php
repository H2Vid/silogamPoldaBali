<!DOCTYPE html>
<html lang="en">
@include ('layouts.partials.metadata')
<body class="bg-black">
    <div class="loading">
        <div class="loader"></div>
    </div>
    <div id="page-wrapper" class="four-columns-wide feed-view mt-0">
        @include ('layouts.partials.header')

        @stack ('hero')

                <div >
                    @yield ('content')
                </div>
        </div>


        @include ('layouts.partials.footer')
    </div><!-- #page-wrapper end -->
    @include ('layouts.partials.script')
</body>

</html>