@extends('layouts.inner')

@section('main-content')
    <h2>Result words in {{ $language->name }}:</h2>
    @include('common.errors')
    @if(count($word_results) > 0)
        <ol>
        @forelse($word_results as $word)
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
        </ol>
    @else
    <p>Your search returned no word results.</p>
    @endif
    <h2>Result definitions in {{ $language->name }}:</h2>
    @if(count($definition_results) > 0)
        <ol>
            @forelse($definition_results as $definition)
                <li><a href="{{ route('words.show', $definition->word->id) }}">{{$definition->word->ascii_string}}
                        <ul>
                            <li>{{$definition->definition_text}}</li>
                        </ul>
                    </a>
                </li>
            @empty
                <p>Empty result?</p>
            @endforelse
        </ol>
    @else
        <p>Your search returned no definition results.</p>
    @endif
@stop