@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h2>{{ $language->name }}
                            @can('edit', $language)
                            <a href="{{action('LanguagesController@edit', ['id' => $language->id])}}"
                               alt="Edit {{$language->name}}"
                               class="btn btn-sm btn-success"><strong>Edit Language</strong></a>
                            @endcan
                        </h2>
                    </div>
                    <div class="panel-body">
                        <p>{{ $language->short_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3>Description
                            @can('edit', $language->description)
                            <a href="{{action('DescriptionsController@edit', ['id' => $language->description->id])}}"
                               alt="Edit {{$language->name}} Description" class="btn btn-sm btn-info"><strong>Edit Description</strong></a>
                            @endcan
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $language->description->description }}</p>
                    </div>
                </div>

                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3>Definition Tags
                            @can('create', new \App\Tag())
                            <a href="{{action('TagsController@createForLanguage', ['id' => $language->id])}}"
                               alt="Create a tag" class="btn btn-sm btn-warning"><strong>Add Tag</strong></a>
                            @endcan
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            @forelse($language->tags->sortBy('name') as $tag)
                                <li>
                                    {{$tag->name}} {{$tag->abbreviation}} - {{$tag->description}}
                                    @can('edit', $tag)
                                    <a href="{{action('TagsController@edit', ['id' => $tag->id])}}"
                                       alt="Edit this tag" class="btn btn-xs btn-default">Edit Tag</a>
                                    @endcan
                                </li>
                            @empty
                                <li>This language has no tags.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3>Vocabulary
                            @can('create', new \App\Word())
                            <a href="{{action('WordsController@createForLanguage', ['id' => $language->id])}}"
                               alt="Create a new word in {{$language->name}}" class="btn btn-sm btn-danger"><strong>Add Word</strong></a>
                            @endcan
                        </h3>
                    </div>
                    <div class="panel-body">
                        @if(count($words) < 1)
                            <p>Please add some words.</p>
                        @else
                            <ul>
                                @foreach($words as $word)
                                    <li>
                                        {{ $word->ascii_string }}
                                        @can('edit', $word)
                                        &nbsp;
                                        <a href="{{action('WordsController@edit', ['id' => $word->id])}}"
                                           alt="Edit {{$word->ascii_string}}" class="btn btn-xs btn-default">Edit Word</a>
                                        @endcan
                                        @can('create', new \App\Definition())
                                        &nbsp;
                                        <a href="{{action('DefinitionsController@createForWord', ['id' => $word->id])}}"
                                           alt="Create a new definition for {{$word->ascii_string}}"
                                           class="btn btn-xs btn-default">
                                            Add Definition</a>
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
                                                        <a href="{{action('DefinitionsController@edit', ['id' => $definition->id])}}"
                                                           alt="Edit Definition #{{$definition->definition_number}}"
                                                           class="btn btn-xs btn-default" >Edit Definition</a>
                                                        @endcan
                                                    </li>

                                                @endforeach
                                            </ol>

                                        @else
                                            <ul><li><span class="undefined-warning">This word has not been defined.</span></li></ul>
                                        @endif
                                    </li>
                                @endforeach
                                {!! $words->render() !!}
                            </ul>
                        @endif
                        <p><em>Notes:</em> {{ $language->notes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop