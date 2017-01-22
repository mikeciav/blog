@extends('layouts.app')

@section('content')
<h1>Teams</h1>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-8 well">
		<?php $counter = 0; ?>
			@foreach($teams as $team)
				<div class="col-md-6 <?php echo ($counter%2 == 0) ? '' : 'pull-right'; ?>">
					<img class='flag flag-sm' src="{{asset('flags/'.$team->country)}}.png">
					<a href="{{route('teams.show', $team->id)}}" class='lead'>{{$team->name}}</a>
				</div>
				<?php $counter+=1; ?>
			@endforeach
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					{{$teams->links()}}
				</div>
			</div>
		</div>
		@if(Auth::user() && Auth::user()->isAdmin())
			<div class="col-md-9">
				<div class="panel panel-header">
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="post" action="{{route('teams.store')}}" enctype='multipart/form-data'>
							{{csrf_field()}}
							<div class="form-group {{$errors->has('name')?'has-error':''}}">
								<label class="col-md-4 control-label" for="name">Name: </label>
								<div class="col-md-6">
									<input type='text' name='name' id='name' class='form-control' value="{{old('name')}}" required />
									@if($errors->has('title'))
										<span class="help-block">
											<strong>{{$errors->first('name')}}</strong>
										</span>
									@endif
								</div>	
							</div>

							<div class="form-group {{$errors->has('tag')?'has-error':''}}">
								<label class="col-md-4 control-label" for="name">Tag: </label>
								<div class="col-md-6">
									<input type='text' name='tag' id='tag' class='form-control' value="{{old('tag')}}" required />
									@if($errors->has('tag'))
										<span class="help-block">
											<strong>{{$errors->first('tag')}}</strong>
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

							<div class="form-group {{$errors->has('logo')?'has-error':''}}">
								<label class="col-md-2 control-label" for="thumbnail">Logo: </label>
								<div class="col-md-10">
									<span class="input-group-btn">
								        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
								         	<i class="fa fa-picture-o"></i> Choose
								        </a>
								    </span>
								    <input id="thumbnail" name='logo' class="form-control" type="text">
									@if($errors->has('logo'))
										<span class="help-block">
											<strong>{{$errors->first('logo')}}</strong>
										</span>
									@endif
									<img id="holder" style="margin-top:15px;max-height:100px;">		
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
								<div class="col-md-8 col-md-offset-2">
									<button type='submit' class='btn btn-default btn-block'>
										Add Team
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		@endif
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