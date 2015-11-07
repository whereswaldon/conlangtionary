@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $tag->name}}&nbsp;-&nbsp;{{ $tag->language->name }}</h2>
                <p><strong>Description: </strong>{{$tag->description}}</p>
                <p><em>Notes:</em> {{ $tag->notes }}</p>
            </div>
        </div>
    </div>
@stop