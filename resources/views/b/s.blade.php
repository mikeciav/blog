@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12 well">
			<h2>{{$post->title}}</h2>
			<hr>
				<span>
					<i class='glyphicon glyphicon-user' aria-hidden='true'></i> 
					Mike "Ragamuffin" Ciavarella
					<span class='pull-right'>
						<i class='glyphicon glyphicon-time' aria-hidden='true'></i>
						<small>{{$post->created_at->format('F jS Y g:i A')}}</small>
					</span>
				</span>
			<hr>
			<img src="{{asset('photos/'.$post->image)}}" alt="" class='img-responsive img-headline'>
			<hr>
			<p class='lead'><i>{{$post->tagline}}</i></p>
			<hr>
			{!!$post->body!!}
			<hr>
			<p class="footer"><small>{!!$post->footer!!}</small></p>
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
					</div>					
					@endif
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
			@include('partials.disqus')
		</div>
	</div>	


@stop