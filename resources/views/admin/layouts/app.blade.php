<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.10
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <!-- Icons-->
    <link href="/node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{!! URL::asset('css/admin/style.css') !!}" rel="stylesheet">
    <link href="../../../../public/css/admin/style.css" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    @yield('head')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
@include('admin.layouts.header')
<div class="app-body">
    @include('admin.layouts.side-nav')

    @include('admin.layouts.main')

    <flash message="{{ session('flash') }}"></flash>
</div>

<!-- CoreUI and necessary plugins-->
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/pace-progress/pace.min.js"></script>
<script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
</body>
</html>
