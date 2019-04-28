<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Department;
use App\Article;
use App\Expert;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $departments  = Department::paginate(5);
        $article_count      = Article::all()->count();
        $article      = Article::all();
        $impresoras   = Article::where('type', 'Impresora')->count();
        $experts      = Expert::all();

        return view('departments.index')
        ->with('departments', $departments)
        ->with('article', $article)
        ->with('article_count',$article_count)
        ->with('experts', $experts)
        ->with('departments', $departments)
        ->with('impresoras', $impresoras);

    }

    // public function create()
    // {
    //     //
    // }

    public function store(Request $request)
    {
        // dd($request->department);
        $message = [
            'department.unique' =>  'El Nombre de Departamento ingresado ya existe.'
        ];

        $validator = Validator::make($request->all(),[
            'department'    =>  'required|unique:departments'
        ],$message);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $department = Department::create([
            'department' => $request->department,
        ]);

        return redirect()->route('department.index')->with('success', 'Se ha registrado con exito!');
    }


    public function show($id)
    {
        $department = Department::find($id);
        // dd($department);

        return view('departments.show')->with('department',$department);
    }

    public function edit($id)
    {
        $department = Department::find($id);
        // return view('departments.edit')->with('department', $department);
        return \Response::json(['department' => $department]);
    }


    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        $department->update([
            'department' => ($request->department)?$request->department:$department->department,
        ]);

        return back()->with('succes', 'Se ha editado de manera exitosa!');
    }


    public function destroy($id)
    {
        $department = Department::find($id);

        $department->delete();

        return redirect('department')->with('succes', 'Se ha eliminado de manera exitosa!');
    }
}
