@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav',['navClass'=>'custom-nav'])
    <main>
        <section class="contact-form">
            <div class="services-heading align-items-center">
                <h1>Check Out</h1>
                <p class="text-center">Make sure you provide true information while doing checkout.</p>
                <div class="heading-underline"></div>
                <div class="container">
                    <div class="form-content row row-cols-1 row-cols-lg-2 bg-dark rounded-3  mt-4">
                        <div class="col info-col">
                            <div class="h-100 d-flex flex-column">
                                <div>
                                    <h1>{{$event->title}}</h1>
                                    @if($event->organizer) <p>Organize By {{$event->organizer}}</p> @endif
                                </div>
                                <ul class="mt-3 contact-info">
                                    <li class="h4"><i class="ic-marker mr-3"></i>{{$event->address}}</li>
                                    <li class="h4 date">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        {{\Carbon\Carbon::parse($event->date)->format('d M Y')}}
                                        {{\Carbon\Carbon::parse($event->time)->format('h:i A')}}
                                    </li>
                                </ul>
                                <div class="mt-5 border rounded-3 p-3">
                                    @foreach($event->pricing ?? [] as $pricing)
                                        @if(array_key_exists($pricing->id,$requestPricing ?? []))
                                            <div class="d-flex justify-content-between align-items-start mt-3">
                                                <div>
                                                    <h3>{{$pricing->ticket->name}}</h3>
                                                    <h4 class="text-gray-500 mt-3">Per Ticket:
                                                        ${{$pricing->rate}}
                                                    </h4>
                                                </div>
                                                <div class="counter-btn-container mt-3">
                                                    <div class="input-group seatRate" data-rate="{{$pricing->rate}}">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-sm btn-minus pt-2" type="button">
                                                                <i class="ic-minus"></i>
                                                            </button>
                                                        </div>
                                                        {!! Form::number('pricing['.$pricing->id.']',$requestPricing[$pricing->id],['class'=>'form-control seatSelected','min'=>'0','style'=>'width:55px']) !!}
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-plus pt-2" type="button">
                                                                <i class="ic-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-start mt-3">
                                        <div><h4>Total :</h4></div>
                                        <div><h4> $ {{number_format($total,1)}}</h4></div>
                                    </div>
                                </div>
                                <small class="m-1">Note: Qr Code will be send on your email after verifying your
                                    payment.</small>

                            </div>
                        </div>
                        <div class="col mt-4 mt-lg-0">
                            <div class="form-col">
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
                                        <input type="text" placeholder="9XXXXXXXXX" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Message*</label>
                                        <textarea class="form-control" rows="3"
                                                  draggable="false"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-primary btn px-4 d-flex align-items-center">
                                            <span>Checkout </span><i
                                                class="ic-caret-right ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('frontend.layouts.footer')
@endsection
