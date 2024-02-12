<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Embarque;
use App\Models\Moneda;
use App\Models\Proforma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProformaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.proformas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proformas.create');
    }

    public function createProformaEmbarque(Embarque $embarque){
        $servicios=[];
        if(isset($embarque->embarqueCotizacion->cotizacion)){
            foreach($embarque->embarqueCotizacion->cotizacion->servicios as $servicio){
                $servicio = [
                    'servicio_id' => $servicio->id,
                    'nombre' =>  $servicio->name,
                    'descripcion' => $servicio->pivot->descripcion,
                    'cantidad' => $servicio->pivot->cantidad,
                    'precio' => $servicio->pivot->precio,
                    'isv' => $servicio->pivot->isv,
                    'um'=>$servicio->pivot->unidad_medida,
                    'tipoValor'=>$servicio->valueType->name,
                    'total' => $servicio->pivot->total,
                ];
                
                // Agregar el producto al array de servicios
                $servicios[] = $servicio;
                
            }
        }
       
       session()->flash('tempProducts',json_encode($servicios));
        return view('admin.proformas.createProformaEmbarque',compact('embarque'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session()->flash('tempProducts',$request->input('serviciosArray'));
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
            
      /*  // Obtener el año actual
        $anioActual = Carbon::now()->year;

        // Generar el número de solicitud
        $star=1;
        $numeroSolicitud = $this->generarNumeroSolicitud($anioActual,$star);
        
        // Validar que el número de solicitud no exista previamente
        while ($this->existeNumeroSolicitud($numeroSolicitud)) {
            $star++;
            $numeroSolicitud = $this->generarNumeroSolicitud($anioActual,$star);
        }
        */
        $proforma =new Proforma();
        
        // Otros campos
        $serviciosArray=json_decode($request->input('serviciosArray'));
        $proforma->fecha_emision=$request->input('fechaEmision');
        $proforma->fecha_vencimiento=$request->input('fechaVencimiento');
        $proforma->embarcador=$request->input('embarcador');
        $proforma->consignatario=$request->input('consignatario');
        $proforma->pol=$request->input('pol');
        $proforma->pod=$request->input('pod');
        $proforma->no_booking=$request->input('noBooking');
        $proforma->no_documento_transporte=$request->input('documentoTransporte');
        $proforma->pieza=$request->input('pieza');
        $proforma->peso=$request->input('peso');
        $proforma->equipo=$request->input('equipo');
        $proforma->destino_final=$request->input('destinofinal');
        $proforma->duca=$request->input('duca');
        $proforma->observaciones=$request->input('observaciones');
        $proforma->importe_gravado=$request->input('importeGravado');
        $proforma->importe_exento=$request->input('importeExento');
        $proforma->descuento=$request->input('descuento');
        $proforma->importe_exonerado=$request->input('importeExonerado');
        $proforma->total=$request->input('totalCotizacion');
        $proforma->sub_total=$request->input('subTotal');
        $proforma->isv=$request->input('isv');
        $proforma->total=$request->input('total');
        $proforma->no_sag=$request->input('noSag');
        $proforma->no_compra_externa=$request->input('noCompraExterna');
        $proforma->no_exonerado=$request->input('noExonerado');
        $proforma->persona_id=$request->input('persona_id');
        $proforma->moneda_id=$request->input('moneda_id');
        $proforma->aduana_id=$request->input('aduana_id');
        $proforma->tc_hnd=$request->input('tc_hnd');
        $proforma->tc_usd=$request->input('tc_usd');
       // return $proforma;
       // Insertar el registro en la tabla
       $proforma->save();
       //$this->getDocumentosRangos($serviciosArray,$proforma);
        //Insertar el detalle de la cotizacion 
        foreach ($serviciosArray as $servicio) {
            $proforma->servicios()->attach($servicio->servicio_id, ['cantidad' => $servicio->cantidad,'descripcion' => $servicio->descripcion,'precio' => $servicio->precio,'total' => $servicio->total,'unidad_medida'=> $servicio->um,'isv'=> $servicio->isv]);
        }
        //return $proforma;
       // return view('admin.proformas.index');
        return redirect()->route('admin.proformas.index')->with('info', 'La proforma se guardo con exito');
    }  


    /**
     * Store a newly created resource in storage.
     */

    public function storeProformaEmbarque(Request $request)
    {
       // return $request;
        session()->flash('tempProducts',$request->input('serviciosArray'));
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
            
        // Obtener el año actual
      /*  $anioActual = Carbon::now()->year;
        $mesActual = Carbon::now()->month;

        // Generar el número de solicitud
        $star=1;
        $numeroSolicitud = $this->generarNumeroSolicitud($anioActual,$mesActual,$star);
        // Validar que el número de solicitud no exista previamente
        while ($this->existeNumeroSolicitud($numeroSolicitud)) {
            $star++;
            $numeroSolicitud = $this->generarNumeroSolicitud($anioActual,$mesActual,$star);
        }*/
        $proforma =new Proforma();
        
        // Otros campos
        
        $serviciosArray=json_decode($request->input('serviciosArray'));
      //  $proforma->num_documento = $numeroSolicitud;
        $proforma->fecha_emision=$request->input('fechaEmision');
        $proforma->fecha_vencimiento=$request->input('fechaVencimiento');
        $proforma->embarcador=$request->input('embarcador');
        $proforma->consignatario=$request->input('consignatario');
        $proforma->equipo=$request->input('equipo');
        $proforma->moneda_id=$request->input('moneda_id');
       // $proforma->no_booking=$request->input('no_booking');
        //$proforma->no_documento_transporte=$request->input('no_documento_transporte');
        //$proforma->pieza=$request->input('pieza');
        //$proforma->peso=$request->input('peso');
        $proforma->duca=$request->input('duca');
        $proforma->observaciones=$request->input('observaciones');
        $proforma->importe_gravado=$request->input('importeGravado');
        $proforma->importe_exento=$request->input('importeExento');
        $proforma->descuento=$request->input('descuento');
        $proforma->importe_exonerado=$request->input('importeExonerado');
        $proforma->sub_total=$request->input('subTotal');
        $proforma->isv=$request->input('isv');
        $proforma->total=$request->input('total');
        //$proforma->no_sag=$request->input('no_sag');
        //$proforma->no_compra_externa=$request->input('no_compra_externa');
       // $proforma->moneda_id=$request->input('moneda_id');
        $proforma->embarque_id=$request->input('embarque_id');
        $proforma->tc_hnd=$request->input('tc_hnd');
        $proforma->tc_usd=$request->input('tc_usd');
       // Insertar el registro en la tabla
       $proforma->save();
        foreach ($serviciosArray as $servicio) {
            $proforma->servicios()->attach($servicio->servicio_id, ['cantidad' => $servicio->cantidad,'descripcion' => $servicio->descripcion,'precio' => $servicio->precio,'total' => $servicio->total,'unidad_medida'=> $servicio->um,'isv'=> $servicio->isv]);
            // $proforma->servicios()->attach($servicio->servicio_id, ['cantidad' => $servicio->cantidad,'descripcion' => $servicio->descripcion,'precio' => $servicio->precio,'total' => $servicio->total]);
        }
        $embarque=Embarque::where('id',$proforma->embarque_id)->first();
        $embarque->embarcador=$request->input('embarcador');
        $embarque->consignatario=$request->input('consignatario');
        $embarque->no_booking=$request->input('no_booking');
        $embarque->no_documento_transporte=$request->input('no_documento_transporte');
        $embarque->peso=$request->input('peso');
        $embarque->equipo=$request->input('equipo');
        $embarque->no_sag=$request->input('no_sag');
        $embarque->no_compra_externa=$request->input('no_compra_externa');
        $embarque->update();

        $user = Auth::user();
        // Guardar un nuevo estado con el user_id
        $proforma->estados()->create([
            'estado' => 'ELABORADO',
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.embarques.index')->with('info', 'La proforma se guardo con exito');
    }  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proforma $proforma)
    {
        return view('admin.proformas.edit',compact('proforma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proforma $proforma)
    {
        $request->validate([
            'name'=>"required|unique:proformas,name,$proforma->id",
            'precio_estimado'=>'required',
            'status'=>'required',
            'cuenta_id'=>'required',
            'moneda_id'=>'required'
        ]);
        
      //  $cotizaciones->update($request->all());

        return redirect()->route('admin.proformas.edit',$proforma)->with('info', 'El registro se actualizo con exito');
    }
    public function generarPDF(Proforma $proforma,Moneda $moneda)
    {
    // dd(config('config-myapp.logo_path'));
        $pathImage=config('config-myapp.logo_path');
        $nombreImagen = Storage::get($pathImage);// "https://static.bandainamcoent.eu/high/one-piece/one-piece-odyssey/00-page-setup/OPOD_header_mobile_new.jpg";
        
        $imagenBase64 = "data:image/png;base64," . base64_encode($nombreImagen);
       // dd($imagenBase64);
        // Crea una nueva instancia de Dompdf
        $dompdf = new Dompdf();
       // dd($this->number_words($proforma->total,'lempiras','y','centavos'));
        // Puedes cargar la vista que deseas convertir a PDF
        $html = view('admin.proformas.pdf',compact('proforma','moneda','imagenBase64'))->render();

        // Carga el contenido HTML al objeto Dompdf
        $dompdf->loadHtml($html);

        // Opcional: puedes ajustar las opciones de configuración si has publicado la configuración
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');
        // Renderiza el contenido HTML en PDF
        $dompdf->render();

        // Genera el PDF y envía la respuesta al navegador para su descarga
       // return $dompdf->stream('nombre_del_archivo.pdf');
          // Obtener el contenido del PDF generado
          $output = $dompdf->output();

          // Devolver el PDF como respuesta con el encabezado adecuado para abrirlo en una nueva pestaña
          return response($output, 200)->header('Content-Type', 'application/pdf')->header('Content-Disposition', 'inline; filename="archivo.pdf"');
    }

    // function number_words($valor,$desc_moneda, $sep, $desc_decimal) {
    //     $arr = explode(".", $valor);
    //     $entero = $arr[0];
    //     if (isset($arr[1])) {
    //     $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
    //     }

    //     $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
    //     if (is_array($arr)) {
    //     $num_word = ($arr[0]>=1000000) ? "{$fmt->format($entero)} de $desc_moneda" : "{$fmt->format($entero)} $desc_moneda";
    //     if (isset($decimos) && $decimos > 0) {
    //     $num_word .= " $sep {$fmt->format($decimos)} $desc_decimal";
    //     }
    //     }
    //     return $num_word;
    // }
}
