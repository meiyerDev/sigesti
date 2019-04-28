<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comprobante</title>
	<style>
	.head{
		margin: 10px 10px;
	}
	img{
		width: 80px;
		float: left;
	}
	.head p{
		margin-top: 5px;
		font-size: 20px;
	}
	h2{
		margin-top: 75px;
		text-align: center;
	}
	.right{
		text-align: right;
	}
	.container{
		border: 1px solid #000;
	}
	table{
		font-family: Arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}
	td,th{
		border-top: 1px solid #000;
		border-right:  1px solid #000;
		border-left: 1px solid #000;
		border-bottom: 1px solid #000;
		text-align: left;
		padding: 8px;
	}
	tr:nth-child(even){
		background-color: #fff;
	}
	.firmas{
		height: 100px;
		vertical-align: top;
	}
	.tr{
		height: 50px;
	}
	.firmas .bold{
		font-weight: bold;
	}
	.ula{
		border-right: none;
	}
	.left{
	}
</style>
</head>
<body>
	<div class="container">
		<div class="head">
			<img src="{{ asset('img/alcaldia.jpg') }}" alt="" >
			<p>&nbsp;República Bolivariana de Venezuela <br>&nbsp;Alcaldía del Municipio Sucre- Cagua- Estado Aragua <br>&nbsp;DIRECCIÓN DE INFORMÁTICA</p>
			<h2>CONTROL DE MANTENIMIENTO DE EQUIPOS</h2>
			<p class="right">CAGUA {{date('d/m/Y')}}</p>
		</div>
		<div>
			<table>
				<thead>
					<tr>
						<th>Información</th>
						<th>Tipo</th>
						<th>Serial</th>
						<th>Modelo</th>
						<th class="ul">Marca</th>
					</tr>
				</thead>
				<tbody>
					<tr class="tr">
						<th>Datos Del Equipo</th>
						<td>{{$article->type}}</td>
						<td>{{$article->serial}}</td>
						<td>{{$article->model}}</td>
						<td class="ul">{{$article->brand}}</td>
					</tr>
					<tr class="tr">
						<th>Departamento</th>
						<td colspan="4">{{$article->department->department}}</td>
					</tr>
					<tr class="tr">
						<th>Observaciones</th>
						<td colspan="4" class="ul">{{$article->observation}}</td>
					</tr>
					<tr class="tr">
						<th>Solicitante</th>
						<td colspan="4">{{$article->responsable->person->first_name}} {{$article->responsable->person->last_name}}</td>
					</tr>
				</tbody>
				{{-- <tfoot>
					<tr>
						<td colspan="2" class="firmas">
							<span class="bold">Departamento Solicitante:</span><br><br>
							{{ $article->department->department }}</td>
						<td class="firmas ul" colspan="3">
							<span class="bold">Direccion de Informatica</span>
						</td>
					</tr>
				</tfoot> --}}
			</table>
		</div>
	</div>
	<div style="margin:auto;margin-top: 400px;">
		<div style="margin-left: 250px;margin-right:250px;height:2px;background-color: black;">&nbsp;&nbsp;&nbsp;</div>
		<div style="margin-left: 320px;margin-top: 10px;">Sello y Firma <br> <span style="margin-left: -40px">Dirección de Informática</span></div>
	</div>
</body>
<script>
	setTimeout(() => {
		window.print()
		window.close()
	}, 500)
</script>
</html>