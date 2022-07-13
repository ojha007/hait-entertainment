@extends('backend.master')
@section('title_postfix')
    | Event Management
@endsection
@section('header')
    Event
@endsection
@section('subHeader')
    View
@endsection
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3></h3>
            <div class="box-tools pull-right">
                <a href="{{route($routePrefix.'events.index')}}" class="btn btn-flat btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <h2>{{$event->title}}</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <i class="fa fa-calendar"></i>
                        {{\Carbon\Carbon::parse($event->date)->format('d-M-Y')}}&nbsp;
                        @if($event->time)
                            &nbsp;<i class="fa fa-clock-o"></i>
                            {{\Carbon\Carbon::parse($event->time)->format('h:i A')}}
                        @endif
                    </div>
                    <div class="col-md-6">

                        <p><i class="fa fa-map-marker"></i>
                            {{$event->address}}</p>
                    </div>
                </div>
                <hr>
                {!!  $event->description !!}
                <hr>
                <h4>Event Type:</h4>
                <span class="label label-success">{{$event->eventType->name}}</span>
                <hr>
                <h4>
                    Pricing:
                </h4>
                <div class="pricing">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ticket</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($event->pricing as $pricing)
                            <tr>
                                <td>{{$pricing->ticket->name}}</td>
                                <td>{{$pricing->rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="box-footer">
            <a href="{{route($routePrefix.'events.edit',$event->id)}}" class="btn btn-flat btn-primary btn-sm pull-right">
                <i class="fa fa-edit"></i>
                Edit
            </a>
        </div>
    </div>
@endsection
