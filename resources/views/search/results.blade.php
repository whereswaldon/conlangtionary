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
    <h2>Result tags in {{$language->name}}:</h2>
    @if(count($tag_results) > 0)
        <ol>
            @forelse($tag_results as $tag)
                <li>{{$tag->name}}
                    @if(count($tag->definitions))
                        <ul>
                           @foreach($tag->definitions as $definition)
                                <li>
                                    <a href="{{ action('DefinitionsController@show', $definition->id) }}">
                                        {{$definition->word->ascii_string}} - {{$definition->definition_text}}
                                    </a>
                                </li>
                           @endforeach
                        </ul>
                    @endif
                </li>
            @empty
                <p>Empty result?</p>
            @endforelse
        </ol>
    @else
        <p>Your search returned no tag results.</p>
    @endif
@stop