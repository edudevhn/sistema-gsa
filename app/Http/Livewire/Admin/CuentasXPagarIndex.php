<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CuentasXPagarIndex extends Component
{
    public $serviciosArray = [];
    public $cliente_id;
    public $fechaInicio;
    public $fechaFin;
    public function render()
    {
        return view('livewire.admin.cuentas-x-pagar-index');
    }
}
