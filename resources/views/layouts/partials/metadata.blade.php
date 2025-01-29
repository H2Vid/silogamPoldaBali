<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title : Setting::get('general.title') }}</title>
	<link rel="icon" href="{{ asset('assets/images/LOGO SDM.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900%7CNunito:400,700%7COswald%7CRoboto" rel="stylesheet">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    @stack ('style')
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>