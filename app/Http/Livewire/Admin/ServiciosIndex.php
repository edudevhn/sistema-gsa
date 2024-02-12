<?php

namespace App\Http\Livewire\Admin;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class ServiciosIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        
      $servicios = Servicio::where('name','LIKE', '%'.$this->search.'%')
                    ->orwhere('status','LIKE', '%'.$this->search.'%')
                    /*  -> orWhereHas('cuenta', function ( $query) {
                        $query->where('name', 'like','%'.$this->search.'%');
                    })
                    -> orWhereHas('cuenta.valueType', function ( $query) {
                        $query->where('name', 'like','%'.$this->search.'%');
                    })*/
                    -> orWhereRelation('cuenta', 'name', 'like', '%'.$this->search.'%')
                    -> orWhereRelation('valueType', 'name', 'like', '%'.$this->search.'%')
                    ->latest('id')
                    ->paginate();
        return view('livewire.admin.servicios-index',compact('servicios'));
    }
}