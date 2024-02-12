<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TiposPersona;
use Illuminate\Http\Request;

class TiposPersonaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoPersonas= TiposPersona::all();
        return view('admin.tipoPersonas.index',compact('tipoPersonas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipoPersonas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:tipos_personas',
        ]);

        $tipoPersona=TiposPersona::create($request->all());

        return redirect()->route('admin.tipoPersonas.edit',$tipoPersona)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TiposPersona $tipoPersona)
    {
        return view('admin.tipoPersonas.edit',compact('tipoPersona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TiposPersona $tipoPersona)
    {
        $request->validate([
            'name'=>"required|unique:tipos_personas,name,$tipoPersona->id",
        ]);

        $tipoPersona->update($request->all());

        return redirect()->route('admin.tipoPersonas.edit',$tipoPersona)->with('info', 'El registro se actualizo con exito');
    }
}
