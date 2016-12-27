@extends('layouts.noSidebar')

@section('content')
<h1>Make A New Post</h1>
<hr>
<div class="container">
	<div class="row">
			<div class="panel panel-header">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{route('posts.store')}}" enctype='multipart/form-data'>
						{{csrf_field()}}
						<div class="form-group {{$errors->has('title')?'has-error':''}}">
							<label class="col-md-2 control-label" for="title">Title: </label>
							<div class="col-md-10">
								<input type='text' name='title' id='title' class='form-control' value="{{old('title')}}" required />
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
								<input type='text' name='slug' id='slug' class='form-control' value="{{old('slug')}}" required />
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
							    <input id="thumbnail" name='img' class="form-control" type="text">
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

						<div class="form-group {{$errors->has('tagline')?'has-error':''}}">
							<label class="col-md-2 control-label" for="body">Tag Line: </label>
							<div class="col-md-10">
								<textarea name='tagline' id='tagline'rows='5' class='form-control' placeholder='Leading sentence or two to introduce post' required>{!!old('tagline')!!}</textarea>
								@if($errors->has('tagline'))
									<span class="help-block">
										<strong>{{$errors->first('tagline')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('body')?'has-error':''}}">
							<label class="col-md-2 control-label" for="body">Post body: </label>
							<div class="col-md-10">
								<textarea name='body' id='body' rows='10' class='form-control' placeholder="Memes here">{!!old('body')!!}</textarea>
								@if($errors->has('body'))
									<span class="help-block">
										<strong>{{$errors->first('body')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('footer')?'has-error':''}}">
							<label class="col-md-2 control-label" for="body">Footer: </label>
							<div class="col-md-10">
								<textarea name='footer' id='footer'rows='5' class='form-control' placeholder='Sources, orig. pub. date, etc.' required>{!!old('footer')!!}</textarea>
								@if($errors->has('footer'))
									<span class="help-block">
										<strong>{{$errors->first('footer')}}</strong>
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

@stop

@section('scripts')
<script>
	$('.multiSelect').select2();
</script>
<script src="{{ URL::to('js/tinymce/tinymce.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/js/mceSetup.js"></script>
@stop