@extends('backend.master')
@section('title_postfix')
    | Bookings
@endsection
@section('header')
    Bookings
@endsection
@section('subHeader')
    Event
@endsection
@section('content')
    @if($bookings)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Seat Overview</h3>
                    </div>
                    <div class="box-body">
                        @foreach($event->pricing as $pricing)
                            @php($availableSeat = $pricing->availableSeat($pricing->ticket_type_id))
                            @php($bookedSeat = ($pricing->seat -$availableSeat)  * 100 /$pricing->seat)
                            <div class="col-md-4">
                                <div class="progress-group">
                                    <span class="progress-text">{{$pricing->ticket->name}}</span>
                                    <span
                                        class="progress-number"><b>{{$pricing->seat - $availableSeat}}</b>/{{$pricing->seat}}</span>
                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-{{progressBarColor($bookedSeat)}}"
                                             style="width: {{$bookedSeat}}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">
                    All booking are listed here.
                </h3>
            </div>
            <div class="box-body table-responsive">
                <h3>{{$event->title}}</h3>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Ticket Type</th>
                        <th>No of Seat</th>
                        {{--                        <th>Code</th>--}}
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @inject('buttonHelper','App\Services\TableButtonService')
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{$booking->name}}</td>
                            <td>{{$booking->email}}</td>
                            <td>{{$booking->phone}}</td>
                            <td>{{$booking->ticketType}}</td>
                            <td>{{$booking->seat_quantity}}</td>
                            <td>
                                {!! $buttonHelper->viewButton($routePrefix.'bookings.show',$booking->token_id) !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-bold">No Booking found for the events.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer"></div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Select event to view all the booking related to the event
                        </h3>
                    </div>
                    {!! Form::open(['route'=>'internal.bookings.index','method'=>'get']) !!}
                    <div class="box-body table-responsive">
                        {{--                            <div class="col-md-6">--}}
                        <div class="form-group col-md-6">
                            {!! Form::label('Select Event') !!}
                            {!! Form::select('event_id',$events,null,['class'=>'form-control select2','placeholder'=>'Select Event ']) !!}
                        </div>
                        {{--                            </div>--}}
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary btn-flat btn-md" type="submit">
                            <i class="fa fa-filter"></i>
                            Filter
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif

@endsection
