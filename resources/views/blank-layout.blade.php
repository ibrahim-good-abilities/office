<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>{{'Office'}}</title>
    <link rel="apple-touch-icon" href="{{asset('resources/images/favicon/apple-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('resources/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/vendors.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/css/themes/vertical-modern-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/css/themes/vertical-modern-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/fontawesome/css/regular.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/fontawesome/css/solid.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/css/loading.css')}}">
    <!-- END: Page Level CSS-->
    @yield("page_css")
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('resources/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns @yield('body_classes')" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    <script>
        var base_url = '{{ route("home") }}';
        var pusher_app_key ='{{env("PUSHER_APP_KEY")}}';
    </script>
    <!-- BEGIN: Header-->
    @include('header')  {{-- Include header file --}}
    <!-- END: Header-->


    <!-- BEGIN: SideNav-->
    @include('sidebar') {{-- Include sidebar file --}}
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        @yield("middle_content")
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->
    @include('footer') {{-- Include footer file --}}
    <!-- END: Footer-->


    <script src="{{asset('resources/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('resources/vendors/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/js/plugins.js')}}" type="text/javascript"></script>
    @yield("page_js")
    <script src="{{asset('resources/js/custom/custom-script.js')}}" type="text/javascript"></script>
</body>

</html>
