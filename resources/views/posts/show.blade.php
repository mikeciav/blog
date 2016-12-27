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
			<img src="{{asset('photos/'.$post->image)}}" alt="">
			<hr>
			<p class='lead'><i>{{$post->tagline}}</i></p>
			<hr>
			{!!$post->body!!}
			<hr>
			<p><small>{!!$post->footer!!}</small></p>
			<div class="row">
				<div class='pull-right'>
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
			<hr>
			<div class="row" style='margin-top:40px'>
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
	<hr>
	<div class="row">
		<!--Buttons-->
		<div class="col-sm-2">
			<a href="{{route('posts.edit', $post->id)}}" class='btn btn-primary btn-block'>Edit Post</a>
		</div>
		<div class="col-sm-2 col-sm-offset-2">
			<form action="{{route('posts.destroy', $post->id)}}" method='post'>
				{{method_field("DELETE")}}{{csrf_field()}}
				<input type="submit" name='delete' value='Delete Post' class='btn btn-danger btn-block'>
			</form>
		</div>
	</div>	
</div>


@stop