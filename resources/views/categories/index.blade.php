@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12 well">
				<div class="header" style="font-size: 28px">Categories</div>
				@foreach($categories as $cat)
					<p>
						<a href="{{route('categories.show', $cat->id)}}" class='lead'>{{$cat->name}}</a>
						<span><small>is in <b style='color:red'>{{$cat->posts()->count()}}</b> posts</small></span>
					</p>
				@endforeach
				<div class="row">
					<div class="col-md-8">
						{{$categories->links()}}
					</div>
				</div>
			</div>
			@if(Auth::user() && Auth::user()->isAdmin())
			<div class="col-md-12">
				<div class="well">
					<h3>Create Category</h3>
					<hr>
					<form class='form-horizontal' method='post' action="{{route('categories.store')}}">
						{{csrf_field()}}
						<div class="form-group {{$errors->has('name')?'has-error':''}}">
							<label for="name" class='col-sm-2 control-label'>Name: </label>
							<div class="col-sm-10">
								<input type="text" class='form-control' name='name' id='name' value="{{old('name')}}" placeholder='Name here' required>
								@if($errors->has('name'))
									<span class='help-block'>
										<strong>{{$errors->first('name')}}</strong>
									</span>
								@endif
							</div>
						</div>


						<div class="form-group {{$errors->has('description')?'has-error':''}}">
							<label class="col-md-3 control-label" for="description">Description: </label>
							<div class="col-md-9">
								<textarea name='description' id='description' class='form-control' rows='5' value="{{old('description')}}" placeholder="Brief decription of the tag"></textarea>
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
			@endif
		
		</div>
	</div>
@stop