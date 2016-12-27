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
								<input type='file' name='img' id='img' class='form-control' value="{{old('img')}}" multiple='multiple'/>
								@if($errors->has('img'))
									<span class="help-block">
										<strong>{{$errors->first('img')}}</strong>
									</span>
								@endif
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
							<label class="col-md-2 control-label" for="body">Tag Line: </label>
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
</div>

@stop

@section('scripts')
<script>
	$('.multiSelect').select2();
</script>
<script src="{{ URL::to('js/tinymce/tinymce.min.js')}}"></script>
<script>
	var editor_config = {
		path_absolute : "{{ URL::to('/') }}/",
		selector: "#body",
		plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
		relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'Filemanager',
	        width : x * 0.8,
	        height : y * 0.8,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
	};

	tinymce.init(editor_config);
</script>
@stop