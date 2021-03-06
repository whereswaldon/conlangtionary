@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $definition->word->ascii_string }}&nbsp;-&nbsp;{{ $definition->word->language->name }}</h2>
                <p>Tags:</p>
                <ul>
                    @foreach($definition->tags as $tag)
                        <li>{{$tag->abbreviation}} - {{$tag->name}}</li>
                    @endforeach
                </ul>
                <p>{{ $definition->definition_text }}</p>
                <p><em>Notes:</em> {{ $definition->notes }}</p>
            </div>
        </div>
    </div>
@stop