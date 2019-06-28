<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reporte de Reparaciones</title>
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
	h2{margin-top: 80px;
	margin-left: 100px;
	text-align: center;}
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
	<h2>{{ $title }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
	<br>
	<h4>Técnico: {{ $datos->person->first_name }} {{ $datos->person->last_name }} | Cédula: {{ $datos->person->identity }}</h4>
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
				@php $i = 0 @endphp
				@forelse ($datos->reports as $aritle)
				@if ($aritle->confirmed != 0)
				<tr>
					<td>{{ $aritle->article->type }}</td>
					<td>{{ $aritle->article->serial  }}</td>
					<td>{{ $aritle->article->model  }}</td>
					<td>{{ $aritle->article->brand  }}</td>
					<td>@if ($aritle->article->department) {{ $aritle->article->department->department }} @else No Asignado. @endif</td>
					<td>{{ $aritle->updated_at }}</td>
				</tr>
				@php $i+=1 @endphp
				@elseif($i==0)
				@php $i+=1 @endphp
				<h3>Sin Reparaciones.</h3>
				@endif

				@empty
				<h3>No existen Registros.</h3>
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