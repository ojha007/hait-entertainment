<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img class="img-responsive user-image"
             src="{{  asset('backend/images/user-logo.jpg')}}"
             alt="{{ auth()->user()->name }}">
        <span class="hidden-xs">{{auth()->user()->name}}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img class="img-circle"
                 src="{{  asset('backend/images/user-logo.jpg')}}"
                 alt="{{ auth()->user()->name }}">
            <p>{{auth()->user()->name}}
                <small>{{auth()->user()->email}}</small>
                <small>{{auth()->user()->phone}}</small>
                <small>{{\Carbon\Carbon::parse(auth()->user()->created_at)->diffForHumans()}}</small>
            </p>
            <br>
        </li>

        <li class="user-footer">
            <div class="pull-left">
{{--                <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>--}}
            </div>
            <div class="pull-right">
                {!! Form::open(['route'=>'logout']) !!}
                <button type="submit"
                        class="btn btn-default btn-flat">
                    Sign out
                </button>
                {!! Form::close() !!}
            </div>
        </li>
    </ul>
</li>

