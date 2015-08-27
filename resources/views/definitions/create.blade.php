@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class="row">
	<div class='col-lg-12'>
		
		<form method="POST" action="/definitions">
		    {!! csrf_field() !!}
			@include('definitions.form')
			<div class='form-group'>
				<button class='btn btn-success' type="submit">Create</button>
			</div>
		</form>
	</div>
    </div>
</div>
@stop 
