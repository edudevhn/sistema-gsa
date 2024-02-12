<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ValueType;
use Illuminate\Http\Request;

class ValueTypeController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valueTypes= ValueType::all();
        return view('admin.valueTypes.index',compact('valueTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.valueTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:value_types',
        ]);

        $valueType=ValueType::create($request->all());

        return redirect()->route('admin.valueTypes.edit',$valueType)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ValueType $valueType)
    {
        return view('admin.valueTypes.edit',compact('valueType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ValueType $valueType)
    {
        $request->validate([
            'name'=>"required|unique:value_types,name,$valueType->id",
        ]);

        $valueType->update($request->all());

        return redirect()->route('admin.valueTypes.edit',$valueType)->with('info', 'El registro se actualizo con exito');
    }
}
