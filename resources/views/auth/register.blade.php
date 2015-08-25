@extends('layouts.inner')

@section('main-content')
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class='form-group'>
        <label for='name'>Name</label>
        <input class='form-control' type="text" name="name" value="{{ old('name') }}">
    </div>

    <div class='form-group'>
        <label for='name'>Email</label>
        <input class='form-control' type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class='form-group'>
        <label for='password'>Password</label>
        <input class='form-control' type="password" name="password">
    </div>

    <div class='form-group'>
        <label for='password_confirmation'>Confirm Password</label>
        <input class='form-control' type="password" name="password_confirmation">
    </div>

    <div class='form-group'>
        <button class='btn btn-default' type="submit">Register</button>
    </div>
</form>
@stop