Hello {{$user->name}}
you change your email. So we need to verified your email. Please verify your email using this link :

{{route('verify', $user->verification_token)}}