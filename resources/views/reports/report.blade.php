<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reporte Técnico</title>
	<link rel="stylesheet" href="/css/report.css">
	<script src="{{asset('js/bootstrapjs/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('js/reportar.js')}}"></script>
</head>
<body>
	<div class="head">
		<img src="/img/alcaldia.jpg" class="icon" alt="">
		<img src="/img/escudo_cagua.JPG" class="icon2" alt="">
		<p>República Bolivariana de Venezuela <br>Alcaldía del Municipio Sucre- Cagua- Estado Aragua <br>DIRECCIÓN DE INFORMÁTICA</p>
	</div>
	<div class="f-right" style="">
		<table class="th">
			<thead>
				<tr>
					<th style="width: 50px;"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2"><span class="bold">Fecha: </span>{{ date('d/m/y') }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<h1>REPORTE TÉCNICO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
	<div style="margin: auto;">
		<table style="width: 960px;" class="reporte">
			<thead>
				<tr class="thead">
					<th><!-- asd --></th>
					<th><!-- asd --></th>
					<th><!-- asd --></th>
					<th><!-- asd --></th>
					<th><!-- asd --></th>
					<th><!-- asd --></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3"><span class="bold">Nombre / Razón social:</span> Alcaldía del Municipio Sucre</td>
					<td colspan="3"><span class="bold">Ubicación: </span>Alcaldía del Municipio Sucre- Cagua- Edo. Aragua</td>
				</tr>
				<tr>
					<td colspan="6"><span class="bold">Técnico:</span>
						@if($article->report->expert)	{{ $article->report->expert->person->first_name }} {{ $article->report->expert->person->last_name }} @else Por definir @endif</td>
					</tr>
					<tr class="bg-light">
						<td colspan="3"><span class="bold">Tipo de Solicitud:</span></td>
						<td colspan="3"><span class="bold">Solicitado por:</span></td>
					</tr>
					<tr>
						<td colspan="3">
							<span class="margin-3">Correo <input type="checkbox" id="correo"></span>
							<span class="margin-3">Verbal <input type="checkbox" id="vocal"></span>
							<span class="margin-3">Telefónica <input type="checkbox" id="telefonica"></span>
							<span class="margin-3">Escrita <input type="checkbox" id="escrita"></span>
						</td>
						<td colspan="3">V-{{$article->responsable->person->identity}} - {{$article->responsable->person->first_name}} {{$article->responsable->person->last_name}}</td>
					</tr>
					<tr class="bg-light">
						<td colspan="6" class="center"><span class="bold margin-3">Observaciones</span></td>
					</tr>
					<tr class="bg-light center">
						<td colspan="2"><span class="bold">Mantenimiento</span></td>
						<td colspan="4"><span class="bold">Internet</span></td>
					</tr>
					<tr>
						<td>
							<span>Correctivo <input type="checkbox" id="correctivo"></span>
						</td>
						<td>
							<span>Preventivo <input type="checkbox" id="preventivo"></span>
						</td>
						<td colspan="4">
							<div class="celda height float-left">Instalación <input type="checkbox" id="ins-inter"></div>
							<div class="celda height float-left">Configuración <input type="checkbox" id="con-inter"></div>
							<div id="ultima-internet" class="height float-left center">Monitoreo <input type="checkbox" id="mon-inter"></div>
						</td>
					</tr>
					<tr class="bg-light center">
						<td colspan="2"><span class="bold">Cartuchos</span></td>
						<td colspan="4"><span class="bold">Cuentas de Usuarios</span></td>
					</tr>
					<tr class="justify">
						<td><span>Recarga <input type="checkbox" id="ins-rec"></span></td>
						<td><span>Mantenimiento <input type="checkbox" id="ins-manteni"></span></td>
						<td colspan="4" class="center"><div class="celda height float-left">Instalación <input type="checkbox" id="ins-user"></div>
							<div class="celda height float-left">Configuración <input type="checkbox" id="con-user"></div>
							<div id="ultima-user" class="height float-left center">Monitoreo <input type="checkbox" id="mon-user"></div></td>
						</tr>
						<tr class="bg-light">
							<td colspan="6">
								<span class="bold">Descripción del trabajo realizado</span>
							</td>
						</tr>
						<tr>
							<td colspan="6"><div class="justify margin-2">{{ $article->report->description }}</div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="margin:auto;margin-top: 400px;">
				<div style="margin-left: 300px;margin-right:300px;height:2px;background-color: black;">&nbsp;&nbsp;&nbsp;</div>
				<div style="margin-left: 445px;margin-top: 10px;">Sello y Firma <br> <span style="margin-left: -40px">Departamento Atendido</span></div>
			</div>
		</body>
		</html>