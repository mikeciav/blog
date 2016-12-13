@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>{{$user->name}}</h1>
		<h1>{{$user->email}}</h1>
	</div>
</div>

@stop