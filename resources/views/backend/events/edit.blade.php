@extends('backend.master')
@section('title_postfix')
    | Event Management
@endsection
@section('header')
    Event
@endsection
@section('subHeader')
    Edit
@endsection
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Event</h3>
            <a href="{{route($routePrefix.'events.index')}}" title="Return back to list"
               class="btn btn-default btn-flat pull-right">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
        {!! Form::model($event,['route'=>[$routePrefix.'events.update',$event->id],'method'=>'PATCH','files'=>true]) !!}
        <div class="box-body">
            @include('backend.events.partials.form')
        </div>
        <div class="box-footer">
            <button class="btn btn-flat btn-default pull-left" type="reset">
                <i class="fa fa-undo"></i>Reset
            </button>
            <button type="submit" class="btn btn-flat btn-primary pull-right">
                <i class="fa fa-save"></i>
                Update
            </button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
