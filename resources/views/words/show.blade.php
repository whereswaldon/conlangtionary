@extends('layouts.inner')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $word->ascii_string }}&nbsp;-&nbsp;{{ $word->language->name }}</h2>
                @if( count($word->definitions) > 0)
                    <ol>
                        @foreach($word->definitions->sortBy('definition_number') as $definition)
                            <li>{{ $definition->definition_text }}</li>
                        @endforeach
                    </ol>
                    @else
                    <p>This word has no definitions.</p>
                @endif
            </div>
        </div>
    </div>
@stop