@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav',['navClass'=>'custom-nav'])
    <main class="mt-2 mb-5">
        <div class="container d-flex justify-content-center">
            <div class="col-md-5 bg-dark rounded-3  mt-4 ">
                <div class="card shadow-sm h-100 m-5">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title m-3">Transaction Received.</h3>
                    </div>
                    <div class="card-image m-3">
                        <div class="hover-text">
                            <div class="qrCode d-flex justify-content-center">
                                {!! $qrCode !!}
                            </div>
                        </div>
                        <div class="image-overlay"></div>
                    </div>
                    <div class="card-body m-3">
                        <h5>Dear name.</h5>
                        <p class="card-text">This is a confirmation that we have received your payment.</p>
                        <p class="card-text">Please bring this qr code while visiting the location.</p>
                    </div>

                    <div class="card-footer py-3 justify-content-center d-flex m-3 flex-column">
                        <button class="btn btn-primary ">
                            <i class="ic-envelope"></i>
                            Send Me
                        </button>
                        <p>Note: Please dont refresh the page unless you download or get your Qr code on
                            email.</p>
                    </div>

                </div>
            </div>
        </div>
    </main>
    @include('frontend.layouts.footer')
@endsection
