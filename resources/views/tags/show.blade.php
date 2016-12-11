@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h1>Tag | <strong>{{$tag->name}}</strong></h1>
			<p>{{$tag->description}}</p>
			<span><a href="{{route('tags.edit',$tag->id)}}" class='btn btn-primary'>Edit Tag</a></span>
			<span>
				<form action="{{route('tags.destroy', $tag->id)}}" method='post'>
					{{method_field('DELETE')}}{{csrf_field()}}
					<input type='submit' name='delete' class='btn btn-danger' value='Delete Tag'>
				</form>
			</span>
		</div>

		<div class="col-md-6">
			<h2>
				Tag<b> | {{$tag->name}}</b> <small> is in <strong style='color: red;'>{{$tag->posts()->count()}}</strong> posts </small>
			</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Post Name</th>
						<th>Link</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tag->posts as $post)
						<tr>
							<td>{{$post->title}}</td>
							<td><a href="{{route('slug', $post->slug)}}" class='btn btn-info btn-lg'>Go to post</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@stop
