@foreach($widgets as $widget)
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon {{$widget['color']}}">
            <i class="{{$widget['icon']}}"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{$widget['title']}}</span>
                <span class="info-box-number">{{$widget['count']}}</span>
            </div>

        </div>
    </div>
@endforeach
