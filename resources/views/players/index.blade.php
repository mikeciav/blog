@extends('layouts.app')

@section('content')
<h1>Add Player</h1>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-8 well">
			@foreach($players as $player)
				<p>
					<img class='flag flag-lg' src="{{asset('flags/'.$player->country)}}.png">
					<a href="{{route('players.show', $player->id)}}" class='lead'>{{$player->handle}}</a>
				</p>
			@endforeach
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					{{$players->links()}}
				</div>
			</div>
		</div>
		<div class="col-md-9">
			@if(Auth::user() && Auth::user()->isAdmin())
				<div class="panel panel-header">
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{route('players.store')}}" enctype='multipart/form-data'>
							{{csrf_field()}}
							<div class="form-group {{$errors->has('name')?'has-error':''}}">
								<label class="col-md-4 control-label" for="name">First Name: </label>
								<div class="col-md-6">
									<input type='text' name='firstname' id='firstname' class='form-control' value="{{old('firstname')}}" required />
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
									<input type='text' name='lastname' id='lastname' class='form-control' value="{{old('lastname')}}" required />
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
									<input type='text' name='handle' id='handle' class='form-control' value="{{old('handle')}}" required />
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
									<input type='text' name='country' id='country' class='form-control' value="{{old('country')}}" required />
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
								    <input id="thumbnail" name='picture' class="form-control" type="text">
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
										Add Player
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			@else
				<p>show all players</p>
			@endif
		</div>
	</div>
</div>

@stop


@section('scripts')
<script src="{{ URL::to('js/tinymce/tinymce.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/js/mceSetup.js"></script>
<script>
	$('.multiSelect').select2();
</script>
@stop