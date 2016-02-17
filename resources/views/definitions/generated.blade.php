@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <h2>Generated Definitions</h2>
            @if(count($finalDefinitions) > 0)
            <table id='word-table' class='table-hover table'>
                <thead>
                    <th>Word</th>
                    <th>Language</th>
                    <th>Definition</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>

                <tbody>
                @foreach($finalDefinitions as $definition)
                    <tr>
                        <td>{{$definition->word->ascii_string}}</td>
                        <td>{{$definition->word->language->name}}
                        <td>{{ $definition->definition_text }}</td>
                        <td><a role='button' class='btn btn-info' href='{{ action('DefinitionsController@show', $definition->id)}}'>View</a></td>
                        <td><a role='button' class='btn btn-primary' href='{{ action('DefinitionsController@edit', $definition->id)}}'>Edit</a></td>
                        <td>{!! Form::open(['method'=>'DELETE','action'=>['DefinitionsController@destroy', $definition->id], 'class' => '+inline-block']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                            {!! Form::close() !!}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            @else
                <h3>No definitions generated</h3>
            @endif
        </div>
    </div>
</div>
@stop 