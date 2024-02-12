<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use App\Models\PersonaExoneracion;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class PersonasIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $showModal = false;
    public $showForm = false;
    public $showAdd = false;
    public $selectedPersonId;
    public $selectedExoneracionId;
    public $personData = [];
    public $personExoneracion = [];
    public $exoneracion = [];

    public function updatingSearch(){
        $this->resetPage();
    }


    public function render()
    {
    
      $personas = Persona::where('name','LIKE', '%'.$this->search.'%')
                    ->orwhere('rtn','LIKE', '%'.$this->search.'%')
                    ->orwhere('telefono','LIKE', '%'.$this->search.'%')
                    ->orwhere('email','LIKE', '%'.$this->search.'%')
                   -> orWhereHas('tipoPersona', function ( $query) {
                        $query->where('name', 'like','%'.$this->search.'%');
                    })
                    -> orWhereHas('entidad', function ( $query) {
                        $query->where('name', 'like','%'.$this->search.'%');
                    })
                    ->latest('id')
                    ->paginate();
        return view('livewire.admin.personas-index',compact('personas'));
    }


    public function selectExoneracion(Persona  $persona)
    {
        $this->personData = Persona::findOrFail($persona->id);
        $this->personExoneracion=  $this->personData->exoneraciones;
        $this->mostrarAdd();
        $this->showModal = true;
    }


    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['selectedPersonId', 'personData']);
    }

    
    public function editExoneracion($idExoneracion)
    {
        $this->selectedExoneracionId = $idExoneracion;
        $exoneration = PersonaExoneracion::find($idExoneracion); // Ajusta el modelo y nombre de la tabla según tu aplicación
        $this->exoneracion = $exoneration ? $exoneration->toArray() : [];
        $this->showForm = true;
    }

    
    public function updateExoneracion()
    {
        // Validar y procesar los datos actualizados
        if(isset($this->exoneracion['id'])){
            PersonaExoneracion::find($this->exoneracion['id'])->update($this->exoneracion); // Ajusta el modelo y nombre de la tabla según tu aplicación
        }else{
            $this->exoneracion['persona_id']=$this->personData['id'];
            PersonaExoneracion::create($this->exoneracion); // Ajusta el modelo y nombre de la tabla según tu aplicación
        }
        
        $this->personData = Persona::findOrFail($this->personData['id']);
        $this->personExoneracion=  $this->personData->exoneraciones;
        $this->showForm = false;
        $this->mostrarAdd();
        $this->reset(['exoneracion'],);
    }

    public function mostrarAdd(){
        $this->showAdd=true;
        
        foreach ($this->personExoneracion as $key) {
            if($key['status']==2){
                $this->showAdd=false;

            }
        }
    }

    public function addExoneracion(){
        $this->showForm = true;
        $this->showAdd=false;
    }

    

}
