<!DOCTYPE html>
    <html class="loading" lang="en">
        @include('dashboard.includes.header')
    <body>
        @include('dashboard.includes.menu')
        <div class="m-5">
            @yield('dashboard.content')                        
        </div>
        @include('dashboard.includes.scripts')
        @include('dashboard.includes.footer') 
        @include('dashboard.includes.alerts')
    </body>
</html>