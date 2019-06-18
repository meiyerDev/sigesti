<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DatosRequest;
use Validator;
use App\Models\Person;
use App\Models\Responsable;
use App\Models\Department;
use App\Models\Article;
use App\Models\Expert;
use App\Models\Monitor;
use App\Models\Cpu;
use App\Models\Cartridge;
use App\Models\Desktop;
use App\Models\Request as Req;
use App\Models\Report;

class ReportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		// $request->user()->authorizeRoles(['admin']);

		$report = Report::all();
		$article = Article::all();
		$departments = Department::all();
		$responsables = Responsable::all();
		$experts = Expert::all();

		// CONTADOR
		$i = 1;

		// dd($article->find(3)->report->expert);
		return view('reports.index')
		->with('reports',$report)
		->with('i',$i)
		->with('article',$article)
		->with('experts', $experts)
		->with('responsables', $responsables)
		->with('departments', $departments);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function create()
	// {

	// }


	public function store(DatosRequest $request)
	{
		// dd($request->all());

		if ($request->responsable == 'nuevo')
		{
			$person = Person::create([
				'identity'   => $request->identity,
				'first_name' => $request->first_name,
				'last_name'  => $request->last_name,
				'phone' 	 => ($request->phone)?$request->phone:'',
			]);
			$respon = Responsable::create([
				'person_id' => $person->id,
			]);
		}

		// if ($request->department == 'nuevo')
		// {
		// 	$department = Department::create([
		// 		'department' => $request->departmento,
		// 		'firstname_director' => $request->firstname_director,
		// 		'lastname_director' => $request->lastname_director,
		// 		'phone' => $request->phoneDep
		// 	]);
		// }

		// $type    = $request->type;
		// $article = Article::create([
		// 	'model' 		 => $request->model,
		// 	'brand' 		 => $request->brand,
		// 	'serial' 		 => $request->serial,
		// 	'observation'	 => $request->observation,
		// 	'responsable_id' => ( $request->responsable == 'nuevo' ) ? $respon->id : $request->responsable,
		// 	'department_id'  => ( $request->department  == 'nuevo' ) ? $department->id : $request->department,
		// 	'type' 			 => $request->type,
		// 	'name_otro'		 => ($request->name_otro)?$request->name_otro:''
		// ]);

		$report = Report::create([
			'article_id' => $article->id,
			'request'    => $request->requested,
		]);

		// if ($type == 'Monitor' || $type == 'Monitor-Desktop')
		// {
		// 	$monitor = Monitor::create([
		// 		'article_id' => $article->id,
		// 		'inche' 	 => $request->inche,
		// 	]);
		// }

		// if ($type == 'Cpu')
		// {
		// 	$cpu = Cpu::create([
		// 		'ram' 		   => $request->ram,
		// 		'processor'    => $request->processor,
		// 		'so' 		   => $request->so,
		// 		'memory_video' => ($request->memory_video)?$request->memory_video:'',
		// 		'article_id'   => $article->id
		// 	]);
		// }

		if ($type == 'Monitor-Desktop')
		{
			// $article_cpu = Article::create([
			// 	'model' 		 => $request->model_cpu,
			// 	'brand' 		 => $request->brand_cpu,
			// 	'serial' 		 => $request->serial_cpu,
			// 	'observation' 	 => $request->observation_cpu,
			// 	'department_id'  => ( $request->department  == 'nuevo' ) ? $department->id : $request->department,
			// 	'responsable_id' => ( $request->responsable == 'nuevo' ) ? $respon->id : $request->responsable,
			// 	'type' 			 => 'Cpu-Desktop'
			// ]);

			// $cpu = Cpu::create([
			// 	'ram' 		   => $request->ram,
			// 	'processor'    => $request->processor,
			// 	'so' 		   => $request->so,
			// 	'memory_video' => $request->memory_video,
			// 	'article_id'   => $article_cpu->id
			// ]);

			// $desktop = Desktop::create([
			// 	'cpu_id' 		=> $cpu->id,
			// 	'monitor_id' 	=> $monitor->id,
			// 	'department_id' => $article->department_id
			// ]);;

			$report_cpu = Report::create([
				'article_id'  => $article_cpu->id,
				'request' 	  => $request->requested,
				'description' => ( $request->description ) ? $request->description : 'NULL',
			]);
		}

		// if ($type == 'Cartucho') {
		// 	$cartucho = Cartridge::create([
		// 		'code'	=>	$request->code,
		// 		'article_id'	=>	$article->id
		// 	]);
		// }


		return redirect('home')->with('succes', 'Se ha registrado de manera exitosa!');
	}

	public function show($id)
	{
		$article    = Article::find($id);
		$department = $article->department;
		$respon 	= $article->responsable->person;
		$expert 	= $article->report->expert->person;

		return \Response::json(['article' => $article]);
	}


	public function edit($id)
	{
		$article 	= Article::find($id);
		$department = $article->department;
		$respon 	= $article->responsable->person;

		if ( $article->monitor ):
			$monitor = $article->monitor;
		else:
			$monitor = 'NULL';
		endif;

		if ($article->cpu):
			$cpu = $article->cpu;
		else:
			$cpu = 'NULL';
		endif;

		return \Response::json([
			'article' 	 => $article,
			'department' => $department,
			'respon' 	 => $respon,
			'cpu' 		 => $cpu,
			'monitor' 	 => $monitor
		]);
	}


	public function update(Request $request, $id)
	{
		/*ASIGNAR TECNICO*/
		if( $request->expert )
		{
			$article = Article::find($id);
			$article->report->update([
				'expert_id' => $request->expert_id
			]);
			$article->experts()->attach($request->expert_id);
			$article->request->update(['expert_id' => $request->expert_id]);
		}

		return redirect('home')->with('succes','Se ha asignado el técnico de manera exitosa!');
	}


	public function destroy($id)
	{
		$article = Article::find($id);

		if ($article->monitor && $article->monitor->desktop):
			$article->monitor->desktop->first()->cpu->article->delete();

		elseif ($article->cpu && $article->cpu->desktop->count() != 0):
			$article->cpu->desktop->first()->monitor->article->delete();

		endif;

		if ( $article->where('responsable_id', $article->responsable_id)->count() > 1 ):
			$article->delete();
		else:
			$article->responsable->person->delete();
		endif;

		return back()->with('succes','Se ha eliminado el registro con exito!');
		// return response()->json(['succes'=>'Se ha eliminado el registro con exito!', 200]);
	}

}