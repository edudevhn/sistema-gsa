<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosFiscalesRango;
use App\Models\DocumentosFiscalesTipo;
use Illuminate\Http\Request;

class DocumentosFiscalesRangoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docsFiscalesRangos= DocumentosFiscalesRango::all();
        return view('admin.rangoDocumentosFiscales.index',compact('docsFiscalesRangos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoDocumento=DocumentosFiscalesTipo::pluck('name','id');
        $tipoDocumento->prepend( 'Seleccione...','');
        return view('admin.rangoDocumentosFiscales.create',compact('tipoDocumento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_inicial'=>'required|unique:documentos_fiscales_rangos',
            'numero_final'=>'required|unique:documentos_fiscales_rangos',
            'cantidad_otorgada'=>'required',
            'fecha_limite_emision'=>'required',
            'numero_cai'=>'required',
            'documento_tipo_id'=>'required'
        ]);

        $rangoDocumentosFiscale=DocumentosFiscalesRango::create($request->all());

        return redirect()->route('admin.rangoDocumentosFiscales.edit',$rangoDocumentosFiscale)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
    */
    public function edit(DocumentosFiscalesRango $rangoDocumentosFiscale)
    {
        $tipoDocumento=DocumentosFiscalesTipo::pluck('name','id');
        $tipoDocumento->prepend( 'Seleccione...','');
        return view('admin.rangoDocumentosFiscales.edit',compact('rangoDocumentosFiscale','tipoDocumento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentosFiscalesRango $rangoDocumentosFiscale)
    {
        $request->validate([
            'numero_inicial'=>"required|unique:documentos_fiscales_rangos,numero_inicial,$rangoDocumentosFiscale->id",
            'numero_final'=>"required|unique:documentos_fiscales_rangos,numero_final,$rangoDocumentosFiscale->id",
            'cantidad_otorgada'=>'required',
            'fecha_limite_emision'=>'required',
            'numero_cai'=>'required',
            'documento_tipo_id'=>'required'
        ]);

        $rangoDocumentosFiscale->update($request->all());

        return redirect()->route('admin.rangoDocumentosFiscales.edit',$rangoDocumentosFiscale)->with('info', 'El registro se actualizo con exito');
    }

}
