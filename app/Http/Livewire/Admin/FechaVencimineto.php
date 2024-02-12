<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Carbon;
use Livewire\Component;

class FechaVencimineto extends Component
{
    public $fechaEmision;
    public $fechaVencimiento;
    public $diasCredito;

    protected $listeners = ['personaChange' => 'actualizarDias'];
    public function mount($fechaEmision=null,$fechaVencimiento=null,$diasCredito)
    {
        if($fechaEmision){
            $this->fechaEmision=$fechaEmision;
            $this->fechaVencimiento=$fechaVencimiento;
            $this->diasCredito=$diasCredito;
           // $this->onFechaCange();
        }else{
            $fecha=Carbon::now()->toDateString();
            $this->fechaEmision=$fecha;
            // $this->fechaVencimiento=$fechaVencimiento;
            $this->diasCredito=$diasCredito;
            $this->onFechaCange();
        }
    }
    
    public function actualizarDias($nuevoValor)
    {
        $this->diasCredito = $nuevoValor;
        $this->onFechaCange();
    }

    public function onFechaCange()
    {
        $fecha=Carbon::parse($this->fechaEmision);
        $this->fechaVencimiento=$fecha->addDays($this->diasCredito)->toDateString();
    }

    public function render(PersonaSelect $personaSelect)
    {
        return view('livewire.admin.fecha-vencimineto');
    }
}
