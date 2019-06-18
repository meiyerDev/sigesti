<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expert;
use App\Models\Article;
use App\Models\Request as Req;

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
		if ($query->responsable) {
			$r = $query->responsable->person;
		}else{
			$r = 'no aplica';
		}
		$a = $query->only('brand','model','type');

		$articulo = 'Serial: '.$query->serial.', Modelo: '.$query->model.', Marca: '.$query->brand.', Tipo: '.$query->type.'; Departamento: ';
		if($d){
			$articulo .= $d->department.', Director:'.$d->firstname_director.' '.$d->lastname_director.',Teléfono de Departamento:'.$d->phone;
		}else{
			$articulo .= 'No asignado.';
		}

		$articulo.='; Cedula Responsable: ';
		if($query->responsable){
			$articulo.= $r->identity.', Nombre y Apellido: '.$r->first_name.' '.$r->last_name.', Teléfono: '.$r->phone;
		}else{
			$articulo.= 'No Posee.';
		}

		$qr = \QrCode::size(300)->generate($articulo);

		return \Response::json(['qr'=>$qr, 'a'=>$a]);
	}

	public function reportInventory($type = '')
	{
		if ($type != 'todos') {
			$a = Article::select('type','serial','model','brand','created_at')->where('type',$type)->get();
			$tit = 'REPORTE DE INVENTARIO POR TIPO: '.$type;
		}else{
			$a = Article::select('type','serial','model','brand','created_at')->get();
			$tit = 'REPORTE DE INVENTARIO';
		}
		$data = ['Tipo Artículo','Serial','Modelo','Marca','Fecha de Registro'];
		$dat = ['type','serial','model','brand','created_at'];

		return $this->reportePersonalizado($a,$data,$dat,$tit);
	}

	public function reportRequested()
	{
		if (\Auth::user()->hasAnyRole(['admin','boss'])) {
			$a = Req::all();
		}else{
			$a = Req::where('expert_id', \Auth::user()->id)->get();
		}
		$dat = ['responsable->person->first_name','department->department','type','report->expert->person->first_name', 'report->created_at'];
		$data = ['Responsable','Departamento','Tipo Artículo','Técnico','Fecha de Registro'];
		return view('reports.reporteSolicitudes')
		->with('datos',$a)
		->with('data',$data)
		->with('title','REPORTE DE SOLICITUDES');
	}

	public function reportTecnico($id)
	{
		$tecnico = Expert::find($id);
		$data = ['Artículo Reparado','Serial','Modelo','Marca','Dpt. Atendido','Fecha de Reparación'];
		return view('reports.reporteTecnico')
		->with('datos',$tecnico)->with('data',$data)->with('title','LISTADO DE TRABAJO REALIZADO');
	}

	public function reportePersonalizado($a,$data,$dat,$title)
	{
		return view('reports.reportePersonalizado')
		->with('datos',$a)
		->with('data',$data)
		->with('dat',$dat)
		->with('title',$title);
	}
}
