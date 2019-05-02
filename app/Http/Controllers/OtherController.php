<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expert;
use App\Article;

class OtherController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function assignment(Request $request)
	{
		// SOLO LOS TECNICOS PUEDEN VISITAR ESTA PAGINA
		$request->user()->authorizeRoles(['user']);
		$expert = Expert::where('user_id',\Auth::user()->id)->first()->reports;
		// dd($id);
		
		$i = 1;
		return view('reports.expertReport')
				->with('experts', $expert)
				->with('i', $i);
	}

	public function reportar($id)
	{
		$article = Article::find($id);
		return view('reports.comprobante', compact('article'));
	}

	public function pdf($id)
	{
		$article = Article::find($id);
		return view('reports.report', compact('article'));
	}

	public function dataQR($id)
	{
		// $a = \DB::table('articles')->join('departments','departments.id','=','articles.department_id')->join('responsables','responsables.id','=','articles.responsable_id')->select('serial as Serial','brand as Marca','model as Modelo','departments.department as Departamento','responsables.person_id as responsableID')->where('articles.id','=',$id)->get();

		$query = Article::find($id);
		$d = $query->department;
		$r = $query->responsable->person;
		$a = $query->only('brand','model','type');

		$articulo = 'Serial: '.$query->serial.', Modelo: '.$query->model.', Marca: '.$query->brand.', Tipo: '.$query->type.'; Departamento: '.$d->department.', Director:'.$d->firstname_director.' '.$d->lastname_director.',Teléfono de Departamento:'.$d->phone.'; Cedula Responsable: '.$r->identity.', Nombre y Apellido: '.$r->first_name.' '.$r->last_name.', Teléfono: '.$r->phone;

		$qr = \QrCode::size(300)->generate($articulo);

		return \Response::json(['qr'=>$qr, 'a'=>$a]);
	}
}
