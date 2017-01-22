@extends('layouts.app')

@section('content')
<h1>Edit Player</h1>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-header">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{route('players.update', $player->id)}}" enctype='multipart/form-data'>
						{{method_field('PUT')}}{{csrf_field()}}
						<div class="form-group {{$errors->has('name')?'has-error':''}}">
							<label class="col-md-4 control-label" for="name">First Name: </label>
							<div class="col-md-6">
								<input type='text' name='firstname' id='firstname' class='form-control' value="{{$player->firstname}}" required />
								@if($errors->has('firstname'))
									<span class="help-block">
										<strong>{{$errors->first('firstname')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('lastname')?'has-error':''}}">
							<label class="col-md-4 control-label" for="lastname">Last Name: </label>
							<div class="col-md-6">
								<input type='text' name='lastname' id='lastname' class='form-control' value="{{$player->lastname}}" required />
								@if($errors->has('lastname'))
									<span class="help-block">
										<strong>{{$errors->first('lastname')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('handle')?'has-error':''}}">
							<label class="col-md-4 control-label" for="handle">Handle: </label>
							<div class="col-md-6">
								<input type='text' name='handle' id='handle' class='form-control' value="{{$player->handle}}" required />
								@if($errors->has('handle'))
									<span class="help-block">
										<strong>{{$errors->first('handle')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('country')?'has-error':''}}">
							<label class="col-md-4 control-label" for="country">Country: </label>
							<div class="col-md-6">
								<input type='text' name='country' id='country' class='form-control' value="{{$player->country}}" required />
								@if($errors->has('country'))
									<span class="help-block">
										<strong>{{$errors->first('country')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group {{$errors->has('picture')?'has-error':''}}">
							<label class="col-md-2 control-label" for="thumbnail">Picture: </label>
							<div class="col-md-10">
								<span class="input-group-btn">
							        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
							         	<i class="fa fa-picture-o"></i> Choose
							        </a>
							    </span>
							    <input id="thumbnail" name='picture' class="form-control" type="text" value="{{$player->picture}}">
								@if($errors->has('picture'))
									<span class="help-block">
										<strong>{{$errors->first('picture')}}</strong>
									</span>
								@endif
								<img id="holder" style="margin-top:15px;max-height:100px;">		
							</div>	
						</div>					

						<div class="form-group {{$errors->has('teams')?'has-error':''}}">
							<label class="col-md-4 control-label" for="team">Current Team: </label>
							<div class="col-md-6">
								<select name='teams[]' id='teams' class='form-control' class='multiSelect' multiple='multiple'>
									@foreach($teams as $team)
										<option value="{{$team->id}}">{{$team->name}}</option>
									@endforeach
								</select>
								
								@if($errors->has('teams'))
									<span class="help-block">
										<strong>{{$errors->first('teams')}}</strong>
									</span>
								@endif
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<button type='submit' class='btn btn-default btn-block'>
									Edit Player
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
<script src="{{ URL::to('js/tinymce/tinymce.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/js/mceSetup.js"></script>
<script>
	//Instantiate multiselect, encode the selected tag ids, and trigger the change in the select
	$('.multiSelect').select2();
	$('#teams').select2().val({!!json_encode($player->teams()->getRelatedIds())!!}).trigger('change');
</script>
@stop