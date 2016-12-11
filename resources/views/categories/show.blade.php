@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Categories | <strong>{{$category->name}}</strong></h1>
			<p>{{$category->description}}</p>
			<span><a href="{{route('categories.edit',$category->id)}}" class='btn btn-primary'>Edit Category</a></span>
			<span>
				<form action="{{route('categories.destroy', $category->id)}}" method='post'>
					{{method_field('DELETE')}}{{csrf_field()}}
					<input type='submit' name='delete' class='btn btn-danger' value='Delete Category'>
				</form>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h2>
				Category<b> | {{$category->name}}</b> <small> is in <strong style='color: red;'>{{$category->posts()->count()}}</strong> posts </small>
			</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Post Name</th>
						<th>Link</th>
					</tr>
				</thead>
				<tbody>
					@foreach($category->posts as $post)
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
