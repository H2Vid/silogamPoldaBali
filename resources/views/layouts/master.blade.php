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

        <div class="outer-wrapper clearfix" id="outer-wrapper">
            <div class="container fbt-elastic-container">
                <div class="row justify-content-center">
                    @yield ('content')
                </div>
            </div>
        </div>


        @include ('layouts.partials.footer')
    </div><!-- #page-wrapper end -->
    @include ('layouts.partials.script')
</body>

</html>