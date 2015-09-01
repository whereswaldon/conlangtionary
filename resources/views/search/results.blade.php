@extends('layouts.inner')

@section('main-content')
    <h2>Results in {{ $language->name }}:</h2>
    @if(count($results) > 0)
        <ol>
        @foreach($results as $result)
            @forelse($result->words as $word)
                <li><a href="{{ route('words.show', $word->id) }}">{{$word->ascii_string}}
                @if(count($word->definitions) > 0)
                    <ol>
                        @foreach($word->definitions as $definition)
                            <li>{{$definition->definition_text}}</li>
                        @endforeach
                    </ol>
                @endif
                </a> </li>
                @empty
                <p>Empty result?</p>
            @endforelse
        @endforeach
        </ol>
    @else
    <p>Your search returned no results.</p>
    @endif
@stop