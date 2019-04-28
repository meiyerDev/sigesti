<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpertRequest;
use Validator;
use App\User;
use App\Role;
use App\Person;
use App\Responsable;
use App\Expert;
use App\Report;
use App\Department;
use App\Article;

class PersonController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
	{
		$experts = Expert::all();
		$departments  = Department::paginate(5);
		$article_count 	  = Article::all()->count();
		$article      = Article::paginate();
		$impresoras   = Article::where('type', 'Impresora')->count();
		$i = 1;

		return view('person.index')
		->with('experts', $experts)
		->with('i', $i)
		->with('departments', $departments)
		->with('article_count',$article_count)
		->with('article', $article)
		->with('departments', $departments)
		->with('impresoras', $impresoras);
	}

	public function store(ExpertRequest $request)
	{
		$role_user = Role::where('name', 'user')->first();
		// $message = [
		// 	'identity.unique' => 'La Cedula ingresada para el nuevo responsable ya está en uso'
		// ];

		// $validator = Validator::make($request->all(), [
		// 	'identity' => 'unique:people,identity'
		// ], $message);

		// if ($validator->fails()) {
		// 	return back()
		// 	->withErrors($validator)
		// 	->withInput();
		// }

		
		$user = User::create([
			'name' => $request->first_name,
			'user' => $request->user,
			'password' => \Hash::make($request->password),
		]);

		$user->roles()->attach($role_user);

		$person = Person::create([
			'identity' => $request->identity,
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'phone' 	 => ($request->phone)?$request->phone:'',
		]);

		$expert = Expert::create([
			'person_id'=>$person->id,
			'user_id'=>$user->id
		]);

		return redirect('expert')->with('succes', 'Se ha registrado de manera exitosa!');
	}

	public function show($id)
	{
		$expert = Person::where('identity',$id)->first();

		return \Response::json([
			'expert'=>$expert
		]);

	}

	public function edit($id)
	{
		// $expert = Person::find($id);
		$expert = Report::find($id);
		return \Response::json([
			'expert'=>$expert
		]);
	}

	public function update(Request $request, $id)
	{
		if ($request->boton == "reporteTecnico") {
			$report = Report::find($id);
			// dd($report);
			$report->update($request->all());
			return back()->with('succes', 'Se ha modificado de manera exitosa');

		}

		// Validar inputs de Update Técnicos
		$validator = Validator::make($request->all(),[
			'first_name'    =>  ['required','string','min:3'],
			'last_name'     =>  ['required','string','min:3'],
			'phone'         =>  ['nullable','numeric','min:11'],
		]);
		if ($validator->fails()) {
			return back()
			->withErrors($validator)
			->withInput();
		}
		
		$expert = Person::where('identity',$id)->first();
		$expert->update([
			'first_name'=>($request->first_name)?$request->first_name:$expert->first_name,
			'last_name'=>($request->last_name)?$request->last_name:$expert->last_name,
			'phone'=>($request->phone)?$request->phone:'',
		]);


		return back()->with('succes', 'Se ha modificado de manera exitosa');
	}


	public function destroy($id)
	{
		$person = Person::find($id);
		$expert = Expert::where('person_id',$person->id)->first();

		$countReport = $expert->reports->count();
		if ($countReport > 1) {
			foreach ($expert->reports as $reporte) {
				$reporte->update([
					'expert_id' => null
				]);
			}
		}elseif ($countReport != 0) {
			$expert->reports->first()->update([
				'expert_id' => null
			]);
		}

		$expert->user->delete();		

		$person->delete();

		return redirect('expert')->with('succes','Se ha eliminado de manera exitosa!');
	}

}
