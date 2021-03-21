<!DOCTYPE html>
    <html class="loading" lang="en">
        @include('dashboard.includes.header')
    <body>
        @include('dashboard.includes.menu')
        <div id="sat_app_vue">
            @yield('dashboard.content')                        
        </div>
        @include('dashboard.includes.scripts')
        @include('dashboard.includes.footer') 
        @include('dashboard.includes.alerts')
    </body>
</html>