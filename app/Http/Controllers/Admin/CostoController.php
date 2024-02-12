<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Costo;
use App\Models\CostoPago;
use App\Models\Embarque;
use App\Models\Moneda;
use App\Models\Servicio;
use App\Models\TipoCosto;
use FontLib\TrueType\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.costos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoCosto=TipoCosto::select('id', 'name')->get();
        $tipoCosto =$this->addSelect($tipoCosto);
        $moneda=Moneda::select('id', 'name')->get();
        $moneda =$this->addSelect($moneda);
        $servicios=Servicio::select('id', 'name')->get();
        $servicios =$this->addSelect($servicios);
        return view('admin.costos.create',compact('tipoCosto','moneda','servicios') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $costo =new Costo;
        
        $costo->fecha_factura=$request->input('fecha_factura');
        $costo->descripcion=$request->input('descripcion');
        $costo->documento_cobro=$request->input('documento_cobro');
        $costo->valor_neto_factura=$request->input('valor_neto_factura');
        $costo->isv=$request->input('isv');
        $costo->total=$request->input('total');
        $costo->servicio_id=$request->input('servicio_id');
        $costo->proveedor_id=$request->input('persona_id');
        $costo->tipo_costo_id=$request->input('tipo_costo_id');
        $costo->moneda_id=$request->input('moneda_id');
        $costo->observaciones=$request->input('observaciones');
        $costo->save();

        // Asociar el costo al embarque específico
        if($request->input('embarque_id')){
            $embarque = Embarque::find($request->input('embarque_id'));
            $embarque->costos()->attach($costo->id);
        }
        $user = Auth::user();
        // Guardar un nuevo estado con el user_id
        $costo->estados()->create([
            'estado' => 'ELABORADO',
            'user_id' => $user->id,
        ]);

        // Crear un nuevo registro de CostoPago
        if($request->input('total_pago')>0){
            $costoPago = new CostoPago([
                'total_pago' => $request->input('total_pago'),
                'cuenta_bancaria_id' => $request->input('cuenta_bancaria_id'),
            ]);
            // Asociar el pago al costo específico
            $costo->pagos()->save($costoPago);
            $costo->estados()->create([
                'estado' => 'PAGO REALIZADO',
                'user_id' => $user->id,
            ]);
        }
   
       // return $pago;
       // Insertar el registro en la tabla
       return redirect()->route('admin.costos.index')->with('info', 'El registro se actualizo con exito');
    }

    public function createEmbarquePago(Costo $costo)
    {
       $tipoCosto=TipoCosto::select('id', 'name')->get();
       $tipoCosto =$this->addSelect($tipoCosto);
       $moneda=Moneda::select('id', 'name')->get();
       $moneda =$this->addSelect($moneda);
       $servicios=Servicio::select('id', 'name')->get();
       $servicios =$this->addSelect($servicios);
        return view('admin.costos.createEmbarquePago',compact('costo','tipoCosto','moneda','servicios'));
    }





      /**
     * Store a newly created resource in storage.
     */
    public function storePago(Request $request,Costo $costo)
    {

        // Crear un nuevo registro de CostoPago
        if($request->input('total_pago')>0){
            $costoPago = new CostoPago([
                'total_pago' => $request->input('total_pago'),
                'cuenta_bancaria_id' => $request->input('cuenta_bancaria_id'),
            ]);
            $user = Auth::user();
            // Asociar el pago al costo específico
            $costo->pagos()->save($costoPago);
            $costo->estados()->create([
                'estado' => 'PAGO REALIZADO',
                'user_id' => $user->id,
            ]);
        }
   
       // return $pago;
       // Insertar el registro en la tabla
       return redirect()->route('admin.costos.index')->with('info', 'El registro se actualizo con exito');
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

    private function addSelect($variable){
        $variableArray = $variable->toArray();
         // Agregar un cliente manualmente
         $variableManual = [
            'id' => '',
            'name'=> 'Seleccione...'
         ];
         $variableArray[] = $variableManual;
 
        // Convertir el array en una colección nuevamente
        return new EloquentCollection($variableArray);
    }
}
