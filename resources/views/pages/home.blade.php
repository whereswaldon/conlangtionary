@extends('layouts.inner')

@section('main-content')
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <h2>Select a Language to Explore:</h2>
                <p>or, <a role='button' class='btn  btn-success' href='/languages/create'>Create a Language</a></p>
                @if(count($languages) > 0)
                        @foreach($languages->chunk(3) as $chunk)
                            <div class="row">
                            @foreach($chunk as $language)
                                <div class="col-lg-4">
                                    <a href="{{ action('LanguagesController@show', ['id' => $language->id]) }}" alt="{{$language->name}}"><h1>{{$language->name}}</h1></a>
                                </div>

                            @endforeach
                            </div>
                        @endforeach

                @else
                    <h3>Please add some languages. That is why we built this site.</h3>
                @endif
            </div>
        </div>
    </div>
@stop
