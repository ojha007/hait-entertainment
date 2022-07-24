@component('mail::message')
Dear <b>{{$attributes['name']}}</b>,
<p>
This is a confirmation that your booking for
on  at   is approved.
</p>
<div class="qrCode" style="display:flex;justify-content: center">
{{$qrCode}}
</div>
<small>Note: Show this Qr code as a gate pass.</small>
@component('mail::button', ['url' => config('app.url')])
For any Query
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
