@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
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
	</div>
</div>


@stop
