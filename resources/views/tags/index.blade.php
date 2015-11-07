@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <h2>Tags</h2>
            <a role='button' class='btn  btn-success' href='/tags/create'>Create Tag</a>
            @if(count($tags) > 0)
            <table id='tag-table' class='table-hover table'>
                <tr>
                <th>Tag</th>
                <th>Abbreviation</th>
                <th>Language</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>

                @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->abbreviation}}</td>
                    <td>{{$tag->language->name}}
                    <td><a role='button' class='btn btn-info' href='{{ action('TagsController@show', $tag->id)}}'>View</a></td>
                    <td><a role='button' class='btn btn-primary' href='{{ action('TagsController@edit', $tag->id)}}'>Edit</a></td>
                    <td>{!! Form::open(['method'=>'DELETE','action'=>['TagsController@destroy', $tag->id], 'class' => '+inline-block']) !!}
                                  {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                      {!! Form::close() !!}</td>
                </tr>
                @endforeach

            </table>
            @else
            <h3>Please add some tags. That is why we built this site.</h3>
            @endif
            {!! $tags->render() !!}
        </div>
    </div>
</div>
@stop 