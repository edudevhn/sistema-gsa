<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduana;
use Illuminate\Http\Request;

class AduanaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:admin.categories.index')->only('index');
    //     $this->middleware('can:admin.categories.create')->only('create','store');
    //     $this->middleware('can:admin.categories.edit')->only('edit','update');
    //     $this->middleware('can:admin.categories.destroy')->only('destroy');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aduanas= Aduana::all();
        return view('admin.aduanas.index',compact('aduanas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aduanas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:aduanas',
            'status'=>'required',
        ]);

        $aduana=Aduana::create($request->all());

        return redirect()->route('admin.aduanas.edit',$aduana)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aduana $aduana)
    {
        return view('admin.aduanas.edit',compact('aduana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aduana $aduana)
    {
        $request->validate([
            'name'=>"required|unique:aduanas,name,$aduana->id",
            'status'=>'required'
        ]);

        $aduana->update($request->all());

        return redirect()->route('admin.aduanas.edit',$aduana)->with('info', 'El registro se actualizo con exito');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Aduana $aduana)
    // {
    //     $aduana->delete();

    //     return redirect()->route('admin.aduanas.index')->with('info', 'La Aduana se elimino con exito');
    // }
}
