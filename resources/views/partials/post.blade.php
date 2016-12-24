<div class='well'>
	<h2>
		<a href="{{route('slug', $post->slug)}}">{{$post->title}}</a>
		@if(Auth::check())
			<small class='pull-right'>
			@if($is_fav = in_array($post->id, $fav))
				<form action="{{route('favorites.destroy', [Auth::id(), $post->id])}}" method='post'>
					{{method_field('DELETE')}}{{csrf_field()}}
					<button type='submit' class='btn-fav'>
						<i class='fa fa-heart is-fav' aria-hidden='true' title='Remove from favorites'></i>
					</button>
				</form>
			@else
				<form action="{{route('favorites.store', $post->id)}}" method='post'>
					{{csrf_field()}}
					<button type='submit' class='btn-fav'>
						<i class='fa fa-heart-o not-fav' aria-hidden='true' title='Add to favorites'></i>
					</button>
				</form>
			@endif
			</small>
		@endif
	</h2>
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
	<span><img src="{{asset('images/'.$post->image)}}" alt="" class='img-responsive'></span>
	<hr>
	<i>{!!$post->tagline!!}</i>
</div>
<hr>