<section class="sidebar" style="height: auto;">
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{request()->routeIs($routePrefix.'.dashboard') ? 'active' : ''}}">
            <a href="{{route($routePrefix.'dashboard')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="{{request()->routeIs($routePrefix.'.carousals',$routePrefix.'carousals.*') ? 'active' : ''}}">
            <a href="{{route($routePrefix.'carousals.index')}}">
                <i class="fa fa-image"></i>
                <span>Slider Image</span>
            </a>
        </li>
        <li class="{{request()->routeIs($routePrefix.'.events',$routePrefix.'events.*') ? 'active' : ''}}">
            <a href="{{route($routePrefix.'events.index')}}">
                <i class="fa fa-tasks"></i>
                <span>Events</span>
            </a>
        </li>
        <li class="{{request()->routeIs($routePrefix.'.bookings',$routePrefix.'bookings.*') ? 'active' : ''}}">
            <a href="{{route($routePrefix.'bookings.index')}}">
                <i class="fa fa-calendar-plus-o"></i>
                <span>Bookings</span>
            </a>
        </li>
        <li class="header">CONFIGURATION</li>
        <li class="{{request()->routeIs($masterRoute.'tickets.*') ? 'active' : ''}}">
            <a href="{{route($masterRoute.'tickets.index')}}">
                <i class="fa fa-ticket"></i>
                <span>Ticket Setup</span>
            </a>
        </li>
        <li class="{{request()->routeIs($masterRoute.'event-types.*') ? 'active' : ''}}">
            <a href="{{route($masterRoute.'event-types.index')}}">
                <i class="fa fa-hand-grab-o"></i>
                <span>Event Type</span>
            </a>
        </li>
    </ul>
</section>
