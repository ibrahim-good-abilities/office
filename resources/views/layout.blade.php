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
    <title>@yield('title')</title>
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
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">@yield('title')</h5>
                            <ol class="breadcrumbs mb-0">
                                @yield('breadcrumbs')
                            </ol>
                        </div>
                        @yield('settings')
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div class="card">
                            <div class="card-content">
                                @yield("middle_content")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->
    @include('footer') {{-- Include footer file --}}
    <!-- END: Footer-->
@yield('categories.categories')

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('resources/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('resources/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{ asset('resources/vendors/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('resources/js/scripts/ui-alerts.js')}}" type="text/javascript"></script>
    @yield("page_js")
    <script src="{{asset('resources/js/custom/custom-script.js')}}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>
