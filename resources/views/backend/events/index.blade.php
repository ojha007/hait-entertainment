@extends('backend.master')
@section('title_postfix')
    | Event Management
@endsection
@section('header')
    Event
@endsection
@section('subHeader')
    List
@endsection
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                All events are listed
            </h3>
            <div class="box-tools pull-right">
                <a href="{{route($routePrefix.'events.create')}}" class="btn btn-flat btn-sm btn-primary pull-right"
                   type="button">
                    <i class="fa fa-tasks"></i>
                    Add New Event
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Address/Venue</th>
                    <th>Date/Time</th>
                    <th>Event Type</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @inject('buttonHelper','App\Services\TableButtonService')
                @forelse($events as $event)
                    <tr>
                        <td>{{$event->title}}</td>
                        <td>{{$event->address}}</td>
                        <td>{{\Carbon\Carbon::parse($event->date)->format('d-M-Y')}}
                            {{\Carbon\Carbon::parse($event->time)->format('h:i A')}}
                        </td>
                        <td>{{$event->eventType->name}}</td>
                        <td>
                            {!! $buttonHelper->viewButton($routePrefix.'events.show',$event->id) !!}
                            {!! $buttonHelper->editButton($routePrefix.'events.edit',$event->id) !!}
                            {!! $buttonHelper->deleteButton($routePrefix.'events.destroy',$event->id) !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center text-bold " colspan="5">No Record Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
@endsection
