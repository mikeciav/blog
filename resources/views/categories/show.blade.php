@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Category | <strong>{{$category->name}}</strong><small> is in <strong style='color: red;'>{{$category->posts()->count()}}</strong> posts </small></h2>
			<p>{{$category->description}}</p>
			@if(Auth::user() && Auth::user()->isAdmin())
				<div class='row'>
					<div class="col-md-3">
						<span><a href="{{route('categories.edit',$category->id)}}" class='btn btn-primary'>Edit Category</a></span>
					</div>
					<div class="col-md-3 pull-right">
						<span>
							<form action="{{route('tags.destroy', $category->id)}}" method='post'>
								{{method_field('DELETE')}}{{csrf_field()}}
								<input type='submit' name='delete' class='btn btn-danger' value='Delete Category'>
							</form>
						</span>
					</div>
				</div>
			@endif
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
		@if($category->posts->count())
			@foreach($category->posts->reverse() as $post)
				@include('partials.post')
			@endforeach
		@else
			<div class='jumbotron'>
                <p>No posts to show</p>
            </div>
        @endif
		</div>
	</div>


@stop
