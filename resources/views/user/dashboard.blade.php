@if (Auth::guard('web')->check())
  <a href="{{ route('profile') }}">Profile</a>
@else
<a href="{{ route('login') }}">Login</a>
<a href="{{ route('registration') }}">Registration</a>

@endif

