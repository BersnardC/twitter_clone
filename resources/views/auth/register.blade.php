@extends('layouts.index')
@section('content')
<div class="container-fluid">
	<div class="container-form text-center">
		<div class="brand">
			<i class='fab fa-twitter'></i>
		</div>
		<form method="POST" action="{{url('register')}}" validate>
			<h1>Regístrate en Twitter</h1>
			@csrf
			<input type="text" name="full_name" id="full_name" placeholder="Nombre completo" class="form-input">
			<br>
			<input type="text" name="username" id="username" placeholder="Nombre de usuario" class="form-input">
			<br>
			<input type="text" name="email" id="email" placeholder="Correo electronico" class="form-input">
			<br>
			<input type="password" name="password" id="password" placeholder="Contraseña" class="form-input">
			<button class="btn-form">Registrar</button>
		</form>
		<a href="{{url('login')}}" class="link_tweet">Iniciar sesión</a>
	</div>
</div>
@endsection()