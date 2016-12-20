@if(Session::has('success'))
	<div class="alert alert-success" role='success' style'margin-top:7px'>
		{{Session::get('success')}}
	</div>
@elseif(Session::has('info'))
	<div class="alert alert-info" role='success' style'margin-top:7px'>
		{{Session::get('info')}}
	</div>
@elseif(Session::has('error'))
	<div class="alert alert-danger" role='success' style'margin-top:7px'>
		{{Session::get('error')}}
	</div>
@endif

@if($errors->any())
	<div class="alert alert-danger" role='error'>
		<strong>Oops! Something went wrong:</strong>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif

