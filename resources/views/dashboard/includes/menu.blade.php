<!-- fixed-top-->
<div class="container-fluid">
    <div class="navbar">

        @if (session()->has('userLogin') && session('userLogin')->role_id == 1)
            <a href="{{ url('dashboard/') }}" title="Homepage">
            @elseif (session()->has('userLogin') && session('userLogin')->role_id == 2)
                <a href="{{ url('dashboard/cashier') }}" title="Homepage">
                @elseif (session()->has('userLogin') && session('userLogin')->role_id == 3)
                    <a href="{{ url('dashboard/waiter') }}" title="Homepage">
                    @elseif(session()->has('userLogin') && session('userLogin')->role_id == 4)
                        <a href="{{ url('dashboard/kitchen') }}" title="Homepage">
        @endif
        <img src="{{ asset('assets/images/Kuppitek-Logo-xxsmall-TR.png') }}" alt="Kuppitek Logo" class="logo"></a>
        <nav>
            <ul>
                <li><a href="javascript:history.back()" title="Back"><i class="fas fa-arrow-circle-left fa-lg"></i></a>
                </li>
                <li>
                    @if (session()->has('userLogin') && session('userLogin')->role_id == 1)
                        <a href="{{ url('dashboard/') }}" title="Homepage">
                            @elseif (session()->has('userLogin') && session('userLogin')->role_id == 2)
                                <a href="{{ url('dashboard/cashier') }}" title="Homepage">
                                @elseif (session()->has('userLogin') && session('userLogin')->role_id == 3)
                                    <a href="{{ url('dashboard/waiter') }}" title="Homepage">
                                    @elseif(session()->has('userLogin') && session('userLogin')->role_id == 4)
                                        <a href="{{ url('dashboard/kitchen') }}" title="Homepage">
                                            @endif<i class="fas fa-home fa-lg"></i></a>
                </li>
                <li><a href="#" title="Settings"><i class="fas fa-cogs fa-lg"></i></a></li>
                @if (session()->has('userLogin'))
                    <li><a href="{{ url('dashboard/logout') }}" title="Logout"><i
                                class="fas fa-sign-out-alt fa-lg"></i></a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
