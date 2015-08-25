@extends('app')

@section('header-styles')

@stop

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            @yield('main-content')
        </div>
    </div>
</div>
@stop

@section('footer-scripts')

@stop
