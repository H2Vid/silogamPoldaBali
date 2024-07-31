<footer class="footer-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-copyright">
                    <p>{{ date('Y') }} @<a href="#">{{ Setting::get('general.title', config('cms.site_title')) }}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-menu text-right">
                    <ul>
                        <li>
                            <a href="#" onclick="window.location.reload()">Reload Page</a>
                        </li>
                    </ul>
                </div>
                <!-- ends: .Footer Menu -->
            </div>
        </div>
    </div>
</footer>