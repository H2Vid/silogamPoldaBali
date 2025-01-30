
<div class="mx-10 mt-10 pt-4" id="footer-content">
    <div class="container pb-4">
        <div class="row clearfix">
            <div class="col-lg-9">
                <div class="footer-1" id="footer-1">
                    <div class="logoImage">
                        <div class="widget-content mb-3">
                            <img alt="" src="{{ asset('assets/images/LOGO SDM.png') }}" style="height:80px;">
                        </div>
                    </div>

                    <p class="text-white">Silogam (Sistem Informasi Sumber Daya Manusia Dalam Genggaman) adalah media/aplikasi yang dikembangkan sebagai Knowledge Management System (KMS) berbasis website. SILOGAM merupakan salah satu wujud dan peran manajemen pengetahuan guna mendukung manajemen kinerja fungsi sumber daya manusia.</p>
                </div>
            </div>

            <div class="col-lg-3 last">
                <div class="footer-4 section" id="footer-4">
                    <div class="widget text-white">
                        <h4 class="text-white">
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
        <div class="container text-white">
            <div class="row divider py-4">
                <div class="col-lg-6">
                    <div class="copyright-section text-center text-lg-left">
                        © <script>document.write(new Date().getFullYear());</script> {{ Setting::get('general.title') }} | All Rights Reserved
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </div>
</div><!-- #footer-content -->