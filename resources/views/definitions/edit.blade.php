@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class="row">
	<div class='col-lg-12'>

		@include('common.errors')
		<form method="POST" action="{{action('DefinitionsController@update', $definition->id)}}">
		    <input name='_method' type='hidden' value='PATCH'>
		    {!! csrf_field() !!}
			@include('definitions.form')
			<div class='form-group'>
				<button class='btn btn-success' type="submit">Save</button>
			</div>
		</form>
	</div>
    </div>
</div>
@stop 
