@extends('layouts.inner')

@section('main-content')
<div class='container'>
    <div class="row">
	<div class='col-lg-12'>

		@include('common.errors')
		<form method="POST" action="/tags">
		    {!! csrf_field() !!}
			@include('tags.form')
			<div class='form-group'>
				<button class='btn btn-success' type="submit">Create</button>
			</div>
		</form>
	</div>
    </div>
</div>
@stop 
