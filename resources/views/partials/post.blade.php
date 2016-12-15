<div class='well'>
	<h3>{{$post->title}}</h3>
	<h4>{{$post->created_at}}</h4>
	<span><img src="{{asset('images/'.$post->image)}}" alt=""></span>
	<p>{{substr($post->body,0,150)}}{{strlen($post->body)>150?"...":""}}
		<span>
			<a href="{{route('slug', $post->slug)}}" class='btn btn-default pull-right btn-lg'>View Post</a>
		</span>
	</p>
	@if(Auth::check())
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
	@endif
</div>
<hr>