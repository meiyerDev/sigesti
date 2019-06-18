@include('layouts.header')
@include('layouts.navbar')


<div class="my-5">&nbsp;
	@if( session('success') )
	<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
		<i class="fas fa-info mr-2"></i>{{ session('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@if($errors->any())
	@foreach($errors->all() as $error) 
	<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
		<i class="fas fa-info mr-2"></i>{{ $error }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endforeach
	@endif

	<div class="row justify-content-center my-5">
		<div class="col-7">
			<div class="card text-center">
				<div class="card-header">
					<h4 class="card-title">EDITAR DATOS DE USUARIO</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('userPerfil.update') }}" method="POST">
						@csrf
						@method('PUT')
						@if($errors->any())
						<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
							<i class="fas fa-info mr-2"></i>@foreach($errors->all() as $error) {{ $error }} @endforeach
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif

						<div class="form-row mb-3">
							<div class="col">
								<label for="identity">Cedula:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-id-card"></i></span>
									</div>
									<input type="number" class="form-control" maxlength="9" minlength="7" name="identity" value="@if($user->expert ){{ $user->expert->person->identity }}@endif" id="identity" placeholder="Cedula" readonly>
								</div>
							</div>
						</div>

						<div class="form-row mb-3">
							<div class="col">
								<label for="first_name">Nombre:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" class="form-control" value="@if($user->expert ){{ $user->expert->person->first_name }}@endif" name="first_name" id="first_name" placeholder="Nombre" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras.">
								</div>
							</div>
						</div>

						<div class="form-row mb-3">
							<div class="col">
								<label for="last_name">Apellido:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" name="last_name" id="last_name" value="@if($user->expert ){{ $user->expert->person->last_name }}@endif" placeholder="Apellido" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras.">
								</div>
							</div>
						</div>
						<div class="form-row mb-3">
							<div class="col">
								{{--  <div class="form-row form-group{{ $errors->has('user') ? ' has-error' : '' }}"> --}}
									<label for="user">Usuario:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input type="text" value="{{ $user->name }}" name="user" id="user" placeholder="Username" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="form-row mb-3">
								<div class="col">
									<label for="user">Contraseña:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-key"></i></span>
										</div>
										<input id="password" type="password" class="form-control" placeholder="Contraseña" name="password">
									</div>
								</div>
							</div>
							<div class="form-row mb-3">
								<div class="col">
									<label for="user">Confirmar Contraseña:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-key"></i></span>
										</div>
										<input id="password" type="password" class="form-control" placeholder="Contraseña" name="confirmPassword">
									</div>
								</div>
							</div>
							<div class="form-row mb-3">
								<div class="col">
									<label for="phone">Telefono:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input type="number" value="@if($user->expert ){{ $user->expert->person->phone }}@endif" name="phone" id="phone" placeholder="Telefono" class="form-control" pattern="^[0-9]+" title="Ingrese solo numeros." maxlength="11">
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-success col-12">Modificar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>



	@include('layouts.footer')
