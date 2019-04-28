<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\Article;
use App\Expert;
use App\Department;
use App\Responsable;

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
		if ($request->user()->hasRole('admin'))
		{

		$report 	  = Report::all();
		$article 	  = Article::paginate(3);
		$article_count 	  = Article::all()->count();
		$departments  = Department::all();
		$experts 	  = Expert::all();
		$responsables = Responsable::all();
		// $impresoras	  = Article::where('type', 'Impresora')->count();
		// $article_count = $impresoras + $article->count();
		// dd($article_count);

		return view('home')
		->with('reports',$report)
		->with('article_count',$article_count)
		->with('article',$article)
		->with('experts', $experts)
		->with('departments', $departments)
		->with('responsables', $responsables);
		// ->with('impresoras', $impresoras);
		}else{
			$expert = Expert::where('user_id',\Auth::user()->id)->first()->reports;

			$i = 1;
			return view('reports.expertReport')
			->with('experts', $expert)
			->with('i', $i);
		}


	}
}