<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Report;
use App\Models\Request as Req;
use App\Models\Article;
use App\Models\Expert;
use App\Models\Department;
use App\Models\Responsable;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.2
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		if ($request->user()->hasAnyRole(['admin','boss']))
		{

		$report 	  = Report::all();
		$article 	  = Req::paginate(3);
		$article_count 	  = Article::all()->count();
		$departments  = Department::all();
		$experts 	  = Expert::all();
		$responsables = Responsable::all();
		// $impresoras	  = Article::where('type', 'Impresora')->count();
		// $article_count = $impresoras + $article->count();
		// dd($article_count);

		return view('home')
		->with('i',1)
		->with('reports',$report)
		->with('article_count',$article_count)
		->with('article',$article)
		->with('experts', $experts)
		->with('departments', $departments)
		->with('responsables', $responsables);
		// ->with('impresoras', $impresoras);
		}else{
			$expert = Expert::where('user_id',\Auth::user()->id)->first();
			$report = Req::where('expert_id',$expert->id)->paginate(3);
			$responsables = Responsable::all();
			
			return view('home')
			->with('report', $report)
			->with('responsables', $responsables)
			->with('i', 1);
		}


	}
}