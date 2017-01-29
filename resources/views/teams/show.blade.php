@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12 well">
				<div class="row">
					<div class="col-md-9">
						<h2>
							<img class='flag flag-lg' src="{{asset('flags/'.$team->country)}}.png">
							{{$team->name}} <small>({{$team->tag}})</small>
						</h2>	
						<hr>
						<h5>Roster:</h5>
						<ul>
							@foreach($team->players as $p)
								<li>
									<img class='flag flag-sm' src="{{asset('flags/'.$p->country)}}.png">
									<a href="{{route('players.show', $p->id)}}">{{$p->firstname}} "{{$p->handle}}" {{$p->lastname}}</a>
								</li>
								&nbsp;
							@endforeach
						</ul>
					</div>
					<div class="col-md-3">
						@if(!empty($team->logo))
							<img class='img-responsive' src="{{asset('photos/'.$team->logo)}}" alt="">
						@endif
					</div>
				</div>
				<hr>
				<!--Buttons-->
				@if(Auth::user() && Auth::user()->isAdmin())
					<div class="col-sm-6">
						<a href="{{route('teams.edit', $team->id)}}" class='btn btn-primary btn-block'>Edit Team</a>
					</div>
					<div class="col-sm-6">
						<form action="{{route('teams.destroy', $team->id)}}" method='post'>
							{{method_field("DELETE")}}{{csrf_field()}}
							<input type="submit" name='delete' value='Delete Team' class='btn btn-danger btn-block'>
						</form>
					</div>
				@endif
				<div class="row">
					<div class="col-sm-12">
						<a href="{{url('/teams')}}" class='btn btn-default btn-block'>Return to Team List</a>
					</div>
				</div>
			</div>
		</div>
	</div>	


@stop