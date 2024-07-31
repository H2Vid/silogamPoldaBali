<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ titleGenerate($title ?? null) }}</title>
<meta name="robots" content="noindex">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/bootstrap/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/footable.standalone.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/fullcalendar@5.2.0.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/jquery.mCustomScrollbar.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/line-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/wickedpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/vendor_assets/datatable/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/style.css') }}">
<link rel="stylesheet" href="{{ asset('cms_assets/custom.css?v=' . time()) }}">
<link rel="icon" type="image/png" href="{{ Setting::getURL('general.favicon', asset(config('cms.site_square_logo'))) }}">
@stack ('style')
<script src="{{ asset('cms_assets/vendor_assets/js/jquery/jquery-3.5.1.min.js') }}"></script>
