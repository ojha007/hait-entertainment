@extends('backend.master')
@section('title_postfix')
    | Dashboard
@endsection
@section('header')
    Dashboard
@endsection
@section('subHeader')
    Home
@endsection
@section('content')

    <div class="row">
        @include('backend.dashboard.count-widget')
    </div>
@endsection
