@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav',['navClass'=>'custom-nav home-nav'])
    <main>
        <section id="home" class="hero-section">
            <div id="demo2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="img-container">
                            <img src="./img/movies/thor-md.jpg" alt="user registered">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="service" class="movies-shows event-page">
            <div class="container">
                <div class="row row-cols-md-2 row-cols-1 justify-content-between mb-4 mb-md-0">
                    <div class="services-heading col mb-0">
                        <h1>Movies / Shows</h1>
                        <div class="heading-underline"></div>
                    </div>
                    <div class="col input-col">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="movieFilter"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Filter
                            </button>
                            <ul class="dropdown-menu  py-4 dropdown-menu-dark dropdown-menu-end rounded"
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

                <div
                    class="row g-3 row-cols-xs-1 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 card-container movie-card">
                    @foreach($events as $event)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('events.show',$event->id)}}">
                                        <div class="img-container">
                                            <img src="{{$event->image}}" alt="{{$event->title}}"/>
                                            <div class="img-overlay">
                                                <button class="book-tkt"></button>
                                            </div>
                                        </div>
                                    </a>
                                    <h4>{{$event->title}}</h4>
                                    <div class="d-flex">
                                        <a href="{{route('events.show',$event->id)}}" class="btn btn-md btn-primary">Buy tickets</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    @include('frontend.layouts.footer')
@endsection
