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
    <div class="box box-default">
        @if($bookings)
            <div class="box-header with-border">
                <h3 class="box-title">
                    All booking are listed here.
                </h3>
                <div class="box-body table-responsive">
                    <div class="text-center text-bold">
                        <h3>{{$event->title}}</h3>
                        <div class="col-md-3">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <td>Ticket Type</td>
                                    <td>Total Seat</td>
                                    <td>Available Seat</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($event->pricing as $pricing)
                                    <tr>
                                        <td>{{$pricing->ticket->name}}</td>
                                        <td>{{$pricing->seat}}</td>
                                        <td>{{$pricing->availableSeat($pricing->ticket_type_id)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ticket Type</th>
                            <th>No of Seat</th>
                            <th>Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{$booking->name}}</td>
                                <td>{{$booking->email}}</td>
                                <td>{{$booking->phone}}</td>
                                <td>{{$booking->ticketType}}</td>
                                <td>{{$booking->seat_quantity}}</td>
                                <td>{{$booking->token_id}}</td>
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

            <div class="box-header with-border">
                <h3 class="box-title">
                    Select event to view all the booking related to the event
                </h3>
                {!! Form::open(['route'=>'internal.bookings.index','method'=>'get']) !!}
                <div class="box-body table-responsive">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('Select Event') !!}
                            {!! Form::select('event_id',$events,null,['class'=>'form-control select2']) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-flat btn-md" type="submit">
                        <i class="fa fa-filter"></i>
                        Filter
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        @endif
    </div>
@endsection
