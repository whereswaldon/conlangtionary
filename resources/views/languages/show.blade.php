@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h2>{{ $language->name }}
                            @can('edit', $language)
                            <a href="{{action('LanguagesController@edit', ['id' => $language->id])}}"
                               title="Edit {{$language->name}}"
                               class="btn btn-sm btn-success"><strong>Edit Language</strong></a>
                            <a href="{{action('LanguagesController@morphologicalGenerator', ['language_id' => $language->id])}}"
                               title="Generate Words" class="btn btn-default"><strong>Morphological Generator</strong></a>
                            @endcan
                        </h2>
                    </div>
                    <div class="panel-body">
                        <p>{{ $language->short_description }}
                        </p>
                        <p><em>Language Notes:</em> {{ $language->notes }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
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
        </div>
        <div class="row">
            <div class="col-lg-5">
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
                        <p>{!! $description !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Vocabulary
                                    @can('create', new \App\Word())
                                    <a href="{{action('WordsController@createForLanguage', ['id' => $language->id])}}"
                                       alt="Create a new word in {{$language->name}}" class="btn btn-sm btn-danger"><strong>Add Word</strong></a>
                                    <a href="{{action('WordsController@createForLanguage', ['id' => $language->id, 'withDefinition' => true])}}"
                                       alt="Create a new word in {{$language->name}}" class="btn btn-sm btn-danger"><strong>Define New Word</strong></a>
                                    @endcan
                                </h3>
                            </div>
                            @if(count($words))
                                <div class="col-lg-6 ">
                                    {!! $words->render() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($words) < 1)
                            <p>Please add some words.</p>
                        @else
                            @foreach($words->chunk(round(count($words)/2.0)) as $chunk)
                                <div class="col-lg-6">
                                    @foreach($chunk as $word)
                                        <ul>
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
                                            <hr>
                                        </ul>
                                    @endforeach
                                </div>
                            @endforeach
                            @if(count($words))
                                <div class="col-lg-6 col-lg-offset-6">
                                    {!! $words->render() !!}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
        </div>
    </div>
</div>
@stop