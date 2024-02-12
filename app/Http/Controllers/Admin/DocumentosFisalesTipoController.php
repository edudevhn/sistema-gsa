<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosFiscalesTipo;
use Illuminate\Http\Request;

class DocumentosFisalesTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docsFiscalesTipos= DocumentosFiscalesTipo::all();
        return view('admin.tipoDocumentosFiscales.index',compact('docsFiscalesTipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipoDocumentosFiscales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:documentos_fiscales_tipos',
        ]);

        $tipoDocumentosFiscale=DocumentosFiscalesTipo::create($request->all());
       // return $docsFiscalesTipo;

        return redirect()->route('admin.tipoDocumentosFiscales.edit',$tipoDocumentosFiscale)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentosFiscalesTipo $tipoDocumentosFiscale)
    {
        return view('admin.tipoDocumentosFiscales.edit',compact('tipoDocumentosFiscale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentosFiscalesTipo $tipoDocumentosFiscale)
    {
        $request->validate([
            'name'=>"required|unique:documentos_fiscales_tipos,name,$tipoDocumentosFiscale->id",
        ]);

        $tipoDocumentosFiscale->update($request->all());

        return redirect()->route('admin.tipoDocumentosFiscales.edit',$tipoDocumentosFiscale)->with('info', 'El registro se actualizo con exito');
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
