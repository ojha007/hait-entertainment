@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav',['navClass'=>'custom-nav'])
    <main class="mt-2 mb-5">
        <div class="container d-flex justify-content-center">
            <div class="col-md-5 bg-dark rounded-3  mt-4 ">
                <div class="card shadow-sm h-100 m-5">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title m-3">We are unable to process the transaction.</h3>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('frontend.layouts.footer')
@endsection
