@component('mail::message')
# Dear {{ $name }}

Your verification code is {{ $code }}!

@component('mail::button', ['url' => 'https://xinyuan.test/verify-email'])
點我前往驗證
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
