@extends('layouts.inner')

@section('main-content')

<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class='form-group'>
        <label for='email'>Email</label>
        <input class='form-control' type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class='form-group'>
        <label for='password'>Password</label>
        <input  class='form-control' type="password" name="password" id="password">
    </div>

    <div class='form-group'>
        <label for='remember'>Remember Me:</label>
        <input  class='form-control' type="checkbox" name="remember"> 
    </div>

    <div class='form-group'>
        <button class='btn-default btn' type="submit">Login</button>
    </div>
</form>
@stop