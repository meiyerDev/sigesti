<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Models
use App\Models\Article;
use App\Models\Person;
use App\Models\Responsable;
use App\Models\Report;
use App\Models\Request as Req;

class RequestsController extends Controller
{
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'responsable'			=>	['required'],
			'identity'				=>	['nullable','required_if:responsable,nuevo','unique:people','numeric','min:7'],
			'first_name'			=>	['nullable','required_if:responsable,nuevo','string','min:3','max:20'],
			'last_name'				=>	['nullable','required_if:responsable,nuevo','string','min:3','max:20'],
			'phone'					=>	['nullable','numeric','min:11'],
			'requested'				=>	['required'],
			'observation'			=>	['required'],
		]);

		if ($validator->fails()) {
			return back()
			->withErrors($validator)
			->withInput();
		}
		
		$article = Article::find($request->id);

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
		}else{
			// $article->update(['responsable_id'=>$request->responsable,'observation' => $request->observation]);

		}

		if (\Auth::user()->hasRole('user')) {
			$tecnico = \Auth::user()->id;
		}else{
			$tecnico = NULL;
		}

		$req = Req::create(['responsable_id'=>($request->responsable == 'nuevo')?$respon->id:$request->responsable,'observation' => $request->observation, 'expert_id' => $tecnico,'article_id'=>$article->id]);
		if ($article->monitor) {
			$req = Req::create(['responsable_id'=>($request->responsable == 'nuevo')?$respon->id:$request->responsable,'observation' => $request->observation, 'expert_id' => $tecnico,'article_id'=>$article->monitor->desktop->cpus->article->id]);
		
		}elseif ($article->cpus) {
			$req = Req::create(['responsable_id'=>($request->responsable == 'nuevo')?$respon->id:$request->responsable,'observation' => $request->observation, 'expert_id' => $tecnico,'article_id'=>$article->cpus->desktop->monitor->article->id]);
		
		}

		$report = Report::create([
			'article_id' => $article->id,
			'request'    => $request->requested,
			'confirmed'	 =>	0,
			'expert_id'  => $tecnico
		]);

		if ($article->type == 'Monitor-Desktop')
		{
			$report_cpu = Report::create([
				'article_id'  => $article->monitor->desktop->cpus->article->id,
				'request' 	  => $request->requested,
				'confirmed'	 =>	0,
				'description' => ( $request->description ) ? $request->description : 'NULL',
				'expert_id'   => $tecnico
			]);
		}

		return redirect('home')->with('succes', 'Se ha registrado de manera exitosa!');
	}

	public function show($id)
	{
		$a = Article::where('serial',$id)->first();
		if ($a != null) {
			$r = $a->report()->first();
		}else{$r = '';}

		return ['a'=>$a,'r'=>$r];
	}

	public function destroy($id)
	{
		$a = Article::find($id);

		if ( $a->request->where('responsable_id', $a->request->responsable_id)->count() < 1 ){
			$responsable = Responsable::find($a->request->responsable_id);
			$responsable->person->delete();
			$a->report->delete();
		}else{
			if ($a->monitor) {
				$a->monitor->desktop->cpus->article->request->delete();
			}elseif ($a->cpus) {
				$a->cpus->desktop->monitor->article->request->delete();
			}
			$a->request->delete();
			$a->report->delete();
		}

		return redirect('home')->with('succes', 'Se ha Elminidao de manera exitosa!');
	}
}
