@extends('backend.master')
@section('title_postfix')
    | Bookings
@endsection
@section('header')
    Booking
@endsection
@section('subHeader')
    Show
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Booking Details</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-flat btn-primary btn-sm">
                            <i class="fa fa-check"></i>
                            Check In
                        </button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Customer Name</th>
                            <td>{{$booking->first()->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$booking->first()->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$booking->first()->phone}}</td>
                        </tr>
                        <tr>
                            <th>Event Name</th>
                            <td>{{$booking->first()->eventName}}</td>
                        </tr>
                        <tr>
                            <th>Event Type</th>
                            <td>{{$booking->first()->eventType}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
