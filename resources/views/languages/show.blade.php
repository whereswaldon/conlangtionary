@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $language->name }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3>Description</h3>
                <p>{{ $language->description->description }}</p>
            </div>

            <div class="col-lg-6">
                <h3>Vocabulary</h3>
                @if(count($language->words) < 1)
                    <p>Please add some words.</p>
                    @else
                    <ul>
                        @foreach($language->words as $word)
                            <li>{{ $word->ascii_string }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@stop