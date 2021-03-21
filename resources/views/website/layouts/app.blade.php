<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('website.includes.header')

<body>
    @yield('website-content')
    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
    @include('website.includes.scripts')
    @include('dashboard.includes.alerts')
</body>

</html>
