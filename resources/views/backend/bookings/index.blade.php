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
        <div class="box-header with-border">
            <h3 class="box-title">
                All booking are listed here.
            </h3>
            <div class="box-body">
                {!! Form::open(['route'=>$routePrefix.'bookings.store','method'=>'POST']) !!}
                <button type="submit">SAVE</button>
                {!! Form::close() !!}
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
@endsection
