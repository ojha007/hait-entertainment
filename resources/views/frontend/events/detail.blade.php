@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav',['navClass'=>'custom-nav home-nav'])
    <main>
        <div class="top-bg-image">
            <div class="img-container">
                <img src="{{asset($event->image)}}" alt="{{$event->title}}">
            </div>
        </div>
        <section class="detail-header">
            <div class="container">
                <div class="mb-4 movie-header">
                    <h1 class="mb-2">{{$event->title}}</h1>
                    <h4 class="">They're back and better than ever.</h4>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="img-container">
                            <img src="{{$event->image}}" alt="{{$event->title}}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 text-col">
                        <ul class="pl-0">
                            <li class="h4"><i class="ic-marker mr-3"></i>{{$event->address}}
                            </li>
                            <li class="h4 date">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                          clip-rule="evenodd"/>
                                </svg>
                                {{\Carbon\Carbon::parse($event->date)->format('d M Y')}}
                            </li>
                        </ul>
                        <div class="event-description">
                            {!! $event->description !!}
                        </div>
                        {!! Form::open(['route'=>['events.checkOut',$event->id],'method'=>'POST']) !!}

                        <div class="mt-5 border rounded-3 p-3">
                            @foreach($event->pricing as $key=>$pricing)
                                @php($availableSeat = $pricing->availableSeat($pricing->ticket_type_id))
                                @if($key==0)
                                    <div class="d-flex justify-content-between align-items-start mt-3">
                                        <h2>Select your desired ticket.</h2>
                                        <button class="btn btn-primary btn-md" type="submit">Buy Ticket</button>
                                    </div>
                                @endif
                                @if($availableSeat < 1)
                                    <div class="d-flex justify-content-end align-items-end mt-3">
                                        <p class="badge bg-danger p-2">Sold Out </p>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between align-items-start mt-3">
                                    <div>
                                        <h3>{{$pricing->ticket->name}}</h3>
                                        <h4 class="text-gray-500 mt-3">Per Ticket: ${{$pricing->rate}}</h4>
                                    </div>
                                    @if($availableSeat > 0)
                                        <div>
                                            <div class="counter-btn-container mt-3">
                                                <div class="input-group seatRate" data-rate="{{$pricing->rate}}">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-sm btn-minus pt-2" type="button">
                                                            <i class="ic-minus"></i>
                                                        </button>
                                                    </div>
                                                    {!! Form::number('pricing['.$pricing->id.']',0,['class'=>'form-control seatSelected','min'=>'0','style'=>'width:55px','max'=>$availableSeat]) !!}
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm btn-plus pt-2" type="button">
                                                            <i class="ic-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            {!! Form::close() !!}
                            <hr>
                            <div class="d-flex justify-content-between align-items-start mt-3">
                                <div>
                                    <h3>Total</h3>
                                </div>
                                <div>
                                    <div class="mx-3">
                                        <h4 class="totalAmount">$ 0.0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container movie-container">
            <div
                class="row g-3 row-cols-xs-1 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 card-container movie-card">
                @foreach($upcomingEvents as $event)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route('events.show',$event->id)}}">
                                    <div class="img-container">
                                        <img src="{{asset($event->image)}}" alt="{{$event->title}}"/>
                                        <div class="img-overlay">
                                            <button class="book-tkt"></button>
                                        </div>
                                    </div>
                                </a>
                                <h4>{{$event->title}}</h4>
                                <p class="my-2">
                                    {{\Carbon\Carbon::parse($event->date)->format('d M Y')}}
                                    {{\Carbon\Carbon::parse($event->time)->format('h:i A')}}
                                </p>
                                <div class="d-flex">
                                    <button class="btn btn-md btn-primary">Buy tickets</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
    </main>
    @include('frontend.layouts.footer')
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('.btn-plus, .btn-minus').on('click', function (e) {
            const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
            const input = $(e.target).closest('.input-group').find('input');
            console.log(isNegative, input)
            if (input.is('input')) {
                input[0][isNegative ? 'stepDown' : 'stepUp']()
            }
            let total = 0;
            $('.seatSelected').each(function () {
                let seat = $(this).val();
                let rate = $(this).parent('.seatRate').data('rate');
                console.log(rate);
                total += Number(rate) * Number(seat);
                $('.totalAmount').text('$' + total.toFixed(1))
            });
        })
    </script>
@endpush
