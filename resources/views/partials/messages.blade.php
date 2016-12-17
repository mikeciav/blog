@if(Session::has('success'))
	<div class="alert alert-success" role='success' style'margin-top:7px'>
		<strong>Great! </strong>{{Session::get('success')}}
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

