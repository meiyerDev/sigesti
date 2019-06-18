<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reporte de Solicitudes</title>
	<link rel="stylesheet" href="/css/report.css">
	<script src="{{asset('js/bootstrapjs/jquery-3.3.1.min.js')}}"></script>
	<style>
	.container{
		/*border: 1px solid #000;*/
	}
	table,.th{
		font-family: Arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}
	td,th{
		border-top: 1px solid #000;
		border-right:  1px solid #000;
		border-left: 1px solid #000;
		border-bottom: 1px solid #000;
		padding: 8px;
	}
</style>
</head>
<body>
	<div class="head">
		<img src="/img/alcaldia.jpg" class="icon" alt="">
		<img src="/img/escudo_cagua.JPG" class="icon2" alt="">
		<p>República Bolivariana de Venezuela <br>Alcaldía del Municipio Sucre- Cagua- Estado Aragua <br>DIRECCIÓN DE INFORMÁTICA</p>
	</div>
	<div class="f-right" style="">
		<table class="th">
			<tbody>
				<tr>
					<td colspan="2"><span class="bold">Fecha: </span>{{ date('d/m/y') }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<h1>{{ $title }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
	<br><br>
	<div class="container">
		<table>
			<thead>
				<tr>
					@foreach ($data as $titulo)
					<th>{{ $titulo }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@forelse ($datos as $aritle)
				<tr>
					<td>{{ $aritle->responsable->person->first_name }} {{ $aritle->responsable->person->last_name }}</td>
					<td>@if ($aritle->article->department) {{ $aritle->article->department->department }} @else No Asignado. @endif</td>
					<td>{{ $aritle->article->type  }}</td>
					<td>@if ($aritle->expert) {{ $aritle->expert->person->first_name }} {{ $aritle->expert->person->first_name }} @else No Asignado. @endif</td>
					<td>{{ $aritle->article->report->created_at }}</td>
				</tr>
				@empty
				<h2>No existen Registros.</h2>
				@endforelse
			</tbody>
		</table>
	</div>

</body>
<script>
	setTimeout(() => {
		window.print()
		window.close()
	}, 500)
</script>
</html>