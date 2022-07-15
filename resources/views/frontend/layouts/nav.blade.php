<nav class="navbar navbar-expand-lg custom-nav {{isset($navClass) ? 'custom-nav' :'home-nav' }}" id="navbar">
    <div class="container">
        <div class="row w-100">
            <div class="col-xl-5 col-md-3 col-12 image-col">
                <a class="navbar-brand d-inline-block" href="/">
                    <img src="{{asset('main-logo.png')}}" alt="{{config('app.name')}}">
                </a>
                <div class="nav-toggle-container block d-md-none">
                    <svg height="2rem" id="navbar-toggle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>
            </div>
            <div class="col-xl-7 col-md-9 col-12 nav-menu-col">
                <ul id="nav-menu-items" class="mb-0 nav-menu-items d-none d-md-flex">
                    <li>
                        <a href="{{url('/')}}"
                           class="{{request()->routeIs('index') ? 'active':""}} btn btn-sm">Home</a>
                    </li>
                    <li><a href="{{url('events')}}"
                           class=" {{request()->routeIs('events') ? 'active':""}} btn btn-sm">
                            Events
                        </a>
                    </li>
                    <li><a href="{{url('contact-us')}}"
                           class="{{request()->routeIs('contactUs') ? 'active':""}} btn btn-sm">Contact</a>
                    </li>
                    <a href="{{url('login')}}" class="btn btn-sm btn-outline-primary">Organizer
                        Desk</a>
                </ul>
            </div>
        </div>
    </div>
</nav>
