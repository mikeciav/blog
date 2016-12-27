@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-header">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{route('posts.update', $post->id)}}" enctype='multipart/form-data'>
						{{method_field('PUT')}}{{csrf_field()}}
						<div class="form-group {{$errors->has('title')?'has-error':''}}">
							<label class="col-md-2 control-label" for="title">Title: </label>
							<div class="col-md-10">
								<input type='text' name='title' id='title' class='form-control' value="{{$post->title}}" required />
								@if($errors->has('title'))
									<span class="help-block">
										<strong>{{$errors->first('title')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('slug')?'has-error':''}}">
							<label class="col-md-2 control-label" for="slug">Slug: </label>
							<div class="col-md-10">
								<input type='text' name='slug' id='slug' class='form-control' value="{{$post->slug}}" required />
								@if($errors->has('slug'))
									<span class="help-block">
										<strong>{{$errors->first('slug')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('img')?'has-error':''}}">
							<label class="col-md-2 control-label" for="img">Image: </label>
							<div class="col-md-10">
								<span class="input-group-btn">
							        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
							         	<i class="fa fa-picture-o"></i> Choose
							        </a>
							    </span>
							    <input id="thumbnail" name='img' class="form-control" type="text" value="{{$post->img}}">
								@if($errors->has('img'))
									<span class="help-block">
										<strong>{{$errors->first('img')}}</strong>
									</span>
								@endif
								<img id="holder" style="margin-top:15px;max-height:100px;">		
							</div>	
						</div>						

						<div class="form-group {{$errors->has('tags')?'has-error':''}}">
							<label class="col-md-2 control-label" for="tags">Tags: </label>
							<div class="col-md-10">
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
							<label class="col-md-2 control-label" for="categories">Categories: </label>
							<div class="col-md-10">
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

						<div class="form-group {{$errors->has('body')?'has-error':''}}">
							<label class="col-md-2 control-label" for="body">Post body: </label>
							<div class="col-md-10">
								<textarea name='body' id='body' rows='10' class='form-control' placeholder="Memes here" required>{{$post->body}}</textarea>
								@if($errors->has('body'))
									<span class="help-block">
										<strong>{{$errors->first('body')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type='submit' class='btn btn-success btn-block'>
									Update Post
								</button>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a href="{{route('posts.show', $post->id)}}" class='btn btn-danger btn-block'>
									Cancel
								</a>
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
	//Instantiate multiselect, encode the selected tag ids, and trigger the change in the select
	$('.multiSelect').select2();
	$('#tags').select2().val({!!json_encode($post->tags()->getRelatedIds())!!}).trigger('change');
	$('#categories').select2().val({!!json_encode($post->categories()->getRelatedIds())!!}).trigger('change');
</script>
<script src="{{ URL::to('js/tinymce/tinymce.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/js/mceSetup.js"></script>
@stop