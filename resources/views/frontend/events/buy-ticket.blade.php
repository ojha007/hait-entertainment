@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav',['navClass'=>'custom-nav'])
    <main>
        <section class="contact-form">
            <div class="services-heading align-items-center">
                <h1>Checkout</h1>
                <div class="heading-underline"></div>
                <p class="text-center"></p>
                <div class="container">
                    <div class="form-content row row-cols-1 row-cols-lg-2 bg-dark rounded-3  mt-4">
                        <div class="col form-col">
                            <form class="w-100">
                                <div class="form-group">
                                    <label>Name*</label>
                                    <input type="text" placeholder="Your Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email*</label>
                                    <input type="email" placeholder="example@example.com" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone*</label>
                                    <input type="number" placeholder="9XXXXXXXXX" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Message*</label>
                                    <textarea placeholder="Message..." class="form-control" rows="3"
                                              draggable="false"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn-primary btn px-4 d-flex align-items-center">
                                        <span>Send Message </span><i
                                            class="ic-caret-right ml-2"></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('frontend.layouts.footer')
@endsection
