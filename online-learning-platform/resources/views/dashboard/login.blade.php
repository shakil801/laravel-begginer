@extends('dashboard.app')

@section('content')
@if(session('message'))
<p>{{session('message')}}</p>
@endif
<div class="login-container">
    <form class="login-form" method="post">
        <h2>Login</h2>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group remember-me">
            <input type="checkbox" id="remember-me" name="remember">
            <label for="remember">Remember Me</label>
        </div>
        <button type="submit" id="login">Login</button>
    </form>
</div>
@endsection