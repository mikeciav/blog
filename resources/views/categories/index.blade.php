@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="header" style="font-size: 28px">Categories</div>
			@foreach($categories as $cat)
				<p>
					<a href="{{route('categories.show', $cat->id)}}" class='btn btn-default btn-lg'>{{$cat->name}}</a>
					<span><small>Is in <b style='color:red'>{{$cat->posts()->count()}}</b> posts</small></span>
				</p>
			@endforeach
			<div class="row">
				<div class="col-md-8">
					{{$categories->links()}}
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well">
				<h3>Create Category</h3>
				<hr>
				<form class='form-horizontal' method='post' action="{{route('categories.store')}}">
					{{csrf_field()}}
					<div class="form-group {{$errors->has('name')?'has-error':''}}">
						<label for="name" class='col-sm-6 control-label'>Name: </label>
						<input type="text" class='form-control' name='name' id='name' value="{{old('name')}}" placeholder='Name here' required>
						@if($errors->has('name'))
							<span class='help-block'>
								<strong>{{$errors->first('name')}}</strong>
							</span>
						@endif
					</div>


					<div class="form-group {{$errors->has('description')?'has-error':''}}">
						<label class="col-md-4 control-label" for="description">Description: </label>
						<div class="col-md-6">
							<textarea name='description' id='description' class='form-control' value="{{old('description')}}" placeholder="Brief decription of the tag"></textarea>
							@if($errors->has('description'))
								<span class="help-block">
									<strong>{{$errors->first('description')}}</strong>
								</span>
							@endif
						</div>	
					</div>

					<div class="form-group">
						<div class='col-sm-12'>
							<button type='submit' class='btn btn-primary btn-block'>Make New Category</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stop