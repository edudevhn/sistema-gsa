<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cotizacion;
use App\Models\Moneda;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CotizacionesIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    
    public $showModalStatus=false;
    public $statusList;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $cotizaciones = Cotizacion::select('cotizaciones.*', 'cotizacion_estados.estado as estado_actual')
        ->leftjoin('cotizacion_estados', function ($join) {
            $join->on('cotizaciones.id', '=', 'cotizacion_estados.cotizacion_id')
                ->whereRaw('cotizacion_estados.id = (select id from cotizacion_estados where cotizacion_id = cotizaciones.id order by created_at desc limit 1)');
        })
        ->where('num_documento','LIKE', '%'.$this->search.'%')
        ->orwhere('fecha','LIKE', '%'.$this->search.'%')
        ->orwhere('periodo_sys','LIKE', '%'.$this->search.'%')
        ->orwhere('fecha_valida','LIKE', '%'.$this->search.'%')
        -> orWhereRelation('mercancia', 'name', 'like', '%'.$this->search.'%')
        -> orWhereRelation('terminoPago', 'name', 'like', '%'.$this->search.'%')
        -> orWhereRelation('persona', 'name', 'like', '%'.$this->search.'%')
        -> orWhereRelation('aduana', 'name', 'like', '%'.$this->search.'%')
        ->latest('id')
        ->paginate();
        $monedas= Moneda::get();
        return view('livewire.admin.cotizaciones-index',compact('cotizaciones','monedas'));
    }

    public function showStatus(Cotizacion $cotizacion){
        $this->statusList=$cotizacion->estados;
        $this->showModalStatus = true;

    }
     public function closeModal()
     {
         $this->showModalStatus = false;
       //  $this->reset(['selectedPersonId', 'personData']);
     }

     public function cancelCotizacione(Cotizacion $cotizacion){
        $user = Auth::user();
        // Guardar un nuevo estado con el user_id
        $cotizacion->estados()->create([
            'estado' => 'COTIZACIÓN CANCELADA',
            'user_id' => $user->id,
        ]);

    }

     
}