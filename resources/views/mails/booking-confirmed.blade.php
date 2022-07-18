@component('mail::message')
    Dear {{$name ?? 'Customer'}}

    @component('mail::panel')
        This is a verification that your ticket for the event is finalized.
        Please make sure you dont delete this mail.
        <div style="margin: 2em">
            {!! $qrCode !!}
{{--            <img src="data:image/png;base64, {!! base64_encode($qrCode) !!} " alt="booking confirmed">--}}
{{--            <img src="{!!$message->embedData($qrCode, 'QrCode.png', 'image/png')!!}" >--}}
        </div>
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
