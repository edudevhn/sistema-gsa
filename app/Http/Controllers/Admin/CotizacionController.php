<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\Moneda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;


use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cotizaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cotizaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session()->flash('tempProducts',$request->input('serviciosArray'));
        //return $request;
        
       /* $request->validate([
            'fecha'=>'required',
            'fecha_valida'=>'required',
            'total'=>'required',
            'persona_id'=>'required',
            'aduana_id'=>'required',
            ]);
            */
        
        $cotizacione =new Cotizacion;
        $cotizacione->fecha=now();        
        $cotizacione->moneda_id=$request->input('moneda_id');
        $cotizacione->persona_id=$request->input('persona_id');
        $cotizacione->mercancia_id=$request->input('mercancia_id');
        $cotizacione->incoterm_id=$request->input('incoterm_id');
        $cotizacione->tipo_servicio_id=$request->input('tipo_servicio_id');
        $cotizacione->aduana_id=$request->input('aduana_id');
        $cotizacione->lugar_embarque_id=$request->input('lugar_embarque_id');
        $cotizacione->lugar_entrega_id=$request->input('lugar_entrega_id');
        $cotizacione->termino_pago_id=$request->input('termino_pago_id');
        $cotizacione->modalidad_id=$request->input('modalidad_id');
        $cotizacione->num_referencia=$request->input('num_referencia');
        $cotizacione->fecha_valida=$request->input('fecha_valida');
        $cotizacione->notas=$request->input('notas');
        $cotizacione->total=$request->input('total');
        $cotizacione->tc_hnd=$request->input('tc_hnd');
        $cotizacione->tc_usd=$request->input('tc_usd');
        
        // Insertar el registro en la tabla
        $cotizacione->save();
        //Insertar el detalle de la cotizacion 
        $serviciosArray=json_decode($request->input('serviciosArray'));
       // return $serviciosArray;
        foreach ($serviciosArray as $servicio) {
            $cotizacione->servicios()->attach($servicio->servicio_id, ['descripcion' => $servicio->descripcion,'cantidad' => $servicio->cantidad,'precio' => $servicio->precio,'isv' => $servicio->isv,'total' => $servicio->total,'unidad_medida'=>$servicio->um]);
        }
        
        $user = Auth::user();
        // Guardar un nuevo estado con el user_id
        $cotizacione->estados()->create([
            'estado' => 'ELABORADO',
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.cotizaciones.index')->with('info', 'La Cotizacion se guardo con exito');
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotizacion $cotizacione)
    {

        $servicios=[];
        foreach($cotizacione->servicios as $servicio){
            $servicio = [
                'servicio_id' => $servicio->id,
                'nombre' =>  $servicio->name,
                'descripcion' => $servicio->pivot->descripcion,
                'cantidad' => $servicio->pivot->cantidad,
                'precio' => $servicio->pivot->precio,
                'isv' => $servicio->pivot->isv,
                'total' => $servicio->pivot->total,
                'um' => $servicio->pivot->unidad_medida,
            ];
            
            // Agregar el producto al array de servicios
            $servicios[] = $servicio;
            
        }
       // dd(json_encode($servicios));
       
       session()->flash('tempProducts',json_encode($servicios));
        return view('admin.cotizaciones.edit',compact('cotizacione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotizacion $cotizacione)
    {
       // return $request;
        session()->flash('tempProducts',$request->input('serviciosArray'));
       /* $request->validate([
            'name'=>"required|unique:cotizaciones,name,$cotizacione->id",
            'precio_estimado'=>'required',
            'status'=>'required',
            'cuenta_id'=>'required',
            'moneda_id'=>'required'
        ]);*/
        $cotizacione->fecha=now();
        $cotizacione->moneda_id=$request->input('moneda_id');
        $cotizacione->persona_id=$request->input('persona_id');
        $cotizacione->mercancia_id=$request->input('mercancia_id');
        $cotizacione->incoterm_id=$request->input('incoterm_id');
        $cotizacione->tipo_servicio_id=$request->input('tipo_servicio_id');
        $cotizacione->aduana_id=$request->input('aduana_id');
        $cotizacione->lugar_embarque_id=$request->input('lugar_embarque_id');
        $cotizacione->lugar_entrega_id=$request->input('lugar_entrega_id');
        $cotizacione->termino_pago_id=$request->input('termino_pago_id');
        $cotizacione->modalidad_id=$request->input('modalidad_id');
        $cotizacione->num_referencia=$request->input('num_referencia');
        $cotizacione->fecha_valida=$request->input('fecha_valida');
        $cotizacione->notas=$request->input('notas');
        $cotizacione->total=$request->input('total');
        $cotizacione->tc_hnd=$request->input('tc_hnd');
        $cotizacione->tc_usd=$request->input('tc_usd');
        
        $cotizacione->update();
        $serviciosArray=json_decode($request->input('serviciosArray'));
       // return $serviciosArray;
        // foreach ($serviciosArray as $servicio) {
        //     $cotizacione->servicios()->sync($servicio->servicio_id, ['cantidad' => $servicio->cantidad,'precio' => $servicio->precio,'total' => $servicio->total]);
        // }
        $productosSincronizar = [];
            foreach ($serviciosArray as $servicio) {
                $productosSincronizar[$servicio->servicio_id] = [
                    'cantidad' =>  $servicio->cantidad,
                    'descripcion' => $servicio->descripcion,
                    'precio' => $servicio->precio,
                    'isv' => $servicio->isv,
                    'total' => $servicio->total
                    ,'unidad_medida'=>$servicio->um
                ];
            }

        // Paso 3: Sincronizar los productos con la factura usando el método sync
        $cotizacione->servicios()->sync($productosSincronizar);
        //$cotizacione->tags()->sync($request->tags);
        return redirect()->route('admin.cotizaciones.edit',$cotizacione)->with('info', 'El registro se actualizo con exito');
    }
    


    public function generarPDF(Cotizacion $cotizacione,Moneda $moneda)
    {
        
       // dd($moneda);
        $pathImage=config('config-myapp.logo_path');
        $nombreImagen = Storage::get($pathImage);// "https://static.bandainamcoent.eu/high/one-piece/one-piece-odyssey/00-page-setup/OPOD_header_mobile_new.jpg";
        
        $imagenBase64 = "data:image/png;base64," . base64_encode($nombreImagen);
       // dd($imagenBase64);
        // Crea una nueva instancia de Dompdf
        $dompdf = new Dompdf();

        // Puedes cargar la vista que deseas convertir a PDF
        $html = view('admin.cotizaciones.pdf',compact('cotizacione','moneda','imagenBase64'))->render();

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
}

