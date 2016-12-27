@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Tag | <strong>{{$tag->name}}</strong><small> is in <strong style='color: red;'>{{$tag->posts()->count()}}</strong> posts </small></h2>
			<p>{{$tag->description}}</p>
			@if(Auth::user() && Auth::user()->isAdmin())
				<div class='row'>
					<div class="col-md-3">
						<span><a href="{{route('tags.edit',$tag->id)}}" class='btn btn-primary'>Edit Tag</a></span>
					</div>
					<div class="col-md-3 pull-right">
						<span>
							<form action="{{route('tags.destroy', $tag->id)}}" method='post'>
								{{method_field('DELETE')}}{{csrf_field()}}
								<input type='submit' name='delete' class='btn btn-danger' value='Delete Tag'>
							</form>
						</span>
					</div>
				</div>
			@endif
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
		@if($tag->posts->count())
			@foreach($tag->posts->reverse() as $post)
				@include('partials.post')
			@endforeach
		@else
			<div class='jumbotron'>
                <p>No posts to show</p>
            </div>
        @endif
		</div>
	</div>


@stop
