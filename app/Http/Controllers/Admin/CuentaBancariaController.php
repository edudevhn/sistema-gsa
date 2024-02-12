<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CuentaBancaria;
use App\Models\Moneda;
use App\Models\ValueType;
use Illuminate\Http\Request;

class CuentaBancariaController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuentasBancarias= CuentaBancaria::all();
        return view('admin.cuentasBancarias.index',compact('cuentasBancarias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $monedas=Moneda::pluck('name','id');
        $monedas->prepend( 'Seleccione...','');
       // ( 'Seleccione...','');
        return view('admin.cuentasBancarias.create',compact('monedas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:cuenta_bancarias',
            'num_cuenta'=>"required|unique:cuenta_bancarias",
        ]);

        $cuentaBancaria=CuentaBancaria::create($request->all());

        return redirect()->route('admin.cuentasBancarias.edit',$cuentaBancaria)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuentaBancaria $cuentasBancaria)
    {
        $monedas=Moneda::pluck('name','id');
        $monedas->prepend( 'Seleccione...','');
       // ( 'Seleccione...','');
        return view('admin.cuentasBancarias.edit',compact('cuentasBancaria','monedas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CuentaBancaria $cuentasBancaria)
    {
        $request->validate([
            'name'=>"required|unique:cuenta_bancarias,name,$cuentasBancaria->id",
            'num_cuenta'=>"required|unique:cuenta_bancarias,num_cuenta,$cuentasBancaria->id",
        ]);

        $cuentasBancaria->update($request->all());

        return redirect()->route('admin.cuentasBancarias.edit',$cuentasBancaria)->with('info', 'El registro se actualizo con exito');
    }
}
