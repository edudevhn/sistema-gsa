<?php

namespace App\Http\Livewire\Admin;

use App\Models\DocumentosFiscales;
use App\Models\Factura;
use App\Models\Moneda;
use Livewire\Component;
use Livewire\WithPagination;

class FacturasIndex extends Component
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
    //    $cotizaciones = Cotizacion::select('cotizaciones.*', 'cotizacion_estados.estado as estado_actual')
        
      $facturas = DocumentosFiscales::select('documentos_fiscales.*', 'documentos_fiscales_estados.estado as estado_actual')
                    ->leftjoin('documentos_fiscales_estados', function ($join) {
                        $join->on('documentos_fiscales.id', '=', 'documentos_fiscales_estados.documento_fiscal_id')
                        ->whereRaw('documentos_fiscales_estados.id = (select id from documentos_fiscales_estados where documento_fiscal_id = documentos_fiscales.id order by created_at desc limit 1)');
                    })
                    ->where(function ($query) {
                        $query->where('numero_documento','LIKE', '%'.$this->search.'%')
                        -> orWhereRelation('embarque.persona', 'name', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('embarque.persona', 'rtn', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('documentoFiscalDetalles', 'fecha_vencimiento', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('documentoFiscalDetalles', 'fecha_emision', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('documentoFiscalDetalles', 'referencia_interna', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('documentoFiscalDetalles', 'periodo_sys', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('documentoFiscalDetalles', 'duca', 'like', '%'.$this->search.'%')
                        -> orWhereRelation('embarque.aduana', 'name', 'like', '%'.$this->search.'%');
                    })

                    
                    ->WhereRelation('documentoTipo','id',1)
                    ->latest('id')
                    ->paginate();

                    $monedas= Moneda::get();
        return view('livewire.admin.facturas-index',compact('facturas','monedas'));
    }


    public function showStatus(DocumentosFiscales $documento){
        $this->statusList=$documento->estados;
        $this->showModalStatus = true;

    }
    public function closeModal()
    {
        $this->showModalStatus = false;
    }
}
