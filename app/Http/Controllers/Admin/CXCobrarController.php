<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosFiscales;
use App\Models\Factura;
use App\Models\Persona;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CXCobrarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cxc.index');
    }


    public function generarPDF(Request $request)
    {
        $persona = Persona::leftjoin('terminos_pagos','personas.termino_pago_id','=','terminos_pagos.id')
        ->select('personas.id', 'personas.name', 'rtn','dias_pago','terminos_pagos.name as terminoPago')
        ->where('personas.id',$request->input('persona_id'))
        ->first();
        //dd($persona);
        /*$list = Embarque::join('facturas', 'embarques.id','=','facturas.embarque_id')
        ->select('embarques.id', 'num_embarque','fecha',Embarque::raw('SUM(facturas.total) as total'))
        ->groupBy('embarques.id')
        ->orderBy('embarques.num_embarque', 'asc')
        ->get();*/
        $fechaInicio=new Carbon();
       // dd($request->input('fechaFin'));
        $documentosFiscales=DocumentosFiscales::join('embarques', 'embarques.id','=','documentos_fiscales.embarque_id')
        ->join('documentos_fiscales_detalles', 'documentos_fiscales_detalles.id','=','documentos_fiscales.documento_fiscal_detalle_id')
        ->leftJoin('pagos', 'pagos.documento_fiscal_id','=','documentos_fiscales.id')
        ->select('embarques.num_embarque','documentos_fiscales.numero_documento','documentos_fiscales.total','documentos_fiscales_detalles.fecha_emision','documentos_fiscales_detalles.fecha_vencimiento',
            DocumentosFiscales::raw('DATEDIFF(now(), documentos_fiscales_detalles.fecha_vencimiento) AS morocidad'),
            DocumentosFiscales::raw('SUM(pagos.pago_recibido) as pago_recibido')
        ) 
        ->where('embarques.persona_id',$request->input('persona_id'))
        ->groupBy('documentos_fiscales.numero_documento', 'documentos_fiscales_detalles.fecha_vencimiento')
        // ->setBindings([':fechaFin' => $fechaFin])
        ->get();
        
        
        $pathImage=config('config-myapp.logo_path');
        $nombreImagen = Storage::get($pathImage);// "https://static.bandainamcoent.eu/high/one-piece/one-piece-odyssey/00-page-setup/OPOD_header_mobile_new.jpg";
        
        $imagenBase64 = "data:image/png;base64," . base64_encode($nombreImagen);
        // dd($imagenBase64);
        // Crea una nueva instancia de Dompdf
        $dompdf = new Dompdf();
        // Puedes cargar la vista que deseas convertir a PDF
        //dd($totales);
        $html = view('admin.cxc.pdf',compact('imagenBase64','persona','documentosFiscales','fechaInicio'))->render();

        // Carga el contenido HTML al objeto Dompdf
        $dompdf->loadHtml($html);
        // Define el tamaño de papel como Oficio (8.5x13 pulgadas)
        $customPaper = array(0, 0, 612, 1008); // Ancho x Alto en puntos (1 pulgada = 72 puntos)
        $dompdf->setPaper($customPaper, 'landscape'); // Cambia a 'portrait' si deseas orientación vertical

        // Opcional: puedes ajustar las opciones de configuración si has publicado la configuración
        // $dompdf->setPaper('A4', 'landscape');

        // Renderiza el contenido HTML en PDF
        $dompdf->render();

        // Genera el PDF y envía la respuesta al navegador para su descarga
       // return $dompdf->stream('nombre_del_archivo.pdf');
          // Obtener el contenido del PDF generado
          $output = $dompdf->output();

          // Devolver el PDF como respuesta con el encabezado adecuado para abrirlo en una nueva pestaña
          return response($output, 200)->header('Content-Type', 'application/pdf')->header('Content-Disposition', 'inline; filename="archivo.pdf"');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
