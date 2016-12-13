@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<img src="{{asset('images/'.$post->image)}}" alt="">
			<h2>{{$post->title}}</h2>
			<p class='lead'>{!!$post->body!!}</p>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Added On:</dt>
					<dd class="dd">{{$post->created_at}}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Updated On:</dt>
					<dd class="dd">{{$post->updated_at}}</dd>
				</dl>
				<div class="row">
					<div class="col-sm-12">
						<a href="{{url('/')}}" class='btn btn-default btn-block'>Return to Posts</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>


@stop