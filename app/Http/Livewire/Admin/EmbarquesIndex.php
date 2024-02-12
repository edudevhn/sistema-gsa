<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cotizacion;
use App\Models\DocumentosFiscales;
use App\Models\Embarque;
use App\Models\Moneda;
use App\Models\Proforma;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class EmbarquesIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $documentosData;
    public $showModal=false;
    public $listaDocumentos;
    public $embarqueSelect;

    public $showModalStatus=false;
    public $statusList;

    public $showModalChangeStatus=false;
    public $listEstados=[];
    public $estadoSelect=[];
    public $obserStatus=null;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function showDocumentos( Embarque $embarque)
    {
        $this->embarqueSelect=$embarque;
        $this->showModal = true;                                  
    }

    private function addSelect($variable){
      //$variableArray = $variable;
       // Agregar un cliente manualmente
       $variableManual = [
          'id' => '',
          'name'=> 'Seleccione...'
       ];
       $variableArray[] = $variableManual;

      // Convertir el array en una colección nuevamente
      return new Collection($variableArray);
  }

    public function closeModal()
    {
        $this->showModal = false;
    }

    


    public function render()
    {
        
      $embarques = Embarque::select('embarques.*', 'embarque_estados.estado as estado_actual')
                    ->leftjoin('embarque_estados', function ($join) {
                      $join->on('embarques.id', '=', 'embarque_estados.embarque_id')
                            ->whereRaw('embarque_estados.id = (select id from embarque_estados where embarque_id = embarques.id order by created_at desc limit 1)');
                    })->where('num_embarque','LIKE', '%'.$this->search.'%')
                    ->orwhere('fecha','LIKE', '%'.$this->search.'%')
                    // ->orwhere('mercancia','LIKE', '%'.$this->search.'%')
                    // ->orwhere('servicio','LIKE', '%'.$this->search.'%')
                    ->orwhere('periodo_sys','LIKE', '%'.$this->search.'%')
                    // ->orwhere('lugar_entrega','LIKE', '%'.$this->search.'%')
                    ->orwhere('fecha_valida','LIKE', '%'.$this->search.'%')
                    -> orWhereRelation('mercancia', 'name', 'like', '%'.$this->search.'%')
                    -> orWhereRelation('persona', 'name', 'like', '%'.$this->search.'%')
                    -> orWhereRelation('aduana', 'name', 'like', '%'.$this->search.'%')
                    ->latest('id')
                    ->paginate();
        $monedas= Moneda::get();
        return view('livewire.admin.embarques-index',compact('embarques','monedas'));
    }


  public function showStatus(Embarque $embarque)
  {
    $this->statusList=$embarque->estados;
    $this->showModalStatus = true;

  }

  
  public function showStatusCotizacion(Cotizacion $cotizacion)
  {
    $this->statusList=$cotizacion->estados;
    $this->showModalStatus = true;

  }

  public function showStatusProforma(Proforma $documento)
  {
    //dd($proforma->estados);
    $this->statusList=$documento->estados;
    $this->showModalStatus = true;

  }

  
  public function showStatusDocumentoFiscal(DocumentosFiscales $documento)
  {
    $this->statusList=$documento->estados;
    $this->showModalStatus = true;

  }


   public function closeModalStatus()
   {
      $this->statusList=[];
      $this->showModalStatus = false;
     //  $this->reset(['selectedPersonId', 'personData']);
   }

  public function openModalChangeStatus(Embarque $embarque)
  {
    $this->embarqueSelect=$embarque;
    $estados= [
      ''=>'Seleccione...',
      'CONSILIADO'=>'CONSILIADO',
      'CANCELADO'=>'CANCELADO',
      'SUSPENDIDO'=>'SUSPENDIDO',
      'FINALIZADO'=>'FINALIZADO',
    ];
    //asort($estados);
    $this->listEstados=$estados;
    $this->showModalChangeStatus = true;

  }
   public function closeModalChangeStatus()
   {
       $this->showModalChangeStatus = false;
     //  $this->reset(['selectedPersonId', 'personData']);
   }

   public function savetatus()
   {
   // dd($this->obserStatus);
      $user = Auth::user();
      $this->embarqueSelect->estados()->create([
          'estado' => $this->estadoSelect,
          'observacion' => $this->obserStatus,
          'user_id' => $user->id,
      ]);
      $this->closeModalChangeStatus();
   }
   
   
}
