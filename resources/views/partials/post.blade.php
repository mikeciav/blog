<div class='well'>
	<h3>{{$post->title}}</h3>
	<h4>{{$post->created_at}}</h4>
	<span><img src="{{asset('images/'.$post->image)}}" alt=""></span>
	<p>{{substr($post->body,0,150)}}{{strlen($post->body)>150?"...":""}}
		<span>
			<a href="{{route('slug', $post->slug)}}" class='btn btn-default pull-right btn-lg'>View Post</a>
		</span>
	</p>
</div>
<hr>