@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $description->language->name }}&nbsp;Description</h2>
                <p>{{ $description->description }}</p>
            </div>
        </div>
    </div>
@stop