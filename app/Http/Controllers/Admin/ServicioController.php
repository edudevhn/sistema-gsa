<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use App\Models\Moneda;
use App\Models\Servicio;
use App\Models\ValueType;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.servicios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $cuentas=Cuenta::pluck('name','id');
        $cuentas->prepend( 'Seleccione...','');
        $valueTypes=ValueType::pluck('name','id');
        $valueTypes->prepend( 'Seleccione...','');
        return view('admin.servicios.create',compact('cuentas','valueTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:servicios',
            'status'=>'required',
            'cuenta_id'=>'required',
            'value_type_id'=>'required'
        ]);
        $servicio=Servicio::create($request->all());

        return redirect()->route('admin.servicios.edit',$servicio)->with('info', 'El registro se guardo con exito');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        $cuentas=Cuenta::pluck('name','id');
        $cuentas->prepend( 'Seleccione...','');
        $valueTypes=ValueType::pluck('name','id');
        $valueTypes->prepend( 'Seleccione...','');
        return view('admin.servicios.edit',compact('servicio','cuentas','valueTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'name'=>"required|unique:servicios,name,$servicio->id",
            'status'=>'required',
            'cuenta_id'=>'required',
            'value_type_id'=>'required'
        ]);
        
        $servicio->update($request->all());

        return redirect()->route('admin.servicios.edit',$servicio)->with('info', 'El registro se actualizo con exito');
    }
}
