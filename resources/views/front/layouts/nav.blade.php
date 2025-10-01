<div class="navbar-area" id="stickymenu">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="" alt="">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('property-search') }}" class="nav-link">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agents') }}" class="nav-link">Agents</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('locations') }}" class="nav-link">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pricing') }}" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        </li>

                      @if(Auth::guard('web')->check())
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">Customer Dashboard</a>
                        </li>
                        @elseif(Auth::guard('agent')->check())
                        <li class="nav-item">
                            <a href="{{ route('agent_dashboard') }}" class="nav-link">Agent Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('select_user') }}" class="nav-link">Login</a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>