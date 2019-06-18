@include('layouts.header')
@include('layouts.navbar')

<br>
<div class="container my-5 pt-5">
	
	@if(Auth::user()->hasAnyRole(['admin','boss']))
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
	<div id="error">
		
	</div>
	<div class="row my-5">
		<div class="col">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h4>Solicitudes</h4>
					<div class="input-group col-4">
						<input type="text" class="form-control" placeholder="Ingrese numero de serial.." aria-label="Recipient's username" aria-describedby="basic-addon2" id="inputSearch">
						<div class="input-group-append">
							<a class="btn btn-primary" id="butSearch" type="button"><i class="fas fa-plus mr-2"></i>Buscar</a>
						</div>
					</div>
				</div>
				<div class="card-body">

					<table class="table table-sm table-hover table-responsive">
						<thead class="thead">
							<tr>
								<th scope="col">Nro</th>
								<th scope="col">TIPO</th>
								<th scope="col">MODELO</th>
								<th scope="col">SERIAL</th>
								<th scope="col">RESPONSABLE</th>
								<th scope="col">DEPARTAMENTO</th>
								@if (Auth::user()->hasAnyRole(['admin','boss']))
								<th scope="col">TECNICO</th>
								@endif
								<th scope="col">FECHA</th>
								<th class="text-center" scope="col">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
	@if(Auth::user()->hasAnyRole(['admin','boss']))
							@forelse( $article as $articulo )
							<tr>
								<th scope="row">{{ $i++ }}</th>
								<td>{{ $articulo->article->type }}@if($articulo->article->name_otro)
									- {{$articulo->article->name_otro}}@endif</td>
								<td>{{ $articulo->article->model }}</td>
								<td>{{ $articulo->article->serial }}</td>
								<td>{{ $articulo->responsable->person->first_name }} {{ $articulo->responsable->person->last_name }}</td>
								<td>@if ($articulo->article->department) {{ $articulo->article->department->department }} - {{ $articulo->article->department->phone }} @else No Asignado. @endif</td>
								<td>@if ( $articulo->article->report->expert != null ) {{ $articulo->expert->person->first_name }} {{ $articulo->expert->person->last_name }} @else No está definido. @endif </td>
								<td>{{ $articulo->created_at }}</td>
								<td>
									<button class="btn btn-info btn-sm btnInf" data-id="{{ $articulo->article->id }}" title="Información" data-toggle="modal" data-target="#modalInfo">
										<i class="fas fa-qrcode"></i>
									</button>
								<!--<button class="btn btn-warning btn-sm" class="edit-report" data-toggle="modal" data-target="#modalModify">
									<i class="fas fa-edit"></i>
								</button>-->
								<button class="btn btn-danger btn-sm delete-report" data-id="{{ $articulo->article->id }}" data-url="requested" title="Eliminar" data-toggle="modal" data-target="#modalDelete">
									<i class="fas fa-trash"></i>
								</button>
								<button class="btn btn-secondary btn-sm" onclick="window.open('/report/comprobante/{{ $articulo->article->id }}','Comprobante')" id="comprobante-report" title="Comprobante">
									<i class="fas fa-certificate"></i>
								</button>
								<!-- <button class="btn btn-primary btn-sm btn-reportar" title="Reporte PDF">
									<i class="fas fa-file-pdf"></i>
								</button> -->
								<button class="btn btn-success btn-sm expert-report" title="Asignar Técnico" data-toggle="modal" data-target="#modalExpert">
									<i class="fas fa-child"></i>
								</button>
								</td>
								
								<td style="visibility: collapse;">{{$articulo->article->id}}</td>
							</tr>
							@empty
							<div class="alert alert-warning p-0">
								<h4 class="my-5 text-center">No hay solicitudes registradas.</h4>
							</div>
							@endforelse
@else
							@forelse( $report as $articulo)
							<tr>
								<th scope="row">{{ $i++ }}</th>
								<td>{{ $articulo->article->type }}@if($articulo->article->name_otro)
									- {{$articulo->article->name_otro}}@endif</td>
									<td>{{ $articulo->article->model }}</td>
								<td>{{ $articulo->article->serial }}</td>
								<td>{{ $articulo->responsable->person->first_name }} {{ $articulo->responsable->person->last_name }}</td>
								<td>@if ($articulo->article->department) {{ $articulo->article->department->department }} - {{ $articulo->article->department->phone }} @else No Asignado. @endif</td>
								<td>{{ $articulo->article->created_at }}</td>
								<td>
									<button class="btn btn-info btn-sm btnInf" data-id="{{ $articulo->article->id }}" title="Información" data-toggle="modal" data-target="#modalInfo">
										<i class="fas fa-qrcode"></i>
									</button>
								<!--<button class="btn btn-warning btn-sm" class="edit-report" data-toggle="modal" data-target="#modalModify">
									<i class="fas fa-edit"></i>
								</button>-->
								<button class="btn btn-danger btn-sm delete-report" data-id="{{ $articulo->article->id }}" data-url="requested" title="Eliminar" data-toggle="modal" data-target="#modalDelete">
									<i class="fas fa-trash"></i>
								</button>
								<button class="btn btn-secondary btn-sm" onclick="window.open('/report/comprobante/{{ $articulo->article->id }}','Comprobante')" id="comprobante-report" title="Comprobante">
									<i class="fas fa-certificate"></i>
								</button>
								
								<!-- <button class="btn btn-primary btn-sm btn-reportar" title="Reporte PDF">
									<i class="fas fa-file-pdf"></i>
								</button> -->
								</td>
								<td style="visibility: collapse;">{{$articulo->article->id}}</td>
							</tr>
							@empty
							@endforelse
@endif

						</tbody>
					</table>
					<nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
@if (Auth::user()->hasAnyRole(['admin','boss']))
						{{ $article->links() }}
@else
						{{ $report->links() }}
@endif
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
			<div class="modal-body" id="QrInf">
				<div class="d-flex flex-column mb-2">
					<div class="d-flex justify-content-center" id="titleInfo">
					</div>
					<div class="d-flex justify-content-center" id="bodyInfo">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" id="downInfo" class="btn btn-success" value="">Descargar</button>
			</div>
		</div>
	</div>
</div>
{{-- /MODAL-INFO --}}
{{-- MODAL-EXPERT --}}
@if (Auth::user()->hasAnyRole(['admin','boss']))
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
@endif
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
			<form action="{{ route('requested.store') }}" method="POST">
				@csrf
				<input type="hidden" name="id" id="article">
				<div class="modal-body">
					<div class="d-flex flex-column mb-2">
						<div class="d-flex justify-content-center" id="titleRe">
						</div>
					</div>
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

					<div class="form-group">
						<label for="observation">Observacion</label>
						<input type="text" value="{{old('observation')}}" class="form-control" name="observation"  pattern="^[a-zA-Záéíóúñ9-0]+">
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="boton">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- MODAL INFO --}}
<div class="modal fade" id="modalInfoRequested" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DE SOLICITUD DE MANTENIMIENTO</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-body" id="bodyInfoReques">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
{{-- 
@else
<div class="alert alert-warning p-0">
	<h4 class="my-5 text-center">{{$cant}}</h4>
</div> --}}

<script>
	
</script>

@include('layouts.footer')