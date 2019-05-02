@include('layouts.header')
@include('layouts.navbar')

<br>
<div class="container my-5 pt-5">
	
	@if(Auth::user()->hasRole('admin'))
	@include('layouts.info')
	@endif
	
	@if( session('succes') )
	<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
		<i class="fas fa-info mr-2"></i>{{ session('succes') }}
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
	
	@if(Auth::user()->hasRole('admin'))
	<div class="row my-5">
		<div class="col">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h4>Solicitudes</h4>
					<a href="#" data-toggle="modal" data-target="#modalNuevo" class="btn btn-primary btn-md">
						<i class="fas fa-plus mr-2"></i>Nuevo
					</a>
				</div>
				<div class="card-body">

					<table class="table table-sm table-hover table-responsive">
						<thead class="thead">
							<tr>
								<th scope="col">Nro</th>
								<th scope="col">TIPO</th>
								<th scope="col">MODELO</th>
								<th scope="col">MARCA</th>
								<th scope="col">SERIAL</th>
								<th scope="col">RESPONSABLE</th>
								<th scope="col">DEPARTAMENTO</th>
								<th scope="col">TECNICO</th>
								<th class="text-center" scope="col">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							@forelse( $article as $articulo )
							<tr>
								<th scope="row">{{ $i++ }}</th>
								<td>{{ $articulo->type }}@if($articulo->name_otro)
									- {{$articulo->name_otro}}@endif</td>
									<td>{{ $articulo->model }}</td>
									<td>{{ $articulo->brand }}</td>
									<td>{{ $articulo->serial }}</td>
									<td>{{ $articulo->responsable->person->first_name }} {{ $articulo->responsable->person->last_name }}</td>
									<td>{{ $articulo->department->department }} - {{ $articulo->department->phone }}</td>
									<td>@if ( $articulo->report->expert != null ) {{ $articulo->report->expert->person->first_name }} {{ $articulo->report->expert->person->last_name }} @else No está definido. @endif </td>
									<td>
										<button class="btn btn-info btn-sm btnInf" title="Información" data-toggle="modal" data-target="#modalInfo">
											<i class="fas fa-qrcode"></i>
										</button>
									<!--<button class="btn btn-warning btn-sm" class="edit-report" data-toggle="modal" data-target="#modalModify">
										<i class="fas fa-edit"></i>
									</button>-->
									<button class="btn btn-danger btn-sm delete-report" data-id="{{ $articulo->id }}" title="Eliminar" data-toggle="modal" data-target="#modalDelete">
										<i class="fas fa-trash"></i>
									</button>
									<button class="btn btn-secondary btn-sm" onclick="window.open('/report/comprobante/{{ $articulo->id }}','Comprobante')" id="comprobante-report" title="Comprobante">
										<i class="fas fa-certificate"></i>
									</button>
									<!-- <button class="btn btn-primary btn-sm btn-reportar" title="Reporte PDF">
										<i class="fas fa-file-pdf"></i>
									</button> -->
									<button class="btn btn-success btn-sm expert-report" title="Asignar Técnico" data-toggle="modal" data-target="#modalExpert">
										<i class="fas fa-child"></i>
									</button>
								</td>
								
								<td style="visibility: collapse;">{{$articulo->id}}</td>
							</tr>
							@empty
							<div class="alert alert-warning p-0">
								<h4 class="my-5 text-center">No hay datos registrados.</h4>
							</div>
							@endforelse
						</tbody>
					</table>
					<nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
						{{ $article->links() }}
					</nav>
				</div>
			</div>
		</div>
	</div>

</div>
{{-- MODAL-INFO --}}
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" >
				<h5 class="modal-title" id="modalExpertLabel">Código QR del artículo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="d-flex flex-column mb-2">
					<div class="d-flex justify-content-center" id="titleInfo">
					</div>
					<div class="d-flex justify-content-center" id="bodyInfo">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
{{-- /MODAL-INFO --}}

{{-- MODAL-EXPERT --}}
<div class="modal fade" id="modalExpert" tabindex="-1" role="dialog" aria-labelledby="modalExpertLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" >
				<h5 class="modal-title" id="modalExpertLabel">Asignar Técnico</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" id="add-expert" method="POST">
				<div class="modal-body">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					<label for="expert_id">Técnico:</label>
					<select name="expert_id" id="expert" class="form-control">
						<option disabled selected>Seleccione</option>
						@forelse( $experts as $experto )
						<option value="{{ $experto->id }}">
							{{ $experto->person->identity }} - {{ $experto->person->first_name }} {{ $experto->person->last_name }}
						</option>
						@empty
						@endforelse
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="expert" class="btn btn-primary" value="expert">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
{{-- /MODAL-EXPERT --}}


<!-- Modal eliminar -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" id="delete-r">

				@csrf
				@method('DELETE')

				<div class="modal-body">
					<h4>¿Estás seguro de eliminar el registro?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>


{{-- Modal para agregar solicitud --}}
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" >
				<h5 class="modal-title" id="modalNuevoLabel">Registro de solicitud</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('report.store') }}" method="POST">
				<div class="modal-body">
					{{csrf_field()}}


					@if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
						<i class="fas fa-info mr-2"></i>@foreach($errors->all() as $error) {{ $error }}@endforeach
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif


					<div class="form-group">
						<label for="responsable">Responsable:</label>
						<select name="responsable" id="respon" class="form-control" value="{{old('responsable')}}">
							<option value="">Seleccione</option>
							@forelse( $responsables as $respon )
							<option value="{{$respon->id}}">{{$respon->person->identity}} - {{$respon->person->first_name}} {{$respon->person->last_name}}</option>
							@empty
							@endforelse
							<option value="nuevo">Nuevo</option>
						</select>
					</div>

					<div id="nuevo-respon" style="display: none;">
						<div class="form-group">
							<label for="identity">Cédula:</label>
							<input type="number" minlength="7" maxlength="9" pattern="^[\d]+$" class="form-control" name="identity" placeholder="Cedula" value="{{old('identity')}}" >
						</div>
						<div class="form-group">
							<label for="first_name">Nombre:</label>
							<input type="text" pattern="^[a-zA-Záéíóúñ]+" class="form-control" name="first_name" placeholder="Nombre" value="{{old('first_name')}}" title="Ingrese solo letras.">
						</div>
						<div class="form-group">
							<label for="last_name">Apellido:</label>
							<input type="text" value="{{old('last_name')}}" pattern="^[a-zA-Záéíóúñ]+" class="form-control" name="last_name" placeholder="Apellido" title="Ingrese solo letras.">
						</div>
						<div class="form-group">
							<label for="phone">Telefono:</label>
							<input type="text" minlength="10" maxlength="11" value="{{old('phone')}}" pattern="^[\d]+$" class="form-control" name="phone" placeholder="Telefono" >
						</div>
					</div>

					{{-- articulo --}}
					<div id="div_tipo" style="display: none;">
						<div class="form-group">
							<label for="type">Tipo de Artículo:</label>
							<select name="type" id="tipo" class="form-control" value="{{old('type')}}">
								<option disabled selected>Seleccione</option>
								<option value="Monitor-Desktop">Desktop (CPU-Monitor)</option>
								<option value="Monitor">Monitor</option>
								<option value="Cpu">CPU</option>
								<option value="Laptop">Laptop</option>
								<option value="Impresora">Impresora</option>
								<option value="Cartucho">Cartucho</option>
								<option value="Otro">Otro</option>
							</select>
						</div>
						<div class="form-group">
							<label for="requested">Tipo de Solicitud:</label>
							<select name="requested" id="solicitud" value="{{old('requested')}}" class="form-control" >
								<option disabled selected>Seleccione</option>
								<option value="Correo">Correo</option>
								<option value="Vocal">Oral</option>
								<option value="Telefonica">Telefónica</option>
								<option value="Escrita">Escrita</option>
							</select>
						</div>
					</div>
					
					<div id="article" style="display: none;">
						<div id="name_otro" style="display: none;">
							<div class="form-grop">
								<label for="name_otro">Nombre del Articulo:</label>
								<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="name_otro" value="{{old('name_otro')}}">
							</div>
						</div>
						<div id="cartridge" style="display: none;">
							<div class="form-grop">
								<label for="code">Código de Cartucho:</label>
								<input type="text" class="form-control" name="code" value="{{old('code')}}">
							</div>
						</div>
						<div class="form-group">
							<label for="model">Modelo:</label>
							<input type="text" value="{{old('model')}}" class="form-control" name="model" >
						</div>
						<div class="form-group">
							<label for="brand">Marca:</label>
							<input type="text" class="form-control" value="{{old('brand')}}" name="brand" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." >
						</div>
						<div class="form-group">
							<label for="serial">Serial:</label>
							<input type="text" class="form-control" name="serial" value="{{old('serial')}}">
						</div>

						{{-- Monitor --}}
						<div id="monitor" style="display: none;">
							<div class="form-group">
								<label for="inche">Pulgadas Monitor:</label>
								<input value="{{old('inche')}}" type="number" class="form-control" name="inche">
							</div>
						</div>
						{{-- /Monitor --}}

						<div class="form-group">
							<label for="observation">Observacion</label>
							<input type="text" value="{{old('observation')}}" class="form-control" name="observation"  pattern="^[a-zA-Záéíóúñ9-0]+">
						</div>

						{{-- CPU --}}
						<div id="cpu" style="display: none;">
							<div id="article-cpu" style="display: none;">
								<div class="form-group">
									<label for="model">Modelo CPU:</label>
									<input type="text" class="form-control" value="{{old('model_cpu')}}" name="model_cpu">
								</div>
								<div class="form-group">
									<label for="brand">Marca CPU:</label>
									<input type="text" class="form-control" name="brand_cpu" value="{{old('brand_cpu')}}" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras.">
								</div>
								<div class="form-group">
									<label for="serial">Serial CPU:</label>
									<input type="text" value="{{old('serial_cpu')}}" class="form-control" name="serial_cpu">
								</div>
								<div class="form-group">
									<label for="observation_cpu">Observacion CPU:</label>
									<input type="text" class="form-control" value="{{old('observation_cpu')}}" name="observation_cpu" id="observation_cpu" pattern="^[a-zA-Záéíóúñ9-0]+">
								</div>
							</div>

							<div class="form-group">
								<label for="ram">Memoria RAM:</label>
								<input type="number" value="{{old('ram')}}" class="form-control" name="ram" >
							</div>

							<div class="form-group">
								<label for="processor">Procesador:</label>
								<input type="text" class="form-control" value="{{old('processor')}}" name="processor" >
							</div>

							<div class="form-group">
								<label for="so">S.O:</label>
								<select name="so" class="form-control" value="{{old('so')}}" >
									<option disabled selected>Seleccione</option>
									<option value="Windows">Windows</option>
									<option value="Linux">Linux</option>
									<option value="Mac">Mac</option>
								</select>
							</div>

							<div class="form-group">
								<label for="memory_video" value="{{old('memory_video')}}">Memoria Video:</label>
								<input type="number" class="form-control" name="memory_video" >
							</div>
						</div>
						{{-- /CPU --}}

						<div class="form-group">
							<label for="department">Departamento:</label>
							<select name="department" id="departamento" value="{{old('department')}}" class="form-control" >
								<option disabled selected>Seleccione</option>
								@forelse($departments as $departamento)
								<option value="{{$departamento->id}}">{{$departamento->department}}</option>
								@empty
								@endforelse
								<option value="nuevo">Nuevo</option>
							</select>
						</div>
						<div  style="display: none;" id="nue_departmento">
							<div class="form-group">
								<label for="department">Nuevo Departamento:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-building"></i></div>
									<input type="text" class="form-control" value="{{old('departmento')}}" name="departmento" id="nuevo_departmento" placeholder="Ingrese Departamento" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras.">
								</div>
							</div>
							<div class="form-group">
								<label for="department">Nombre del Director:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-user"></i></div>
									<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="firstname_director" value="{{old('firstname_director')}}" placeholder="Ingrese Nombre del Director de Departamento">
								</div>
							</div>
							<div class="form-group">
								<label for="department">Apellido del Director:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-user"></i></div>
									<input type="text" class="form-control" pattern="^[a-zA-Záéíóúñ]+" title="Ingrese solo letras." name="lastname_director" value="{{old('lastname_director')}}" placeholder="Ingrese Apellido del Director de Departamento">
								</div>
							</div>
							<div class="form-group">
								<label for="department">Teléfono de Departamento:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-phone"></i></div>
									<input type="text" class="form-control"  name="phoneDep" value="{{old('phone')}}" pattern="^[0-9]+" title="Ingrese solo numeros." placeholder="Ingrese numero de Teléfono del Departamento">
								</div>
							</div>
						</div>
					</div><br>

					<button type="button" class="btn btn-secondary" id="back">Retroceder</button>
					<button type="button" class="btn btn-primary follow" id="follow">Siguiente</button>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary follow" name="boton" id="boton" style="display: none;">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@else
<div class="alert alert-warning p-0">
	<h4 class="my-5 text-center">{{$cant}}</h4>
</div>
@endif

<script>
	
</script>

@include('layouts.footer')