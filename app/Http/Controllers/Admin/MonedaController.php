<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moneda;
use Illuminate\Http\Request;

class MonedaController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monedas= Moneda::all();
        return view('admin.monedas.index',compact('monedas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.monedas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:monedas',
        ]);

        $moneda=Moneda::create($request->all());

        return redirect()->route('admin.monedas.edit',$moneda)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moneda $moneda)
    {
        return view('admin.monedas.edit',compact('moneda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moneda $moneda)
    {
        $request->validate([
            'name'=>"required|unique:monedas,name,$moneda->id",
        ]);

        $moneda->update($request->all());

        return redirect()->route('admin.monedas.edit',$moneda)->with('info', 'El registro se actualizo con exito');
    }
}
