<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\Persona;
use App\Models\PersonaExoneracion;
use App\Models\TiposPersona;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Http\Request;


class PersonaSelect extends Component
{
    public $listaPersonasOri;
    public $tipoPersonas;
    public $listaPersonas;
    public $entidades;
    public $showListPerson=false;
    public $searchPerson;
    public $persona_id;
    public $name;
    public $rtn;
    public $direccion;
    public $telefono;
    public $dias_pago;
    public $exonerado=1;
    public $registroSag;
    public $showModal = false;
    public $showSearchChange=true;
    public $data;
    public $entidad_id;
    public $email;
    public $tipo_persona_id;
    public $statusExonerado=2;
    public $direccion_fiscal;
    public $registroExonerado;
    public $fechaVencimientoExoneracion;
    public $diasCredito = 0;
    public $emitCount = 0;
    public function mount($idEdit = null,$showSearchChange=true)
    {
        $this->loadPerson();
        $entidades= Entidad::select('id', 'name')->get();
        $this->entidades = $this->addSelect($entidades,true);
        $tipoPersonas= TiposPersona::select('id', 'name')->get();
        $this->tipoPersonas = $this->addSelect($tipoPersonas,true);
        if($idEdit){
            $this->onPersonaSelect($idEdit);
            $this->toggleVariable();
        }
        $this->showSearchChange= $showSearchChange;
    }

    public function loadPerson(){
        $this->listaPersonasOri=null;
        $this->listaPersonas=null;
        $personas = Persona::select('id', 'name', 'rtn','telefono','direccion_fiscal','exonerado','dias_pago')
                            ->with('tipoPersona')->with('exoneraciones')
                            ->with('entidad')->with('entidad')
        ->orderBy('name', 'asc')
        ->get();
        $this->listaPersonasOri = $this->addSelect($personas);
        $this->listaPersonas = $this->addSelect($personas);
    }
    public function onPersonaChange()
    {
        $personas  = collect($this->listaPersonasOri)
            ->where(function ($item) {
                $nombreCoincide = stristr($item['name'], $this->searchPerson);
                $departamentoCoincide = stristr($item['rtn'], $this->searchPerson);
                $telefonoCoincide = stristr($item['telefono'], $this->searchPerson);
                return $nombreCoincide || $departamentoCoincide || $telefonoCoincide;
            })
            ->all();
        $this->listaPersonas = $personas;
        
        $this->reset(['persona_id','name', 'rtn', 'direccion','telefono','exonerado','registroSag']);
        if($this->persona_id){
        }
    }

    public function onPersonaSelect($idPersona)
    {
        // dd($dataSelect);
        $this->persona_id=$idPersona;
        $dataSelect=$this->listaPersonasOri->where('id',$this->persona_id)->first();
        $this->name=array_key_exists('name', $dataSelect) ?$dataSelect['name']:'';
        $this->rtn=array_key_exists('rtn', $dataSelect) ?$dataSelect['rtn']:'';
        $this->direccion=array_key_exists('direccion_fiscal', $dataSelect) ?$dataSelect['direccion_fiscal']:'';
        $this->telefono=array_key_exists('telefono', $dataSelect) ?$dataSelect['telefono']:'';
        $this->exonerado=array_key_exists('exonerado', $dataSelect) ?$dataSelect['exonerado']:'';
        $this->diasCredito=array_key_exists('dias_pago', $dataSelect) ?$dataSelect['dias_pago']:'';
        if($this->emitCount>0){
        //     session()->flash('tempDiasCredito',$this->diasCredito);
        // }else{
            $this->emit('personaChange', $this->diasCredito);
        }
        $this->emitCount++; 
        $exoneration = PersonaExoneracion::where('persona_id',$this->persona_id)
                                            ->where('status',2)
                                            ->first(); // Ajusta el modelo y nombre de la tabla según tu aplicación
        $exoneration= $exoneration ? $exoneration->toArray() : [];

        $this->registroSag=array_key_exists('registro', $exoneration) ?$exoneration['registro']:'';
        $this->toggleVariable();
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
    
    public function toggleVariable()
    {
        $this->showListPerson = !$this->showListPerson;
    }

    
        
    public function savePerson(Request $request)
    {
        $this->data = $request->all();
        $persona = new Persona();
        $persona->name=$this->name;
        $persona->entidad_id=$this->entidad_id;
        $persona->rtn=$this->rtn;
        $persona->telefono=$this->telefono;
        $persona->dias_pago=$this->dias_pago;
        $persona->exonerado=$this->exonerado;
        $persona->email=$this->email;
        $persona->tipo_persona_id=$this->tipo_persona_id;
        $persona->direccion_fiscal=$this->direccion_fiscal;
        $persona->save();
  
        if($this->exonerado==2){
            $persona->exoneraciones()->create( ['persona_id'=>$persona->id,
                'registro' => $this->registroExonerado,
                'status' => $this->statusExonerado,
                'fecha_vencimiento' =>$this->fechaVencimientoExoneracion
            ]);
        }
        $this->loadPerson();
        $this->reset(['name', 'rtn', 'direccion','telefono','dias_pago','exonerado','registroSag','entidad_id','email','tipo_persona_id','statusExonerado','direccion_fiscal','registroExonerado','fechaVencimientoExoneracion']);
        $this->closeModal();
        
    }
    public function addItem(){
        $this->showModal = true;
    }
  
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'rtn', 'direccion','telefono','dias_pago','exonerado','registroSag','entidad_id','email','tipo_persona_id','statusExonerado','direccion_fiscal','registroExonerado','fechaVencimientoExoneracion']);
    }
    public function render()
    {
        return view('livewire.admin.persona-select');
    }
}
