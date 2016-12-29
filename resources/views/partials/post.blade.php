<div class='well'>
	<h2><strong>
		@if(Auth::user() && Auth::user()->isAdmin())
			<a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
		@else
			<a href="{{route('slug', $post->slug)}}">{{$post->title}}</a>
		@endif
		</strong>
	</h2>

	<div style='padding:10px 0px 20px 0px'>
		<i class='glyphicon glyphicon-user' aria-hidden='true'></i> 
		Mike "Ragamuffin" Ciavarella
		<span class='pull-right'>
			<i class='glyphicon glyphicon-time' aria-hidden='true'></i>
			<small>{{$post->created_at->format('F jS Y g:i A')}}</small>
		</span>
	</div>
	<span><img src="{{asset('photos/'.$post->image)}}" alt="" class='img-responsive'></span>
	<hr>
	<div class="row">
		<div class='col-md-12'>
			<i>{!!$post->tagline!!}</i>
		</div>
	</div>
	<div class='row' style='margin-top:5px;'>
		@if(Auth::check())
			<div class='col-md-1'>
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
			</div>
		@endif
		<div class="pull-right">
		@foreach($post->categories as $cat)
			<span class="label label-primary">
				<a href="{{route('categories.show',$cat->id)}}" style="color:white">{{$cat->name}}</a>
			</span>
			&nbsp;
		@endforeach
		@foreach($post->tags as $t)
			<span class="label label-info">
				<a href="{{route('tags.show',$t->id)}}" style="color:white">{{$t->name}}</a>
			</span>
			&nbsp;
		@endforeach
		</div>
	</div>
</div>
<hr>