@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="well">
				<div class='row'>
					<div class="col-md-9">
						<h2>
							<img class='flag flag-lg' src="{{asset('flags/'.$player->country)}}.png">
							{{$player->firstname}} {{$player->lastname}}&nbsp;&nbsp;<small>({{$player->handle}})</small>
						</h2>
						<h3>Team:
							@foreach($player->teams as $t)
								<a href="{{route('teams.show', $t->id)}}">{{$t->name}}</a>
								&nbsp;
							@endforeach
						</h3>
					</div>
					<div class="col-md-3">
						<img class='img-responsive' src="{{asset('photos/'.$player->picture)}}" alt="">
					</div>
				</div>
				<hr>

				<!--Buttons-->
				@if(Auth::user() && Auth::user()->isAdmin())
					<div class="col-sm-6">
						<a href="{{route('players.edit', $player->id)}}" class='btn btn-primary btn-block'>Edit Player</a>
					</div>
					<div class="col-sm-6">
						<form action="{{route('players.destroy', $player->id)}}" method='post'>
							{{method_field("DELETE")}}{{csrf_field()}}
							<input type="submit" name='delete' value='Delete Player' class='btn btn-danger btn-block'>
						</form>
					</div>
				@endif
				<div class="row">
					<div class="col-sm-12">
						<a href="{{url('/players')}}" class='btn btn-default btn-block'>Return to Player List</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>


@stop