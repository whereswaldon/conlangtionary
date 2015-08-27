@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $word->ascii_string }}&nbsp;-&nbsp;{{ $word->language->name }}</h2>
            </div>
        </div>
    </div>
@stop