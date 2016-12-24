@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>{{$team->name}}</h2>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Logo:</dt>
					<dd class="dd"><img src="{{asset('images/'.$team->logo)}}" alt=""></dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Added On:</dt>
					<dd class="dd">{{$post->created_at}}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Updated On:</dt>
					<dd class="dd">{{$post->updated_at}}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Team Tag:</dt>
					<dd>{{$post->abbr}}</dd>				
				</dl>

				<dl class="dl-horizontal">
					<dt>Country:</dt>
					<dd>{{$post->country}}</dd>				
				</dl>

				<dl class="dl-horizontal">
					<dt>Roster:</dt>
					<dd>
						@foreach($team->players as $p)
							<span class="label label-info">
								{{$p->name}}
							</span>
							&nbsp;
						@endforeach
					</dd>
				</dl>

				<!--Buttons-->
				<div class="col-sm-6">
					<a href="{{route('posts.edit', $post->id)}}" class='btn btn-primary btn-block'>Edit Team</a>
				</div>
				<div class="col-sm-6">
					<form action="{{route('posts.destroy', $post->id)}}" method='post'>
						{{method_field("DELETE")}}{{csrf_field()}}
						<input type="submit" name='delete' value='Delete Team' class='btn btn-danger btn-block'>
					</form>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<a href="{{url('/')}}" class='btn btn-default btn-block'>Return to Team List</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>


@stop