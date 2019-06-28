<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Acceder | SIGESTI</title>

	<!-- Styles -->
	<link rel="icon" href="{{asset('img/alcaldia.jpg')}}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<style>

</style>
</head>
<body style="background-image: url({{asset('img/fondo.png')}});" class="body">
	@include('layouts.help')
	<button class="btn btn-danger ml-4 mt-3 col-1" data-toggle="modal" data-target="#modalHelp">¡ AYUDA !</button>

	<div class="container mt-5 pt-5">
		<div class="row d-flex justify-content-center page-header mb-3"><h1 style="background-color: #fff; font-weight: bold;font-family: Monaco,Georgia,Times,serif;">Sistema de Gestión de Soporte Técnico Informático</h1></div>
		<div class="row">
			<div class="col-2 d-flex align-items-center" style="margin-right: -2%">
				<img class="img-fluid" src="{{ asset('img/alcaldia.jpg') }}">
			</div>
			<div class="col d-flex justify-content-center mt-2">
				

				<div class="card" style="background-color: #f3f3f3; width: 400px">
					<div class="card-header">
						<h2 class="card-title text-center mt-2">· SIGESTI - Acceder ·</h2>
					</div>
					<div class="card-body">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
								<label for="user" class="col-md-12 control-label">Usuario</label>

								<div class="col-md-12">
									<input id="user" type="text" class="form-control" name="user" value="{{ old('user') }}" autofocus>

									@if ($errors->has('user'))
									<span class="text-danger small">
										<strong>{{ $errors->first('user') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-12 control-label">Contraseña</label>

								<div class="col-md-12">
									<input id="password" type="password" class="form-control" name="password">

									@if ($errors->has('password'))
									<span class="text-danger small">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
							</div>

							{{-- <div class="d-flex justify-content-between">
								<div class="form-group">
									<div class="col-md-12 md-offset-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
											</label>
										</div>
									</div>
								</div>

							</div> --}}
							{{-- <div class="form-group">
								<div class="col md-offset-4">
									<a href="{{ route('register') }}">¡Regístrate!</a>
								</div>
							</div> --}}

							<div class="form-group d-flex justify-content-md-center mt-3">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-primary col">
										<i class="fas fa-sign-in-alt mr-2"></i>Entrar
									</button>
								</div>
							</div>
						</form>
					</div>



				</div>
				<div class="col-2 d-flex align-items-center" style="margin-left: 15%; margin-right: -13%">
					<img class="img-fluid" src="{{ asset('img/escudo_cagua.JPG') }}">
				</div>
			</div>
		</div>
	</div>
</body>
<script src="{{ asset('js/bootstrapjs/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrapjs/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrapjs/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/myjs.js') }}"></script>

</html>