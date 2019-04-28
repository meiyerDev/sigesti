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
}
