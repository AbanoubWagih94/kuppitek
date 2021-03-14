<!DOCTYPE html>
    <html class="loading" lang="en">
        @include('dashboard.includes.header')
    <body>
        @include('dashboard.includes.menu')
        <div id="sat_app_vue">
            @yield('dashboard.content')                        
        </div>
        @include('dashboard.includes.footer') 
        @include('dashboard.includes.alerts')
        @yield('admin.custom-js-scripts')
    </body>
</html>