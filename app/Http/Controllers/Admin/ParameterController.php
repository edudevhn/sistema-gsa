<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parameters= Parameter::all();
        return view('admin.parameters.index',compact('parameters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parameters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:parameters',
            'value'=>'required'
        ]);

        $parameter=Parameter::create($request->all());

        return redirect()->route('admin.parameters.edit',$parameter)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parameter $parameter)
    {
        return view('admin.parameters.edit',compact('parameter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parameter $parameter)
    {
        $request->validate([
            'name'=>"required|unique:parameters,name,$parameter->id",
            'value'=>'required'
        ]);

        $parameter->update($request->all());

        return redirect()->route('admin.parameters.edit',$parameter)->with('info', 'El registro se actualizo con exito');
    }
}
