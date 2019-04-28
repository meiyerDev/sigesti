<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link rel="icon" href="{{asset('img/alcaldia.jpg')}}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image: url({{ asset('img/fondo.png') }});" class="body" >
