<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
          /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuentas= Cuenta::all();
        return view('admin.cuentas.index',compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.cuentas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:cuentas',
        ]);

        $cuenta=Cuenta::create($request->all());

        return redirect()->route('admin.cuentas.edit',$cuenta)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuenta $cuenta)
    {
        return view('admin.cuentas.edit',compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        $request->validate([
            'name'=>"required|unique:cuentas,name,$cuenta->id"
        ]);

        $cuenta->update($request->all());

        return redirect()->route('admin.cuentas.edit',$cuenta)->with('info', 'El registro se actualizo con exito');
    }
}
