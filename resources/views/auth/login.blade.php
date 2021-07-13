@extends('layouts.index')
@section('content')

<div class="container-fluid">
	<div class="container-form text-center">
		<div class="brand">
			<i class='fab fa-twitter'></i>
		</div>
		@if(Session::get('error'))
			<div class="error">
				{{Session::get('error')}}
			</div>
		@endif
		<form method="POST" id="form-login" action="{{url('login')}}" validate>
			<h1>Inicio sesión en Twitter</h1>
			@csrf
			<input type="text" name="name" id="name" class="form-input" placeholder="Usuario o Email">
			<br>
			<input type="password" name="password" class="form-input" id="password" placeholder="Contraseña">
			<br>
			<button class="btn-form">Login</button>
		</form>
		<a href="{{url('register')}}" class="link_tweet">Regístrate en Twitter</a>
	</div>
</div>
@endsection()
@section('scripts')
	<script type="text/javascript" src="{{url('/main.js')}}"></script>
@endsection
