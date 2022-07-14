@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav')
    <main>
        <section class="contact-form">
            <div class="services-heading align-items-center">
                <h1>Contact</h1>
                <div class="heading-underline"></div>
                <p class="text-center">Any question or feedback or Suggestion? Leave a message</p>
                <div class="container">
                    <div class="form-content row row-cols-1 row-cols-lg-2 bg-dark rounded-3  mt-4">
                        <div class="col info-col">
                            <div class="h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <h1>Contact Us</h1>
                                    <h4 class="mt-3">Fill up the form and <br> our team will get back soon.</h4>
                                </div>
                                <ul class="mt-5 contact-info">
                                    <li>
                                        <i class="ic-marker"></i>
                                        306/343 Little Collins Street,
                                        Melbourne VIC
                                    </li>
                                    <li class="mt-5">
                                        <a href="tel:+0424451758">
                                            <i class="ic-phone"></i>
                                            0424451758
                                        </a>
                                    </li>
                                    <li class="mt-5">
                                        <a href="mailto:hait_entertainment@gmail.com">
                                            <i class="ic-envelope"></i>
                                            0424451758
                                        </a>
                                    </li>
                                </ul>
                                <ul class="mt-5 social-info">
                                    <li><a href="https://www.facebook.com/registeredremit"><i
                                                class="ic-facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com/registered_remit"><i
                                                class="ic-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
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
