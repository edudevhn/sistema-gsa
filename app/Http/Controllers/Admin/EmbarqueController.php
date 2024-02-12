<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\Embarque;
use App\Models\Moneda;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmbarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.embarques.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $monedas =$this->addSelect($monedas);
        return view('admin.embarques.create',compact('monedas'));
    }

    public function createSubEmbarque(Embarque $embarque)
    {
        $data=$embarque;        
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $monedas =$this->addSelect($monedas);
        return view('admin.embarques.createSubEmbarque',compact('data','monedas'));
    }

    
    
    public function createEmbarqueCotizacione(Cotizacion $cotizacione){
        //return $embarque;
        $data=$cotizacione;
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $monedas =$this->addSelect($monedas);
        return view('admin.embarques.createEmbarqueCotizacione',compact('data','monedas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        //return $request;
       /* $request->validate([
            'fecha'=>'required',
            'servicio'=>'required',
            'fecha_valida'=>'required',
            'totalCotizacion'=>'required',
            'persona_id'=>'required',
            'moneda_id'=>'required',
            'aduana_id'=>'required',
            ]);
            */
  
        $embarque =new Embarque();
        
        // Otros campos
       // $embarque->num_embarque = $numeroSolicitud;
        $embarque->embarcador=$request->input('embarcador');
        $embarque->consignatario=$request->input('consignatario');
        //$embarque->num_referencia=$request->input('num_referencia');
        $embarque->fecha_valida= $request->input('fecha_valida');
        $embarque->peso= $request->input('peso');
        $embarque->equipo= $request->input('equipo');
        $embarque->no_booking= $request->input('no_booking');
        $embarque->no_documento_transporte= $request->input('no_documento_transporte');
        $embarque->no_sag= $request->input('no_sag');
        $embarque->no_compra_externa= $request->input('no_compra_externa');
        $embarque->notas= $request->input('notas');
        $embarque->persona_id=$request->input('persona_id');
        $embarque->mercancia_id=$request->input('mercancia_id');
        $embarque->incoterm_id=$request->input('incoterm_id');
        $embarque->tipo_servicio_id=$request->input('tipo_servicio_id');
        $embarque->aduana_id=$request->input('aduana_id');
        $embarque->lugar_embarque_id=$request->input('lugar_embarque_id');
        $embarque->lugar_entrega_id=$request->input('lugar_entrega_id');
        $embarque->termino_pago_id=$request->input('termino_pago_id');
        $embarque->modalidad_id=$request->input('modalidad_id');
        $embarque->moneda_id=$request->input('moneda_id');
        // $embarque->pod_id=$request->input('pod_id');
        // $embarque->pol_id=$request->input('pol_id');
        $embarque->fecha= Carbon::now();
        $idEmbarquePrincipal=$request->input('embarque_principal_id');
        if($idEmbarquePrincipal){
            $embarque->embarque_principal_id=$request->input('embarque_principal_id');
        }
        
        // Insertar el registro en la tabla
        $embarque->save();
        $idCotizacion=$request->input('cotizacion_id');
        $user = Auth::user();
        if($idCotizacion){
            $embarque->embarqueCotizacion()->create([
                'cotizacion_id' => $idCotizacion,
            ]);
            $cotizacion=Cotizacion::where('id',$idCotizacion)->first();
            // Guardar un nuevo estado con el user_id
            $cotizacion->estados()->create([
                'estado' => 'PASE A EMBARQUE',
                'user_id' => $user->id,
            ]);
        }
        $embarque->estados()->create([
            'estado' => 'ELABORADO',
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.embarques.index')->with('info', 'El embarque se guardo con exito');
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Embarque $embarque)
    {
        $data=$embarque;
        
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $monedas =$this->addSelect($monedas);
        return view('admin.embarques.edit',compact('data','monedas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Embarque $embarque)
    {
       /* $request->validate([
            'name'=>"required|unique:embarques,name,$embarques->id",
            'precio_estimado'=>'required',
            'status'=>'required',
            'cuenta_id'=>'required',
            'moneda_id'=>'required'
        ]);
        */
       $embarque->embarcador=$request->input('embarcador');
        $embarque->consignatario=$request->input('consignatario');
        //$embarque->num_referencia=$request->input('num_referencia');
        $embarque->fecha_valida= $request->input('fecha_valida');
        $embarque->peso= $request->input('peso');
        $embarque->equipo= $request->input('equipo');
        $embarque->no_booking= $request->input('no_booking');
        $embarque->no_documento_transporte= $request->input('no_documento_transporte');
        $embarque->no_sag= $request->input('no_sag');
        $embarque->no_compra_externa= $request->input('no_compra_externa');
        $embarque->notas= $request->input('notas');
        $embarque->persona_id=$request->input('persona_id');
        $embarque->mercancia_id=$request->input('mercancia_id');
        $embarque->incoterm_id=$request->input('incoterm_id');
        $embarque->tipo_servicio_id=$request->input('tipo_servicio_id');
        $embarque->aduana_id=$request->input('aduana_id');
        $embarque->lugar_embarque_id=$request->input('lugar_embarque_id');
        $embarque->lugar_entrega_id=$request->input('lugar_entrega_id');
        $embarque->termino_pago_id=$request->input('termino_pago_id');
        $embarque->modalidad_id=$request->input('modalidad_id');
        $embarque->moneda_id=$request->input('moneda_id');
        $embarque->update($request->all());

        return redirect()->route('admin.embarques.edit',$embarque)->with('info', 'El registro se actualizo con exito');
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
