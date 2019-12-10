@component('mail::message')
Welcome {{ $data['data']->name }} <br>
# Reset your Account

The body of your message.

@component('mail::button', ['url' => url('adminpanel/reset/password/'.$data['token'])])
Reset your Password
@endcomponent

or Click the link below
<a target="_blank" href="{{ url('adminpanel/reset/password/'.$data['token']) }}"> {{ url('adminpanel/reset/password/'.$data['token']) }} </a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
