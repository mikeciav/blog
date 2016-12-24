@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-header">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{route('teams.update')}}" enctype='multipart/form-data'>
						{{csrf_field()}}
						<div class="form-group {{$errors->has('name')?'has-error':''}}">
							<label class="col-md-4 control-label" for="name">Name: </label>
							<div class="col-md-6">
								<input type='text' name='title' id='title' class='form-control' value="{{old('title')}}" required />
								@if($errors->has('title'))
									<span class="help-block">
										<strong>{{$errors->first('title')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('country')?'has-error':''}}">
							<label class="col-md-4 control-label" for="country">Country: </label>
							<div class="col-md-6">
								<input type='text' name='country' id='country' class='form-control' value="{{old('country')}}" required />
								@if($errors->has('country'))
									<span class="help-block">
										<strong>{{$errors->first('country')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('img')?'has-error':''}}">
							<label class="col-md-4 control-label" for="img">Upload Logo: </label>
							<div class="col-md-6">
								<input type='file' name='logo' id='logo' class='form-control' value="{{old('logo')}}"/>
								@if($errors->has('logo'))
									<span class="help-block">
										<strong>{{$errors->first('logo')}}</strong>
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

						<div class="form-group {{$errors->has('players')?'has-error':''}}">
							<label class="col-md-4 control-label" for="categories">Roster: </label>
							<div class="col-md-6">
								<select name='players[]' id='players' class='form-control multiSelect' multiple='multiple'>
									@foreach($players as $player)
										<option value="{{$player->id}}">{{$player->name}}</option>
									@endforeach
								</select>
								
								@if($errors->has('players'))
									<span class="help-block">
										<strong>{{$errors->first('players')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type='submit' class='btn btn-success btn-block'>
									Update Team
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
	$('#teams').select2().val({!!json_encode($team->players()->getRelatedIds())!!}).trigger('change');
</script>
@stop