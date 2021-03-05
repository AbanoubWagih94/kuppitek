<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ $page_name == 'dashboard' ? 'active' : ''}}">
<<<<<<< HEAD
                <a href="{{url('/dashboard')}}">
=======
                <a href="{{url('dashboard')}}">
>>>>>>> 562035a9656416f6964f6b66c4e71496c2813570
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.changelog.main">لوحة التحكم</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="animation.html">
                    <i class="la la-institution"></i>
                    <span class="menu-title" data-i18n="nav.animation.main">الموقع</span>
                </a>
            </li>
            <li class="nav-item {{ $department_name == 'institutes' ? 'open' : '' }}">
                <a href="#">
                    <i class="la la-institution"></i>
                    <span class="menu-title" data-i18n="nav.navbars.main">مينو رئيسي 1 </span>
                </a>
                <ul class="menu-content">
                <li class="{{ $page_name == 'institute' ? 'active' : ''}}">
                        <a class="menu-item" href="#" data-i18n="nav.navbars.nav_light"> فرعي 1</a>
                    </li> 
                     <li class="{{ $page_name == 'institute' ? 'active' : ''}}">
                        <a class="menu-item" href="#" data-i18n="nav.navbars.nav_light"> فرعي2</a>
                    </li>
                    <li class="{{ $page_name == 'institute' ? 'active' : ''}}">
                        <a class="menu-item" href="#" data-i18n="nav.navbars.nav_light"> فرعي 3</a>
                    </li>
                    
                </ul>
            </li>

            <li class="nav-item {{ $department_name == 'institutes' ? 'open' : '' }}">
                <a href="#">
                    <i class="la la-institution"></i>
                    <span class="menu-title" data-i18n="nav.navbars.main">مينو رئيسي 2 </span>
                </a>
                <ul class="menu-content">
                <li class="{{ $page_name == 'institute' ? 'active' : ''}}">
                        <a class="menu-item" href="#" data-i18n="nav.navbars.nav_light"> فرعي 1</a>
                    </li> 
                     <li class="{{ $page_name == 'institute' ? 'active' : ''}}">
                        <a class="menu-item" href="#" data-i18n="nav.navbars.nav_light"> فرعي2</a>
                    </li>
                    <li class="{{ $page_name == 'institute' ? 'active' : ''}}">
                        <a class="menu-item" href="#" data-i18n="nav.navbars.nav_light"> فرعي 3</a>
                    </li>
                    
                </ul>
            </li>
            
           
        </ul>
    </div>
</div>
