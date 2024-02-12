<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CuentasXCobrarIndex extends Component
{
    public $serviciosArray = [];
    public $cliente_id;
    public $fechaInicio;
    public $fechaFin;
    public function render()
    {
        return view('livewire.admin.cuentas-x-cobrar-index');
    }
}
