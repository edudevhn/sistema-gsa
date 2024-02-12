<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosFiscales;
use App\Models\DocumentosFiscalesDetalle;
use Illuminate\Http\Request;
use App\Models\DocumentosFiscalesRango;
use App\Models\Embarque;
use App\Models\Moneda;
use App\Models\Servicio;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentoFicalController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.documentosFiscales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Embarque $embarque)
    {
        return view('admin.documentosFiscales.create',compact('embarque'));
    }


    public function createDocumentoFiscalEmbarque(Embarque $embarque){
        //return $embarque;
        $servicios=[];
        $listaServicios=[];
        $proforma='';
        // if($embarque->embarqueCotizacion->cotizacion->servicios){
        //     $listaServicios=$embarque->embarqueCotizacion->cotizacion->servicios;
        // }
        if($embarque->proformas){
            $proforma=$embarque->proformas->first();
            if(isset($proforma->servicios)){
                $listaServicios=$proforma->servicios;
            }
        }
        foreach($listaServicios as $servicio){
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
       // dd(json_encode($servicios));
       
       session()->flash('tempProducts',json_encode($servicios));
        return view('admin.documentosFiscales.createDocumentoFiscalEmbarque',compact('embarque','proforma'));
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
        
        $factura =new DocumentosFiscales();
        
        // Otros campos
        $serviciosArray=json_decode($request->input('serviciosArray'));
        $factura->fecha_emision=$request->input('fechaEmision');
        $factura->fecha_vencimiento=$request->input('fechaVencimiento');
        $factura->embarcador=$request->input('embarcador');
        $factura->consignatario=$request->input('consignatario');
        $factura->pol=$request->input('pol');
        $factura->pod=$request->input('pod');
        $factura->no_booking=$request->input('noBooking');
        $factura->no_documento_transporte=$request->input('documentoTransporte');
        $factura->pieza=$request->input('pieza');
        $factura->peso=$request->input('peso');
        $factura->equipo=$request->input('equipo');
        $factura->destino_final=$request->input('destinofinal');
        $factura->referencia_interna=$request->input('referenciaInterna');
        $factura->duca=$request->input('duca');
        $factura->observaciones=$request->input('observaciones');
        $factura->importe_gravado=$request->input('importeGravado');
        $factura->importe_exento=$request->input('importeExento');
        $factura->descuento=$request->input('descuento');
        $factura->importe_exonerado=$request->input('importeExonerado');
        $factura->total=$request->input('totalCotizacion');
        $factura->sub_total=$request->input('subTotal');
        $factura->isv=$request->input('isv');
        $factura->total=$request->input('total');
        $factura->no_sag=$request->input('noSag');
        $factura->no_compra_externa=$request->input('noCompraExterna');
        $factura->no_exonerado=$request->input('noExonerado');
        $factura->persona_id=$request->input('persona_id');
        $factura->moneda_id=$request->input('moneda_id');
        $factura->aduana_id=$request->input('aduana_id');
        $factura->tc_hnd=$request->input('tc_hnd');
        $factura->tc_usd=$request->input('tc_usd');
       // return $factura;
       // Insertar el registro en la tabla
       $factura->save();
       $this->getDocumentosRangos($serviciosArray,$factura);
        //Insertar el detalle de la cotizacion 
        foreach ($serviciosArray as $servicio) {
            $factura->servicios()->attach($servicio->servicio_id, ['cantidad' => $servicio->cantidad,'descripcion' => $servicio->descripcion,'precio' => $servicio->precio,'total' => $servicio->total]);
        }
        //return $factura;
       // return view('admin.facturas.index');
        return redirect()->route('admin.documentosFiscales.index')->with('info', 'La Factura se guardo con exito');
    }
    

    
    
    
    
    public function storeDocumentoFiscalEmbarque(Request $request)
    {
        //return $request;
        session()->flash('tempProducts',$request->input('serviciosArray'));
        //return $request;
        //    $request->validate([
        //         'total'=>'required',
        //         'persona_id'=>'required',
        //         'moneda_id'=>'required',
        //         'aduana_id'=>'required'
        //     ]);
        DB::beginTransaction();
        try {
            $serviciosArray=json_decode($request->input('serviciosArray'));
            // 1. Validación de Datos (ejemplo simplificado)
           // $datosValidos = $this->validarDatos($request->all());
            /*
            if (!$datosValidos) {
                return response()->json(['message' => 'Datos no válidos'], 400);
            }*/
            // 2. Generación de Números de Documento Fiscal
            $rangoDocumentosFicales= $this->getDocumentosRangos($serviciosArray);
           // dd($rangoDocumentosFicales);
            //'numDocumento'=>$this->createDocumentoRango($valueTypeId),'valueTypeId'=>$valueTypeId
            // 3. Creación de Registro en DatosComunesDocumentoFiscal
            
            $detalleDF =new DocumentosFiscalesDetalle();
            $detalleDF->fecha_emision=$request->input('fechaEmision');
            $detalleDF->fecha_vencimiento=$request->input('fechaVencimiento');
            $detalleDF->embarcador=$request->input('embarcador');
            $detalleDF->consignatario=$request->input('consignatario');
            $detalleDF->no_booking=$request->input('no_booking');            
            $detalleDF->no_documento_transporte=$request->input('no_documento_transporte');
            $detalleDF->pieza=$request->input('pieza');
            $detalleDF->peso=$request->input('peso');
            $detalleDF->equipo=$request->input('equipo');
            $detalleDF->duca=$request->input('duca');
            $detalleDF->observaciones=$request->input('observaciones');
            $detalleDF->importe_gravado=$request->input('importeGravado');
            $detalleDF->importe_exento=$request->input('importeExento');
            $detalleDF->descuento=$request->input('descuento');
            $detalleDF->importe_exonerado=$request->input('importeExonerado');
            $detalleDF->total=$request->input('totalCotizacion');
            $detalleDF->sub_total=$request->input('subTotal');
            $detalleDF->isv=$request->input('isv');
            $detalleDF->total=$request->input('total');
            $detalleDF->tc_hnd=$request->input('tc_hnd');
            $detalleDF->tc_usd=$request->input('tc_usd');
            $detalleDF->moneda_id=$request->input('moneda_id');
            $detalleDF->no_sag=$request->input('no_sag');
            $detalleDF->no_compra_externa=$request->input('no_compra_externa');
            $detalleDF->save();
            //  $detalleDF->embarque_id=$request->input('embarque_id');
            //dd($rangoDocumentosFicales);
            //$datosComunes = DatosComunesDocumentoFiscal::create($datosValidos);


            // 4. Creación de Registro en DocumentoFiscal
            foreach($rangoDocumentosFicales['numDoc'] as $documentoFiscal){
                $subTotal=0;
                $isv=0;
                $total=0;
               // dd($documentoFiscal['valueType']);
                if($documentoFiscal['valueType']=='GRAVADO'){
                    $subTotal=$detalleDF->importe_gravado;
                    $isv=$detalleDF->isv;
                    $total=$subTotal+$isv;
                }
                if($documentoFiscal['valueType']=='EXENTO'){
                    $subTotal=$detalleDF->importe_exento;
                    $total=$subTotal+$isv;
                }
                $docuCreate=DocumentosFiscales::create([
                    'numero_documento' => $documentoFiscal['numDocumento'],
                    'sub_total' => $subTotal,
                    'isv' => $isv,
                    'total' => $total,
                    'documentos_fiscales_rango_id' => $documentoFiscal['documentoRango'],
                    'documento_fiscal_detalle_id' => $detalleDF->id,
                    'documento_tipo_id' => $documentoFiscal['documentoTipo'],
                    'embarque_id' => $request->input('embarque_id'),
                ]);
                $docuCreate->rangoDocumento->cantidad_emitidas++;
                $docuCreate->rangoDocumento->update();
                foreach ($serviciosArray as $servicio) {
                    if($documentoFiscal['valueType']==$servicio->tipoValor){
                        $docuCreate->servicios()->attach($servicio->servicio_id, ['cantidad' => $servicio->cantidad,'descripcion' => $servicio->descripcion,'precio' => $servicio->precio,'total' => $servicio->total,'unidad_medida'=> $servicio->um,'isv'=> $servicio->isv]);
                    }
                }
                $user = Auth::user();
                // Guardar un nuevo estado con el user_id
                $docuCreate->estados()->create([
                    'estado' => 'ELABORADO',
                    'user_id' => $user->id,
                ]);
            }

            // 6. Actualización de Estado de Rango (si aplicable)
            $embarque=Embarque::where('id',$request->input('embarque_id'))->first();
            $embarque->embarcador=$request->input('embarcador');
            $embarque->consignatario=$request->input('consignatario');
            $embarque->no_booking=$request->input('no_booking');
            $embarque->no_documento_transporte=$request->input('no_documento_transporte');
            $embarque->peso=$request->input('peso');
            $embarque->equipo=$request->input('equipo');
            $embarque->no_sag=$request->input('no_sag');
            $embarque->no_compra_externa=$request->input('no_compra_externa');
            $embarque->update();
            DB::commit();


            

            
            return redirect()->route('admin.embarques.index')->with('info', 'La Facutra y se crearon los documentos fiscales correspondientes');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Error al guardar el documento fiscal', 'error' => $e->getMessage()], 500);
        }
    }  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentosFiscales $documentoFiscal)
    {
        $servicios=[];
        foreach($documentoFiscal->servicios as $servicio){
            $servicio = [
                'servicio_id' => $servicio->servicio_id,
                'nombre' =>  $servicio->name,
                'descripcion' => $servicio->pivot->descripcion,
                'cantidad' => $servicio->pivot->cantidad,
                'precio' => $servicio->pivot->precio,
                'total' => $servicio->pivot->total,
            ];
            
            // Agregar el producto al array de servicios
            $servicios[] = $servicio;
            
        }
        //dd(json_encode($servicios));
       
       session()->flash('tempProducts',json_encode($servicios));
        return view('admin.documentosFiscales.edit',compact('documentoFiscal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentosFiscales $documentoFiscal)
    {
        $request->validate([
            'name'=>"required|unique:documentos_fiscales,name,$documentoFiscal->id",
            'precio_estimado'=>'required',
            'status'=>'required',
            'cuenta_id'=>'required',
            'moneda_id'=>'required'
        ]);
        
      //  $cotizaciones->update($request->all());

        return redirect()->route('admin.documentosFiscales.edit',$documentoFiscal)->with('info', 'El registro se actualizo con exito');
    }


    private function getDocumentosRangos($serviciosArray){
        $createFactura =false;
        $notaDebito =false;
        $serviciosF=[];
        $serviciosN=[];
        foreach ($serviciosArray as $servicio) {
            $getServicio=Servicio::where('id',$servicio->servicio_id)->first();
            $valueTypeId=$getServicio->value_type_id;
            $nameValueType=$getServicio->valueType->name;
            if($valueTypeId==1){
              $serviciosF[]=$servicio;
              if(!$createFactura){
                    $resp=$this->createDocumentoRango($valueTypeId);
                    $respArray[]=array(
                        'numDocumento'=>$resp['numDocumento'],
                        'documentoRango'=>$resp['documentoRango'],
                        'documentoTipo'=>$resp['documentoTipo'],
                        'valueType'=>$nameValueType
                    );
                    $createFactura=true;
                }
            }
            if($valueTypeId==2){
                $serviciosN[]=$servicio;
                if(!$notaDebito){
                    $resp=$this->createDocumentoRango($valueTypeId);
                    $respArray[]=array(
                        'numDocumento'=>$resp['numDocumento'],
                        'documentoRango'=>$resp['documentoRango'],
                        'documentoTipo'=>$resp['documentoTipo'],
                        'valueType'=>$nameValueType
                    );
                    $notaDebito=true;
                }
            }
        }
        return ['numDoc'=>$respArray,'serviciosF'=>$serviciosF,'serviciosN'=>$serviciosN];

    }

    private function createDocumentoRango($valueTypeId){
        $documentoRango=DocumentosFiscalesRango::whereRelation('documentoTipo.valueType', 'id',$valueTypeId)->first();
        $numeroInicial=$documentoRango->numero_inicial;
       // $numeroCuenta=$datosControler['numero_cuenta'];
        $facturasEmitidas=0;
        if($documentoRango->cantidad_emitidas){
            $facturasEmitidas=(int)$documentoRango->cantidad_emitidas;
        }
        $conteoFacturas=$facturasEmitidas;
       // $numeroFactura='';
        $arrayCorrelativos=explode('-', $numeroInicial);
        /*if($fechaLimiteEmision<$fechaActual){
            return 'errorFecha';
            exit();
        }
        if($cantidadOtorgada<=$conteoFacturas){
            return 'errorCantidadOtorgada';
            exit();
        }
        
        if(count($arrayCorrelativos)!=4){
            return 'errorFormatoNumInicial';
            exit();
        }
        $arrayCorrelativoFinals=explode('-', $numeroFinal);
        if(count($arrayCorrelativoFinals)!=4){
            return 'errorFormatoNumFinal';
            exit();
        }*/
        $correlativo=0;
        if($facturasEmitidas==0){
            $correlativo=intval(ltrim(str_replace(' ','',$arrayCorrelativos[3]),'0'));
        }else{
            $correlativo=intval(ltrim(str_replace(' ','',$arrayCorrelativos[3]),'0'))+$conteoFacturas;
        }
        //$correlativo="{$formattedYear2d }-{$fomatoSolicitud  }";
        $fomatoSolicitud=str_pad($correlativo, 6, '0', STR_PAD_LEFT);
        $correlativo=$correlativo<=999999? "00 {$fomatoSolicitud}":str_pad($correlativo, 8, '0', STR_PAD_LEFT);
        $numDocumento ="{$arrayCorrelativos[0]}-{$arrayCorrelativos[1]}-{$arrayCorrelativos[2]}-{$correlativo}";
        return ['resp'=>'OK','numDocumento'=>$numDocumento,'documentoRango'=>$documentoRango->id,'documentoTipo'=>$documentoRango->documento_tipo_id];
        // $factura->documentosRangos()->attach($documentoRango->id, ['numero_documento' => $numeroFactura,'sub_total'=>$datos->sub_total,'isv'=>$datos->isv,'total'=>$datos->total]);
        // $documentoRango->update(['cantidad_emitidas'=>$facturasEmitidas+1]);
        
    }


    public function validarDatos($data)
    {
        // Implementa la validación de datos según tus necesidades y devuelve los datos válidos en un arreglo.
        // Si los datos no son válidos, puedes retornar null o un indicador de error.
        // Este es solo un ejemplo simplificado.
        if (!isset($data['embarque']) || !isset($data['fecha']) || !isset($data['tipo_servicio'])) {
            return null;
        }

        return [
            'embarque' => $data['embarque'],
            'fecha' => $data['fecha'],
            'tipo_servicio' => $data['tipo_servicio'],
            // Agregar otros campos comunes aquí
        ];
    }
    public function generarPDF(DocumentosFiscales $documentoFiscal,Moneda $moneda)
    {
        //dd($documentoFiscal);
       /* $factura = DocumentosFiscales::whereHas('documentosRangos', function ($query) use ($idDocumento) {
            $query->where('factura_documento_rango.id', $documentoFiscal->id);
        })->first();
        $dataPrincipal = DocumentosFiscales::leftJoin('factura_documento_rango', 'factura_documento_rango.factura_id', '=', 'facturas.id')
        ->leftJoin('documentos_fiscales_rangos', 'factura_documento_rango.documentos_fiscales_rango_id', '=', 'documentos_fiscales_rangos.id')
        ->leftJoin('documentos_fiscales_tipos', 'documentos_fiscales_rangos.documento_tipo_id', '=', 'documentos_fiscales_tipos.id')
        ->select(
            'documentos_fiscales_tipos.name',
            'factura_documento_rango.numero_documento',
            'factura_documento_rango.sub_total',
            'factura_documento_rango.isv',
            'factura_documento_rango.total',
            'documentos_fiscales_rangos.*'
        )
        ->where('factura_documento_rango.id', '=', $idDocumento)
        ->first();*/
       // dd($factura->moneda);
        $pathImage=config('config-myapp.logo_path');
        $nombreImagen = Storage::get($pathImage);// "https://static.bandainamcoent.eu/high/one-piece/one-piece-odyssey/00-page-setup/OPOD_header_mobile_new.jpg";
        
        $imagenBase64 = "data:image/png;base64," . base64_encode($nombreImagen);
       // dd($imagenBase64);
        // Crea una nueva instancia de Dompdf
        $dompdf = new Dompdf();

        // Puedes cargar la vista que deseas convertir a PDF
        $html = view('admin.documentosFiscales.pdf',compact('documentoFiscal','moneda','imagenBase64'))->render();

        // Carga el contenido HTML al objeto Dompdf
        $dompdf->loadHtml($html);

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
}
