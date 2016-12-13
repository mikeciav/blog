@extends('layouts.app')

@section('content')
<h1>Make A New Post</h1>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-header">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{route('posts.store')}}" enctype='multipart/form-data'>
						{{csrf_field()}}
						<div class="form-group {{$errors->has('title')?'has-error':''}}">
							<label class="col-md-4 control-label" for="title">Title: </label>
							<div class="col-md-6">
								<input type='text' name='title' id='title' class='form-control' value="{{old('title')}}" required />
								@if($errors->has('title'))
									<span class="help-block">
										<strong>{{$errors->first('title')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('slug')?'has-error':''}}">
							<label class="col-md-4 control-label" for="slug">Slug: </label>
							<div class="col-md-8">
								<input type='text' name='slug' id='slug' class='form-control' value="{{old('slug')}}" required />
								@if($errors->has('slug'))
									<span class="help-block">
										<strong>{{$errors->first('slug')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('img')?'has-error':''}}">
							<label class="col-md-4 control-label" for="img">Upload Image: </label>
							<div class="col-md-6">
								<input type='file' name='img' id='img' class='form-control' value="{{old('img')}}" multiple='multiple'/>
								@if($errors->has('img'))
									<span class="help-block">
										<strong>{{$errors->first('img')}}</strong>
									</span>
								@endif
							</div>	
						</div>						

						<div class="form-group {{$errors->has('body')?'has-error':''}}">
							<label class="col-md-4 control-label" for="body">Post body: </label>
							<div class="col-md-6">
								<textarea name='body' id='body' class='form-control' value="{{old('body')}}" placeholder="Memes here" required></textarea>
								@if($errors->has('body'))
									<span class="help-block">
										<strong>{{$errors->first('body')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('tags')?'has-error':''}}">
							<label class="col-md-4 control-label" for="tags">Tags: </label>
							<div class="col-md-6">
								<select name='tags[]' id='tags' class='form-control multiSelect' multiple='multiple'>
									@foreach($tags as $t)
										<option value="{{$t->id}}">{{$t->name}}</option>
									@endforeach
								</select>
								
								@if($errors->has('tags'))
									<span class="help-block">
										<strong>{{$errors->first('tags')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('categories')?'has-error':''}}">
							<label class="col-md-4 control-label" for="categories">Categories: </label>
							<div class="col-md-6">
								<select name='categories[]' id='categories' class='form-control multiSelect' multiple='multiple'>
									@foreach($categories as $cat)
										<option value="{{$cat->id}}">{{$cat->name}}</option>
									@endforeach
								</select>
								
								@if($errors->has('tags'))
									<span class="help-block">
										<strong>{{$errors->first('categories')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<button type='submit' class='btn btn-default btn-block'>
									Make Post
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('scripts')
<script>
	$('.multiSelect').select2();
</script>
@stop