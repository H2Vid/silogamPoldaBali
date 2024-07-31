<div class="fbt-bottom-shape">
    <svg class="fbt-footer-wave-big" preserveAspectRatio="none" version="1.1" viewBox="5 0 1366 222" width="100%">
        <path
            d="M-2.19,238H1366v-4.27c-67.87-24-146.44-43.08-230.75-53.19-253.33-27.78-293.94,51.64-541.13,29.89C318.08,186.31,289.49,32.92,6.9,11.73c-5.21-.42-10.56-.7-15.9-1V238Z" 
            transform="translate(9.5 -10.22)">
        </path>
    </svg>
</div><!-- .fbt-bottom-shape -->

<div class="footer-dark pt-4" id="footer-content">
    <div class="container pb-4">
        <div class="row clearfix">
            <div class="col-lg-9">
                <div class="footer-1" id="footer-1">
                    <div class="logoImage">
                        <div class="widget-content">
                            <img alt="" src="{{ asset('assets/images/logo.png') }}" style="height:80px;">
                        </div>
                    </div>
                    <div class="widget Text">
                        <div class="widget-content">
                            <p>
                                Phasellus deserunt. Convallis perspiciatis fusce fermentum accumsan, arcu
                                aliquam, velit venenatis augue proin, enim etiam dolor.
                                Mi ac lectus vitae cum, fusce purus posuere.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 last">
                <div class="footer-4 section" id="footer-4">
                    <div class="widget">
                        <h4 class="title title-heading">
                            Kategori
                        </h4>
                        <div class="widget-content list-label-widget-content">
                            <ul class="list-unstyled">
                                @foreach (Category::getAll() as $category)
                                <li><a class="label-name" href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="credits">
        <div class="container">
            <div class="row divider py-4">
                <div class="col-lg-6">
                    <div class="copyright-section text-center text-lg-left">
                        © <script>document.write(new Date().getFullYear());</script> {{ Setting::get('general.title') }} | All Rights Reserved
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-menu section" id="footer-menu">
                        <div class="widget socialList">
                            <div class="widget-content">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-youtube-play"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- #footer-content -->