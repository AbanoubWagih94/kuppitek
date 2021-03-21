<!-- fixed-top-->
<div class="container-fluid">
    <div class="navbar">
        <img src="{{ asset('assets/images/Kuppitek-Logo-xxsmall-TR.png') }}" alt="Kuppitek Logo" class="logo">
        <nav>
            <ul>
                <li><a href="{{ url('dashboard/') }}" title="Homepage"><i class="fas fa-home fa-lg"></i></a></li>
                <li><a href="#" title="Settings"><i class="fas fa-cogs fa-lg"></i></a></li>
                @if (session()->has('userLogin'))
                    <li><a href="{{ url('dashboard/logout') }}" title="Settings"><i class="fas fa-sign-out-alt fa-lg"></i></a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
