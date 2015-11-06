@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class='row'>
	<div class='col-lg-12'>
	    <h2>Descriptions</h2>
	    {{--<a role='button' class='btn  btn-success' href='/descriptions/create'>Create Description</a>--}}
		@if(count($descriptions) > 0)
		<table id='description-table' class='table-hover table'>
		    <tr>
			<th>Description for Language</th>
			<th>View</th>
			<th>Edit</th>
			<th>Delete</th>
		    </tr>

			@foreach($descriptions as $description)
			<tr>
			    <td>{{$description->language->name}}
			    <td><a role='button' class='btn btn-info' href='{{ action('DescriptionsController@show', $description->id)}}'>View</a></td>
			    <td><a role='button' class='btn btn-primary' href='{{ action('DescriptionsController@edit', $description->id)}}'>Edit</a></td>
			    <td>{!! Form::open(['method'=>'DELETE','action'=>['DescriptionsController@destroy', $description->id], 'class' => '+inline-block']) !!}
                              {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
			      {!! Form::close() !!}</td>
			</tr>
			@endforeach

		</table>
		@else
		<h3>Please add some descriptions. That is why we built this site.</h3>
		@endif
		{!! $descriptions->render() !!}
	</div>
    </div>
</div>
@stop 