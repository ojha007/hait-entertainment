@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav')
    <main>
        <section id="home" class="hero-section">
            <div id="demo2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($sliderImages as $key=>$image)
                        <button type="button" data-bs-target="#demo2" data-bs-slide-to="{{$key}}"
                                class="{{$key==0 ?'active':""}}"
                                aria-current="{{$key == 0 ? 'true':'false'}}"
                                aria-label="Slide {{$key +1}}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($sliderImages as $key=>$image)
                        <div class="carousel-item {{$key==0 ? 'active':''}}">
                            <div class="img-container">
                                <img src="{{asset($image->url)}}" alt="{{$image->title}}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo2"
                        data-bs-slide="prev">
                    <span class="ic-chevron-left text-gray-500 fs-2"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo2"
                        data-bs-slide="next">
                    <span class="ic-chevron-right text-gray-500 fs-2"></span>
                </button>
            </div>
        </section>

        <section id="service" class="movies-shows">
            <div class="container">
                <div class="row row-cols-md-2 row-cols-1 justify-content-between mb-4 mb-md-0">
                    <div class="services-heading col mb-0">
                        <h1>Movies / Shows</h1>
                        <div class="heading-underline"></div>
                    </div>
                    <div class="col input-col">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="movieFilter"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Filter
                            </button>
                            <ul class="dropdown-menu px-2  py-4 dropdown-menu-dark dropdown-menu-end rounded"
                                aria-labelledby="movieFilter">
                                <li class="input-col dropdown-item">
                                    <div class="form-group">
                                        <i class="ic-search"></i>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg bg-transparent"
                                            placeholder="Search...."
                                        >
                                    </div>
                                </li>
                                <li class="dropdown-item form-group ">
                                    <label> State </label>
                                    <select class="form-select form-select-lg bg-transparent text-white">
                                        <option class="bg-transparent" value="1">One</option>
                                        <option class="bg-transparent" value="2">Two</option>
                                        <option class="bg-transparent" value="3">Three</option>
                                    </select></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row g-3 row-cols-xs-1 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5  card-container">
                    @foreach($events as $event)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="img-container">
                                        <img src="{{$event->image}}" alt="{{$event->title}}"/>
                                        <div class="img-overlay">
                                            <button class="book-tkt"></button>
                                        </div>
                                    </div>
                                    <h4>{{$event->title}}</h4>
                                    <p class="my-2">
                                        {{\Carbon\Carbon::parse($event->date)->format('d M Y')}}
                                        {{\Carbon\Carbon::parse($event->time)->format('h:i A')}}
                                    </p>
                                    <div class="d-flex">
                                        <button class="btn btn-md btn-outline-primary">Buy Tickets</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="testimonial" class="testimonial">

            <div class="container">
                <div class="services-heading align-items-center">
                    <h1>Testimonial</h1>
                    <div class="heading-underline"></div>
                    <p class="text-center">What out client have to say?</p>
                </div>

                <div id="demo3" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testimonial-content">
                                <div class="img-container">
                                    <img src="./img/user.png" alt="user registered">
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt
                                    ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris
                                    nisi ut aliquip
                                    ex
                                    ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu
                                    fugiat
                                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt
                                    mollit
                                    anim id est laborum.
                                </p>
                                <p class="name">- Hari Kumar Poudel, Business Owner</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-content">
                                <div class="img-container">
                                    <img src="./img/user.png" alt="user registered">

                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt
                                    ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris
                                    nisi ut aliquip
                                    ex
                                    ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu
                                    fugiat
                                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt
                                    mollit
                                    anim id est laborum.
                                </p>
                                <p class="name">- Hari Kumar Poudel, Business Owner</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-content">
                                <div class="img-container">
                                    <img src="./img/user.png" alt="user registered">

                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt
                                    ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris
                                    nisi ut aliquip
                                    ex
                                    ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu
                                    fugiat
                                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt
                                    mollit
                                    anim id est laborum.
                                </p>
                                <p class="name">- Hari Kumar Poudel, Business Owner</p>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo3"
                            data-bs-slide="prev">
                        <span class="ic-caret-left text-gray-500 fs-2"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo3"
                            data-bs-slide="next">
                        <span class="ic-caret-right text-gray-500 fs-2"></span>
                    </button>
                </div>
            </div>
        </section>


        <section id="faqs" class="faqs">

            <div class="container">
                <div class="services-heading">
                    <h4 class="text-primary">Frequently Asked Questions</h4>
                    <h1 class="mt-3">Have Questions? <br> <b>We are here to Help.</b></h1>
                </div>
                <div class="faqs-accordion ">
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-transparent" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    WHAT IS REGISTERED REMIT ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Registered Remit is a money transfer service that ensures to provide a secure way of
                                    sending money to
                                    Nepal.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button bg-transparent collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    WHY SHOULD I CHOOSE REGISTERED REMIT ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Registered Remit assures to provide fast, easy and reliable remittance facility. We
                                    offer attractive
                                    exchange rate and two hours payment in Nepal* (Fees and restriction apply. Please
                                    visit
                                    our T&C page).
                                    More importantly, we believe in providing value and security to customers.
                                    Registered
                                    Remit definitely
                                    guarantees to be the best choice for sending money to your loves ones in Nepal.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bg-transparent collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    WHY SHOULD I CHOOSE REGISTERED REMIT ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Registered Remit assures to provide fast, easy and reliable remittance facility. We
                                    offer attractive
                                    exchange rate and two hours payment in Nepal* (Fees and restriction apply. Please
                                    visit
                                    our T&C page).
                                    More importantly, we believe in providing value and security to customers.
                                    Registered
                                    Remit definitely
                                    guarantees to be the best choice for sending money to your loves ones in Nepal.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="partners" class="our-partners">
            <div class="container">
                <div class="services-heading align-items-center">
                    <h1>Our Partners</h1>
                    <div class="heading-underline"></div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="our-partners-slick-container">
                        <div class="img-container">
                            <img src="./img/sponsor-20.jpg" alt="">
                        </div>
                        <div class="img-container">
                            <img src="./img/partner-11.jpg" alt="">
                        </div>
                        <div class="img-container">
                            <img src="./img/sponsor-20.jpg" alt="">
                        </div>
                        <div class="img-container">
                            <img src="./img/partner-11.jpg" alt="">
                        </div>
                        <div class="img-container">
                            <img src="./img/sponsor-20.jpg" alt="">
                        </div>
                        <div class="img-container">
                            <img src="./img/partner-11.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('frontend.layouts.footer')
@endsection
