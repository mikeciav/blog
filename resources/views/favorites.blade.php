@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">	
			@if($user->posts()->count())
				@foreach($user->posts as $post)
					@include('partials.post');
				@endforeach
			@else
				<div class="jumbotron">
					<p>No posts have been saved to favorites.</p>
					<hr>
					<h3><a href="/">Return to home</a></h3>
				</div>
			@endif
		</div>
	</div>
@endsection
