<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-fixed-top">
    <div class="container-fluid">
        @php
            $logo = \App\Models\BusinessSetting::where('key', 'logo')->first();
        @endphp
        <a class="navbar-brand" href="/">
            @if ($logo)
            <img src="{{ asset('storage/business/' . $logo->value) }}" alt="SmartNest Logo" width="100">
            @else
            <img src="{{ asset('assets/img/logo.png') }}" alt="SmartNest Logo" width="100">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('about-us') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('finance') ? 'active' : '' }}" href="{{ route('finance.index') }}">Finance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('meal-planning') ? 'active' : '' }}" href="{{ route('meal-planning.index') }}">Meal Planning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('relationship-management') ? 'active' : '' }}" href="{{ route('relationship-management.index') }}">Relationship Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">Contact Us</a>
                </li>
                
                @if (auth()->check())
                <!--<li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Profile</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Log Out</a></li>
                    <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                </li>
                @endif
                
            </ul>
        </div>
    </div>
</nav>