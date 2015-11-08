@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $language->name }}</h2>
                <p>{{ $language->short_description }}
                    @can('edit', $language)
                    <span class="subtle"><a href="{{action('LanguagesController@edit', ['id' => $language->id])}}"
                                            alt="Edit {{$language->name}}">edit</a></span>
                    @endcan
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 panel panel-body">
                <h3>Description</h3>
                @can('edit', $language->description)
                <p class="subtle"><a href="{{action('DescriptionsController@edit', ['id' => $language->description->id])}}"
                                     alt="Edit {{$language->name}} Description">edit</a></p>
                @endcan
                <p>{{ $language->description->description }}</p>
                <h3>Definition Tags</h3>
                <ul>
                    @forelse($language->tags as $tag)
                        <li>{{$tag->name}} {{$tag->abbreviation}} - {{$tag->description}}</li>
                        @empty
                        <li>This language has no tags.</li>
                    @endforelse
                </ul>
            </div>

            <div class="col-lg-6 panel panel-body">
                <h3>Vocabulary
                    @can('create', new \App\Word())
                    <a href="{{action('WordsController@createForLanguage', ['id' => $language->id])}}" alt="Create a new word in {{$language->name}}">+</a>
                    @endcan
                </h3>
                @if(count($language->words) < 1)
                    <p>Please add some words.</p>
                    @else
                    <ul>
                        @foreach($language->words as $word)
                            <li> @can('edit', $word)
                                <span class="subtle"><a href="{{action('WordsController@edit', ['id' => $word->id])}}"
                                                        alt="Edit {{$word->ascii_string}}">(edit)</a></span>
                                @endcan
                                {{ $word->ascii_string }}
                                @can('create', new \App\Definition())
                                <a href="{{action('DefinitionsController@createForWord', ['id' => $word->id])}}" alt="Create a new definition for {{$word->ascii_string}}">+</a>
                                @endcan
                            @if( count($word->definitions) > 0)
                                <ol>
                                    @foreach($word->definitions->sortBy('definition_number') as $definition)
                                        <li>
                                            @foreach($definition->tags as $tag)
                                                {{$tag->abbreviation}}&nbsp;
                                            @endforeach
                                            {{ $definition->definition_text }}
                                            @can('edit', $definition)
                                            <span class="subtle"><a href="{{action('DefinitionsController@edit', ['id' => $definition->id])}}"
                                                                    alt="Edit Definition #{{$definition->definition_number}}">edit</a></span>
                                            @endcan
                                        </li>

                                    @endforeach
                                </ol>

                                @else
                                <ul><li><span class="undefined-warning">This word has not been defined.</span></li></ul>
                            @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
                <p><em>Notes:</em> {{ $language->notes }}</p>
            </div>
        </div>
    </div>
@stop