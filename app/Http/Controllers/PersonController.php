<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExpertRequest;
use Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use App\Models\Responsable;
use App\Models\Expert;
use App\Models\Report;
use App\Models\Department;
use App\Models\Article;

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
		$role_user = Role::find($request->role);
		
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

	// METODOS PERSONALES
	public function busExpert($id)
	{
		$person = Person::where('identity',$id)->first();
		if ($person!=null && $person->expert) {
			$expert = $person;
			$user = User::find($person->expert->user_id);
		}else{
			$expert = null;
			$user = null;
		}
		return \Response::json([
			'expert'=>$expert,
			'user'=>$user
		]);
	}

	public function editUser($id)
	{
		$user = User::find(\Auth::user()->id);

		return view('person.editPerfil')->with('user',$user);
	}

	public function updateUser(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'identity' => ['required'],
			'first_name' => ['required'],
			'last_name' => ['required'],
			'phone' => ['required'],
		]);

		if ($validator->fails()) {
			return back()
			->withErrors($validator)
			->withInput();
		}
		$user = User::find(\Auth::user()->id);
		if ($user->expert) {
			$user->expert->person->update([
				'identity' => $request->identity,
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'phone' => $request->phone
			]);
		}
		
		if (!empty($request->password) && !empty($request->confirmPassword)) {
			if ($request->password === $request->confirmPassword) {
			$user->update([
				'password'	=>	\Hash::make($request->password),
			]);
			}else{
				return back()->with('success','Error verifique sus contraseñas!');
			}
		}

		return back()->with('success','Se ha Actualizado con exito!');

	}

}
