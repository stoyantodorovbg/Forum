@component('mail::message')
# One last step

We just need to confirm your email address to prove that you are a human.

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
