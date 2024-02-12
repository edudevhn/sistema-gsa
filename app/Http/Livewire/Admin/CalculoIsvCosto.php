<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CalculoIsvCosto extends Component
{
    
    public $valorNetoFactura;
    public $isv;
    public $total;

    public function mount($costo = null)
    {
       
        if($costo){
            $this->valorNetoFactura=$costo->valor_neto_factura;
            $this->isv=$costo->isv;
            $this->total=$costo->total;
        }
            
    }
    public function render()
    {
        return view('livewire.admin.calculo-isv-costo');
    }

    public function onChange()
    {
        //Calcular Total
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        //Calcular Total
        //if(!$this->isv){
        $this->isv=$this->valorNetoFactura*.15;
        //}
        $this->total=$this->valorNetoFactura+$this->isv;
    }

    public function changeiSV()
    {
        $this->total=$this->valorNetoFactura+$this->isv;
    }
}
