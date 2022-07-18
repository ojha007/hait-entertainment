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
                    {!! Form::open(['route' =>['processTransaction',$event->id],'method'=>'post']) !!}

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
                                                    @if($pricing->availableSeat($pricing->ticket_type_id) > 0)
                                                        <div class="input-group seatRate"
                                                             data-rate="{{$pricing->rate}}">
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
                                                    @endif
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
                                <p class="mt-3 fs-6">Note: Qr Code will be sent on your email after verifying your
                                    payment.</p>
                            </div>
                        </div>

                        <div class="col mt-4 mt-lg-0">
                            @foreach($requestPricing as $key=>$seat)
                                <input type="hidden" name="ticket_type_id[]" value="{{$key}}">
                                <input type="hidden" name="seat[]" value="{{$seat}}">
                            @endforeach
                            <div class="form-col">
                                <form class="w-100">
                                    <div class="form-group">
                                        <label>Name*</label>
                                        <input type="text" name="name" placeholder="Your Name" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" placeholder="example@example.com" class="form-control"
                                               name="email"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone*</label>
                                        <input type="text" placeholder="04XXXXXXXX" class="form-control" required
                                               name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Method *</label>
                                        {!! Form::select('payment_method',$paymentMethod,null,['placeholder'=>'Select Payment Method','class'=>'form-control','required']) !!}
                                    </div>
                                    <div class="form-group card-payment" hidden>
                                        <label class="d-block mb-3">Payment Option*</label>
                                        <div class="accordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button">
                                                        <span>Credit/Debit Cards</span>
                                                        <span class="provider-image">
                                                            <img src="{{asset('images/master-card.jpg')}}"
                                                                 alt="Master Card ">
                                                            <img src="{{asset('images/visa.jpg')}}"
                                                                 alt="Visa Card Payment">
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                                     aria-labelledby="flush-headingOne"
                                                     data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <div class="form-group">
                                                            <label>Cardholder Name*</label>
                                                            <input type="text" placeholder="e.g. John E Cash"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Card Number*</label>
                                                            <input type="number" id="cc"
                                                                   placeholder="16-digit card number"
                                                                   maxlength="16"
                                                                   class="form-control"

                                                            >
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-8">
                                                                <label>Expiry Date*</label>
                                                                <input type="text" maxlength="7" id='expires'
                                                                       placeholder="MM/YYYY"
                                                                       class="form-control"

                                                                >
                                                            </div>
                                                            <div class="col-4">
                                                                <label>CVV*</label>
                                                                <input type="number" placeholder="XXX"
                                                                       class="form-control" maxlength="3"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-primary btn px-4 d-flex align-items-center" type="submit">
                                            <span>Checkout </span><i
                                                class="ic-caret-right ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </section>
    </main>
    @include('frontend.layouts.footer')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
    <script>
        $(document).ready(function () {
            $('select[name="payment_method"]').on('change', function () {
                let val = $(this).val();
                if (val === 'card') {
                    $('.card-payment').removeAttr('hidden');
                } else {
                    $('.card-payment').attr('hidden', 'hidden');
                }
            });
            let dt = new Date();
            dt = (dt.getMonth() + 1) + "/" + dt.getFullYear();
            $('#expires').inputmask({
                alias: 'datetime',
                inputFormat: 'mm/yyyy',
                placeholder: "__/____",
                min: dt,
            });
        })
    </script>
@endpush
