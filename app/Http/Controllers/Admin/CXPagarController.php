<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Costo;
use App\Models\Factura;
use App\Models\Persona;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CXPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cxp.index');
    }


    public function generarPDF(Request $request)
    {
        $persona = Persona::leftjoin('terminos_pagos','personas.termino_pago_id','=','terminos_pagos.id')
        ->select('personas.id', 'personas.name', 'rtn','dias_pago','terminos_pagos.name as terminoPago')
        ->where('personas.id',$request->input('persona_id'))
        ->first();
        /*$list = Embarque::join('facturas', 'embarques.id','=','facturas.embarque_id')
        ->select('embarques.id', 'num_embarque','fecha',Embarque::raw('SUM(facturas.total) as total'))
        ->groupBy('embarques.id')
        ->orderBy('embarques.num_embarque', 'asc')
        ->get();*/
        $fechaInicio=$request->input('fechaInicio');
        $fechaFin=$request->input('fechaFin');
       // dd($request->input('fechaFin'));
        $facturas=Costo::leftJoin('embarque_costo', 'embarque_costo.costo_id','=','costos.id')
        ->leftJoin('embarques', 'embarques.id','=','embarque_costo.embarque_id')
        ->leftJoin('costo_pagos', 'costo_pagos.costo_id','=','costos.id')
        ->select('costos.fecha_factura','costos.total','embarques.num_embarque','costos.documento_cobro',
            Costo::raw('DATEDIFF(now(), costos.fecha_factura) AS morocidad'),
            Costo::raw('SUM(costo_pagos.total_pago) as pago_aplicado')
        ) 
        ->where('costos.proveedor_id',$request->input('persona_id'))
        ->groupBy('embarques.num_embarque','costos.total','costos.documento_cobro','costos.fecha_factura')
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
        $html = view('admin.cxp.pdf',compact('imagenBase64','persona','facturas','fechaInicio','fechaFin'))->render();

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
