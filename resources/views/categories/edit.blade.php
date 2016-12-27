@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="well">
		<h3>Edit Category</h3>
		<hr>
		<form class='form-horizontal' method='post' action="{{route('categories.update', $category->id)}}">
			{{method_field('PUT')}}{{csrf_field()}}
			<div class="form-group {{$errors->has('name')?'has-error':''}}">
				<label for="name" class='col-sm-2 control-label'>Name: </label>
				<div class="col-sm-10">
					<input type="text" class='form-control' name='name' id='name' value='{{$category->name}}' required>
				@if($errors->has('name'))
					<span class='help-block'>
						<strong>{{$errors->first('name')}}</strong>
					</span>
				@endif
				</div>
			</div>


			<div class="form-group {{$errors->has('description')?'has-error':''}}">
				<label class="col-md-2 control-label" for="description">Description: </label>
				<div class="col-md-10">
					<textarea rows='5' name='description' id='description' class='form-control' placeholder="Brief decription of the category">{{$category->description}}</textarea>
					@if($errors->has('description'))
						<span class="help-block">
							<strong>{{$errors->first('description')}}</strong>
						</span>
					@endif
				</div>	
			</div>

			<div class="form-group">
				<div class='col-sm-12'>
					<button type='submit' class='btn btn-primary btn-block'>Update Category</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop