<?php

namespace App\Http\Livewire\Admin;

use App\Models\Costo;
use Livewire\Component;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\Auth;

class CostoIndex extends Component
{
    protected $paginationTheme ='bootstrap';
    public $search;
    public $documentosData;
    public $showModal=false;
    public $listaDocumentos;
    public $costoSelect;
    public $showModalStatus=false;
    public $statusList;
    public function updatingSearch(){
        $this->resetPage();
    }


    
    public function showDocumentos( Costo $costo)
    {
        $this->costoSelect=$costo;
         $this->showModal = true;
    }
    
    private function addSelect($variable){
        // $variableArray = $variable->toArray();
  
         // Convertir el array en una colección nuevamente
         return new Collection($variable);
     }
 
     public function closeModal()
     {
         $this->showModal = false;
       //  $this->reset(['selectedPersonId', 'personData']);
     }
 
     

    public function render()
    {
        $gastos = Costo::where(function ($query) {
            $query->where('fecha_factura','LIKE', '%'.$this->search.'%')
            ->orwhere('documento_cobro','LIKE', '%'.$this->search.'%')
            ->orwhere('valor_neto_factura','LIKE', '%'.$this->search.'%')
            ->orwhere('total','LIKE', '%'.$this->search.'%')
            -> orWhereRelation('embarque', 'num_embarque', 'like', '%'.$this->search.'%')
            -> orWhereRelation('servicio', 'name', 'like', '%'.$this->search.'%')
            -> orWhereRelation('proveedor', 'name', 'like', '%'.$this->search.'%')
            -> orWhereRelation('tipoCosto', 'name', 'like', '%'.$this->search.'%');
        })
        ->latest('id')
        ->paginate(); 
        return view('livewire.admin.costo-index',compact('gastos'));
    }

    public function showStatus(Costo $costo){
        $this->statusList=$costo->estados;
        $this->showModalStatus = true;

    }
     public function closeModalStatus()
     {
         $this->showModalStatus = false;
       //  $this->reset(['selectedPersonId', 'personData']);
     }

     public function cancelCosto(Costo $costo){
        $user = Auth::user();
        // Guardar un nuevo estado con el user_id
        $costo->estados()->create([
            'estado' => 'GASTO CANCELADO',
            'user_id' => $user->id,
        ]);

    }
}
