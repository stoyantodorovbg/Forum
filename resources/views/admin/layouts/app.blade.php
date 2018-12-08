<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <link href="{!! URL::asset('css/admin/style.css') !!}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!}
    </script>
    @yield('head')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div id="app">
        @include('admin.layouts.header')
        <div class="app-body">
            @include('admin.layouts.side-nav')

            @include('admin.layouts.main')

            <flash message="{{ session('flash') }}"></flash>
        </div>
    </div>
</body>
</html>
