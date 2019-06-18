<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// models
use App\Models\Department;
use App\Models\Article;
use App\Models\Expert;
use App\Models\Monitor;
use App\Models\Cpu;
use App\Models\Cartridge;
use App\Models\Desktop;
use App\Models\Report;
use App\Models\Responsable;

class InventoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->user()->hasRole('admin'))
		{


			$report 	  = Report::all();
			$article 	  = Article::paginate(3);
			$article_count 	  = Article::all()->count();
			$departments  = Department::all();
			$experts 	  = Expert::all();
			$responsable 	  = Responsable::all();
		// $impresoras	  = Article::where('type', 'Impresora')->count();
		// $article_count = $impresoras + $article->count();
		// dd($article_count);

			return view('inventory.index')
			->with('i',1)
			->with('reports',$report)
			->with('article_count',$article_count)
			->with('article',$article)
			->with('experts', $experts)
			->with('departments', $departments)
			->with('responsables', $responsable);
		// ->with('impresoras', $impresoras);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'type'					=>	['required'],
			'model'					=>	['required'],
			'brand'					=>	['required'],
			'serial'				=>	['required'],
			'code'					=>	['required_if:type,Cartucho'],
			'name_otro'				=>	['nullable','required_if:type,Otro','min:3','string'],
			'inche'					=>	['nullable','required_if:type,Monitor','required_if:type,Monitor-Desktop'],
			'model_cpu'				=>	['required_if:type,Monitor-Desktop'],
			'brand_cpu'				=>	['required_if:type,Monitor-Desktop'],
			'serial_cpu'			=>	['required_if:type,Monitor-Desktop'],
			'ram'					=>	['nullable','string'],
			'processor'				=>	['nullable','string'],
			'so'					=>	['required_if:type,Cpu','required_if:type,Monitor-Desktop'],
			'memory_video'			=>	['nullable','string'],
		]);

		if ($validator->fails()) {
			return back()
			->withErrors($validator)
			->withInput();
		}

		if ($request->department == 'nuevo')
		{
			$department = Department::create([
				'department' => $request->departmento,
				'firstname_director' => $request->firstname_director,
				'lastname_director' => $request->lastname_director,
				'phone' => $request->phoneDep
			]);
		}

		$article = Article::create([
			'model' 		 => $request->model,
			'brand' 		 => $request->brand,
			'serial' 		 => $request->serial,
			'department_id'  => ( $request->department  == 'nuevo' ) ? $department->id : $request->department,
			'type' 			 => $request->type,
			'name_otro'		 => ($request->name_otro)?$request->name_otro:''
		]);
		
		$type    = $request->type;

		if ($type == 'Monitor' || $type == 'Monitor-Desktop')
		{
			$monitor = Monitor::create([
				'article_id' => $article->id,
				'inche' 	 => $request->inche,
			]);
		}

		if ($type == 'Cpu')
		{
			$cpu = Cpu::create([
				'ram' 		   => $request->ram,
				'processor'    => $request->processor,
				'so' 		   => $request->so,
				'memory_video' => ($request->memory_video)?$request->memory_video:'',
				'article_id'   => $article->id
			]);
		}

		if ($type == 'Monitor-Desktop')
		{
			$article_cpu = Article::create([
				'model' 		 => $request->model_cpu,
				'brand' 		 => $request->brand_cpu,
				'serial' 		 => $request->serial_cpu,
				'observation' 	 => $request->observation_cpu,
				'department_id'  => ( $request->department  == 'nuevo' ) ? $department->id : $request->department,
				'responsable_id' => ( $request->responsable == 'nuevo' ) ? $respon->id : $request->responsable,
				'type' 			 => 'Cpu-Desktop'
			]);

			$cpu = Cpu::create([
				'ram' 		   => $request->ram,
				'processor'    => $request->processor,
				'so' 		   => $request->so,
				'memory_video' => $request->memory_video,
				'article_id'   => $article_cpu->id
			]);

			$desktop = Desktop::create([
				'cpu_id' 		=> $cpu->id,
				'monitor_id' 	=> $monitor->id,
				'department_id' => $article->department_id
			]);
		}

		if ($type == 'Cartucho') {
			$cartucho = Cartridge::create([
				'code'	=>	$request->code,
				'article_id'	=>	$article->id
			]);
		}

		return back()->with('succes', 'Se ha registrado de manera exitosa!');
	}

	public function show($id)
	{
		$a = Article::find($id);
		
		return $a;
	}

	public function update(Request $request,$id)
	{
		$validator = Validator::make($request->all(),[
			'model'					=>	['required'],
			'brand'					=>	['required'],
			'serial'				=>	['required'],
		]);

		if ($validator->fails()) {
			return back()
			->withErrors($validator)
			->withInput();
		}

		$a = Article::find($id);



		$a->update([
			'model' 		 => ($request->model)?$request->model:$a->model,
			'brand' 		 => ($request->brand)?$request->brand:$a->brand,
			'serial' 		 => ($request->serial)?$request->serial:$a->serial,
		]);

		return back()->with('succes','Se ha actualizado de manera exitosa!');

	}

	public function destroy($id)
	{
		$article = Article::find($id);

		if ($article->monitor && $article->monitor->desktop){

			$article->monitor->desktop->first()->cpu->article->delete();

		}elseif ($article->cpu && $article->cpu->desktop->count() != 0){

			$article->cpu->desktop->first()->monitor->article->delete();

		}

		$article->delete();

		return back()->with('succes','Se ha eliminado el registro con exito!');
	}

	public function asignarDepart(Request $request, $id)
	{
		$validator = Validator::make($request->all(),[
			'department' 			=> 'required',
			'departmento' 			=> ['nullable','string','required_if:department,nuevo'],
			'firstname_director' 	=> ['nullable','string','required_if:department,nuevo'],
			'lastname_director' 	=> ['nullable','string','required_if:department,nuevo'],
			'phoneDep' 				=> ['nullable','string','required_if:department,nuevo'],
		]);

		if ($validator->fails()) {
			return back()
			->withErrors($validator)
			->withInput();
		}
		$article = Article::find($id);
		if ($request->departmento) {
			$department = Department::create([
				'department'			=> $request->departmento,
				'firstname_director'	=> $request->firstname_director,
				'lastname_director'		=> $request->lastname_director,
				'phone'					=> $request->phoneDep,
			]);
		}
		$article->update(['department_id'=>($request->departmento)?$department->id:$request->department]);
		return back()->with('succes','Se le ha asignado un departamento con exito!');
	}
}
