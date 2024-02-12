<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosFiscales;
use App\Models\Factura;
use App\Models\Moneda;
use App\Models\Pago;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pagos.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Pago $pago)
    {
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $monedas =$this->addSelect($monedas);
        return view('admin.pagos.create',compact('pago','monedas'));
    }


    public function createDocumentoFiscalPago(DocumentosFiscales $documentoFiscal)
    {
        
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $monedas =$this->addSelect($monedas);
        return view('admin.pagos.createDocumentoFiscalPago',compact('documentoFiscal','monedas'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //return $request;
//    $request->validate([
//         'fechaEmision'=>'required',
//         'fechaVencimiento'=>'required',
//         'destinoFinal'=>'required',
//         'total'=>'required',
//         'persona_id'=>'required',
//         'moneda_id'=>'required',
//         'aduana_id'=>'required'
//     ]);
        $pago =new Pago;
        
        $pago->referencia=$request->input('referencia_pago');
        $pago->fecha_pago=$request->input('fecha_pago');
        //$pago->descripcion=$request->input('descripcion');
        $pago->valor_facturado=$request->input('valor_facturado');
        $pago->pago_recibido=$request->input('pago_recibido');
        $pago->saldo_actual=$request->input('saldo_actual');
        $pago->pago_actual=$request->input('pago_actual');
        $pago->retencion=$request->input('valor_retencion');
        $pago->total_pago_aplicado=$request->input('total_pago_aplicado');
        $pago->saldo=$request->input('saldo');
        $pago->constancia_retencion=$request->input('num_constancia_referencia');
        $pago->documento_fiscal_id=$request->input('documento_fiscal_id');
        $pago->banco_id=$request->input('banco_id');
        $pago->moneda_id=$request->input('moneda_id');
        $pago->cuenta_bancaria_id=$request->input('cuenta_bancaria_id');
        $pago->metodo_pago_id=$request->input('metodo_pago_id');
        $pago->persona_id=$request->input('persona_id');
       // return $pago;
       // Insertar el registro en la tabla
       $pago->save();
       $user = Auth::user();
       $docuCreate=DocumentosFiscales::where('id',$pago->documento_fiscal_id)->first();
        // Guardar un nuevo estado con el user_id
        $docuCreate->estados()->create([
            'estado' => 'PAGO RECIBIDO',
            'user_id' => $user->id,
        ]);
       if($pago->saldo<=0){
        $docuCreate->estados()->create([
            'estado' => 'PAGO COMPLETADO',
            'user_id' => $user->id,
        ]);
       }
       return redirect()->route('admin.pagos.index')->with('info', 'La Factura se guardo con exito');
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

    public function generarPDF(Pago $pago, Moneda $moneda)
    {
    
        $pathImage=config('config-myapp.logo_path');
        $nombreImagen = Storage::get($pathImage);// "https://static.bandainamcoent.eu/high/one-piece/one-piece-odyssey/00-page-setup/OPOD_header_mobile_new.jpg";
        
        $imagenBase64 = "data:image/png;base64," . base64_encode($nombreImagen);
       // dd($imagenBase64);
        // Crea una nueva instancia de Dompdf
        $dompdf = new Dompdf();
        // Puedes cargar la vista que deseas convertir a PDF
        $html = view('admin.pagos.pdf',compact('pago','imagenBase64','moneda'))->render();

        // Carga el contenido HTML al objeto Dompdf
        $dompdf->loadHtml($html);
        // $dompdf->setPaper('letter', 'landscape'); // Cambia a 'portrait' si deseas orientación vertical

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
    private function addSelect($variable){
        $variableArray = $variable->toArray();
         // Agregar un cliente manualmente
         $variableManual = [
            'id' => '',
            'name'=> 'Seleccione...'
         ];
         $variableArray[] = $variableManual;
 
        // Convertir el array en una colección nuevamente
        return new Collection($variableArray);
    }
}
