<?php

namespace App\Http\Livewire\Admin;

use App\Models\Moneda;
use Illuminate\Support\Collection;
use Livewire\Component;

class CalculoPago extends Component
{
    public $monedas;
    public $documentoFiscal;
    public $valor_facturado=0;
    public $pago_recibido=0;
    public $pago_actual=0;
    public $valor_retencion=0;
    public $saldo_actual=0;
    public $saldo=0;
    public $total_pagado=0;
    public $total_pago_aplicado=0;

    public function mount($documentoFiscal=null){        
        $this->monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $this->monedas =$this->addSelect($this->monedas);// $monedas;
        if($documentoFiscal){
            $this->documentoFiscal=$documentoFiscal;
            $this->valor_facturado=$this->documentoFiscal->total;
            $this->totalPagado();
            $this->calcularPago();
        }
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

    private function totalPagado(){
        foreach($this->documentoFiscal->pagos as $pago){
            $this->pago_recibido+=$pago->pago_actual+$pago->retencion;
        }
        $this->saldo_actual=$this->valor_facturado-$this->pago_recibido;
    }


    public function calcularPago(){
        $this->saldo=$this->valor_facturado-$this->pago_recibido-$this->pago_actual-$this->valor_retencion;
        $this->total_pago_aplicado=$this->pago_recibido+$this->pago_actual+$this->valor_retencion;
    }

    public function render()
    {
        return view('livewire.admin.calculo-pago');
    }
}
