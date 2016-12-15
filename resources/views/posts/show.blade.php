@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>{{$post->title}}</h2>
			<p class='lead'>{!!$post->body!!}</p>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Added On:</dt>
					<dd class="dd">{{$post->created_at}}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Updated On:</dt>
					<dd class="dd">{{$post->updated_at}}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Slug:</dt>
					<dd><a href="{{url('b',$post->slug)}}">{{$post->slug}}</a></dd>				
				</dl>

				<dl class="dl-horizontal">
					<dt>Tags:</dt>
					<dd>
						@foreach($post->tags as $t)
							<span class="label label-info">
								<a href="{{route('tags.show',$t->id)}}" style="color:white">{{$t->name}}</a>
							</span>
							&nbsp;
						@endforeach
					</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Categories:</dt>
					<dd>
						@foreach($post->categories as $cat)
							<span class="label label-primary">
								<a href="{{route('categories.show',$cat->id)}}" style="color:white">{{$cat->name}}</a>
							</span>
							&nbsp;
						@endforeach
					</dd>
				</dl>

				<!--Buttons-->
				<div class="col-sm-6">
					<a href="{{route('posts.edit', $post->id)}}" class='btn btn-primary btn-block'>Edit Post</a>
				</div>
				<div class="col-sm-6">
					<form action="{{route('posts.destroy', $post->id)}}" method='post'>
						{{method_field("DELETE")}}{{csrf_field()}}
						<input type="submit" name='delete' value='Delete Post' class='btn btn-danger btn-block'>
					</form>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<a href="{{url('/')}}" class='btn btn-default btn-block'>Return to Posts</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>


@stop