@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class='row'>
        <div class='col-lg-11'>
            <h2>Languages</h2>
            <a role='button' class='btn  btn-success' href='/languages/create'>Create Language</a>
            @if(count($languages) > 0)
            <table id='language-table' class='table-hover table'>
                <tr>
                <th>Language</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>

                @foreach($languages as $language)
                <tr>
                    <td>{{$language->name}}</td>
                    <td><a role='button' class='btn btn-info' href='{{ action('LanguagesController@show', $language->id)}}'>View</a></td>
                    <td><a role='button' class='btn btn-primary' href='{{ action('LanguagesController@edit', $language->id)}}'>Edit</a></td>
                    <td>{!! Form::open(['method'=>'DELETE','action'=>['LanguagesController@destroy', $language->id], 'class' => '+inline-block']) !!}
                                  {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                      {!! Form::close() !!}</td>
                </tr>
                @endforeach

            </table>
            @else
            <h3>Please add some languages. That is why we built this site.</h3>
            @endif
            {!! $languages->render() !!}
        </div>
    </div>
</div>
@stop 