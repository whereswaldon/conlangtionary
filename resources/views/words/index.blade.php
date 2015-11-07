@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <h2>Words</h2>
            <a role='button' class='btn  btn-success' href='/words/create'>Create Word</a>
            @if(count($words) > 0)
            <table id='word-table' class='table-hover table'>
                <thead>
                <th>Word</th>
                <th>Language</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>

                <tbody>
                @foreach($words as $word)
                    <tr>
                        <td>{{$word->ascii_string}}</td>
                        <td>{{$word->language->name}}
                        <td><a role='button' class='btn btn-info' href='{{ action('WordsController@show', $word->id)}}'>View</a></td>
                        <td><a role='button' class='btn btn-primary' href='{{ action('WordsController@edit', $word->id)}}'>Edit</a></td>
                        <td>{!! Form::open(['method'=>'DELETE','action'=>['WordsController@destroy', $word->id], 'class' => '+inline-block']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                            {!! Form::close() !!}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            @else
            <h3>Please add some words. That is why we built this site.</h3>
            @endif
            {!! $words->render() !!}
        </div>
    </div>
</div>
@stop 