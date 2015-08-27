@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class='row'>
	<div class='col-lg-12'>
	    <h2>Definitions</h2>
	    <a role='button' class='btn  btn-success' href='/definitions/create'>Create Definition</a>
		@if(count($definitions) > 0)
		<table id='word-table' class='table-hover table'>
		    <tr>
                <th>Word</th>
                <th>Language</th>
                <th>Definition Number</th>
                <th>Definitions</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
		    </tr>

			@foreach($definitions as $definition)
			<tr>
			    <td>{{$definition->word->ascii_string}}</td>
			    <td>{{$definition->word->language->name}}
                <td>{{$definition->definition_number}}</td>
                <td>{{ $definition->definition_text }}</td>
			    <td><a role='button' class='btn btn-info' href='{{ action('DefinitionsController@show', $definition->id)}}'>View</a></td>
			    <td><a role='button' class='btn btn-primary' href='{{ action('DefinitionsController@edit', $definition->id)}}'>Edit</a></td>
			    <td>{!! Form::open(['method'=>'DELETE','action'=>['DefinitionsController@destroy', $definition->id], 'class' => '+inline-block']) !!}
                              {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
			      {!! Form::close() !!}</td>
			</tr>
			@endforeach

		</table>
		@else
		<h3>Please add some definitions. That is why we built this site.</h3>
		@endif
	</div>
    </div>
</div>
@stop 