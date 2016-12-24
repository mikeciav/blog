@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>{{$post->title}}</h2>
			<hr>
				<p>
					<i class='glyphicon glyphicon-user' aria-hidden='true'></i> 
					Mike "Ragamuffin" Ciavarella
					<span class='pull-right'>
						<i class='glyphicon glyphicon-time' aria-hidden='true'></i>
						<small>{{$post->created_at->format('F jS Y g:i A')}}</small>
					</span>
				</p>
			<hr>
			<img src="{{asset('images/'.$post->image)}}" alt="">
			<hr>
			<p class='lead'><i>{{$post->tagline}}</i></p>
			<hr>
			{!!$post->body!!}
			<hr>
			<p><small>{!!$post->footer!!}</small></p>
			<hr>
			<div class="row">
				@if(Auth::check())
					<div class='col-md-3'>
						@if($is_fav = in_array($post->id, $fav))
							<form action="{{route('favorites.destroy', [Auth::id(), $post->id])}}" method='post'>
								{{method_field('DELETE')}}{{csrf_field()}}
								<button type='submit' class='btn-fav'>
									<i class='fa fa-2x fa-heart is-fav' aria-hidden='true' title='Remove from favorites'></i>
								</button>
							</form>
						@else
							<form action="{{route('favorites.store', $post->id)}}" method='post'>
								{{csrf_field()}}
								<button type='submit' class='btn-fav'>
									<i class='fa fa-2x fa-heart-o not-fav' aria-hidden='true' title='Add to favorites'></i>
								</button>
							</form>
						@endif
					@endif
					</div>
					<div class='col-md-5'>
						<span class='st_facebook_large'></span>
						<span class='st_twitter_large'></span>
						<span class='st_reddit_large'></span>
						<span class='st_googleplus_large'></span>
						<span class='st_wordpress_large'></span>
						<span class='st_blogger_large'></span>
					</div>
				<div class="col-sm-4 pull-right">
					<a href="{{url('/')}}" class='btn btn-default btn-block'>Return to Posts</a>
				</div>
			</div>
		</div>
	</div>	
</div>


@stop