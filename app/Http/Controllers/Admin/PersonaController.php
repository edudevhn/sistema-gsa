<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entidad;
use App\Models\Persona;
use App\Models\TiposPersona;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;
class PersonaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.personas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $tipoPersonas= TiposPersona::select('id', 'name')->get();
        $entidades= Entidad::select('id', 'name')->get();
        $tipoPersonas = $this->addSelect($tipoPersonas,true);
        $entidades = $this->addSelect($entidades,true);
        return view('admin.personas.create',compact('tipoPersonas','entidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'name'=>'required',
            'entidad_id'=>'required',
            'tipo_persona_id'=>'required',
        ]);
        if($request->input('entidad_id')==1){
            $request->validate([
                'rtn'=>'required|unique:personas',
            ]);
        }
        if($request->input('exonerado')==2){
            $request->validate([
                'registroExonerado'=>'required',
                'statusExonerado'=>'required',
                'fechaVencimientoExoneracion'=>'required',
            ]);
        }
        
        $persona= new Persona;//::create($request->all());

        $persona->name=$request->input('name');
        $persona->rtn=$request->input('rtn');
        $persona->telefono=$request->input('telefono');
        $persona->email=$request->input('email');
        $persona->direccion_fiscal=$request->input('direccion_fiscal');
        $persona->exonerado=$request->input('exonerado');
        $persona->dias_pago=$request->input('dias_pago');
        $persona->tipo_persona_id=$request->input('tipo_persona_id');
        $persona->entidad_id=$request->input('entidad_id');
        $persona->termino_pago_id=$request->input('termino_pago_id');
        $persona->save();
        if($request->input('exonerado')==2){
            $persona->exoneraciones()->create( ['persona_id'=>$persona->id,
                'registro' => $request->input('registroExonerado'),
                'status' => $request->input('statusExonerado'),
                'fecha_vencimiento' =>$request->input('fechaVencimientoExoneracion')
            ]);
        }
        
        
        return redirect()->route('admin.personas.edit',$persona)->with('info', 'El registro se guardo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        $tipoPersonas= TiposPersona::select('id', 'name')->get();
        $entidades= Entidad::select('id', 'name')->get();
        $tipoPersonas = $this->addSelect($tipoPersonas,true);
        $entidades = $this->addSelect($entidades,true);
        return view('admin.personas.edit',compact('persona','tipoPersonas','entidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        //return $request;
        $request->validate([
            'name'=>'required',
            'entidad_id'=>'required',
            'tipo_persona_id'=>'required',
        ]);
        if($request->input('entidad_id')==1){
            $request->validate([
                'rtn'=>"required|unique:personas,rtn,$persona->id",
            ]);
        }
       // dd($request->input('termino_pago_id'));
       //$persona= new Persona;//::create($request->all());
       
        $persona->name=$request->input('name');
        $persona->rtn=$request->input('rtn');
        $persona->telefono=$request->input('telefono');
        $persona->email=$request->input('email');
        $persona->direccion_fiscal=$request->input('direccion_fiscal');
        $persona->exonerado=$request->input('exonerado');
        $persona->dias_pago=$request->input('dias_pago');
        $persona->tipo_persona_id=$request->input('tipo_persona_id');
        $persona->entidad_id=$request->input('entidad_id');
        $persona->termino_pago_id=$request->input('termino_pago_id');
        
        $persona->update();//($request->all());
        return redirect()->route('admin.personas.edit',$persona)->with('info', 'El registro se actualizo con exito');
    }

    private function addSelect($variable,$select= null){
        $variableArray = $variable->toArray();
        if($select){
            // Agregar un cliente manualmente
            $variableManual = [
                'id' => '',
                'name'=> 'Seleccione...'
            ];
            $variableArray[] = $variableManual;
    
        }
        return new Collection($variableArray);
    }
}
