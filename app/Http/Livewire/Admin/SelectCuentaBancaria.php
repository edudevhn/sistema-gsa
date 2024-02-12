<?php

namespace App\Http\Livewire\Admin;

use App\Models\CuentaBancaria;
use Illuminate\Support\Collection;
use Livewire\Component;

class SelectCuentaBancaria extends Component
{
    public $listaOri;
    public $listaItem;
    public $showList=false;
    public $search;
    public $item_id;
    public $name;
    public $numCuenta;
    public $beneficiario;
    public $rtn;
    public $predeterminada;
    public $status;
    public $moneda_id;
    public $banco_id;
    public $tipo_banco;
    public $showModal = false;
    public function mount($idEdit = null)
    {
        $this->loadItems();
        if($idEdit){
            $this->onSelect($idEdit);
            $this->toggleVariable();
        }
    }

    public function loadItems(){
        $list = CuentaBancaria::join('bancos', 'cuenta_bancarias.banco_id', '=', 'bancos.id')
        ->select('cuenta_bancarias.id', 'cuenta_bancarias.name','cuenta_bancarias.num_cuenta', 'bancos.name as nombre_banco')
        ->orderBy('name', 'asc')
        ->get();
        $this->listaOri = $this->addSelect($list);
        $this->listaItem = $this->addSelect($list);
    }

 
    public function onChange()
    {
        $items  = collect($this->listaOri)
            ->where(function ($item) {
                $name = stristr($item['name'], $this->search);
                return $name;
                
            })
            ->all();
        $this->listaItem = $items;
        $this->reset(['item_id','name']);
    }

    public function onSelect($idItem)
    {
        // dd($dataSelect);
        $this->item_id=$idItem;
        $dataSelect=$this->listaOri->where('id',$this->item_id)->first();
        $this->name=array_key_exists('name', $dataSelect) ?$dataSelect['name']:'';
        $this->numCuenta=array_key_exists('num_cuenta', $dataSelect) ?$dataSelect['num_cuenta']:'';
        $this->numCuenta=array_key_exists('nombre_banco', $dataSelect) ?$dataSelect['nombre_banco']:'';
        $this->toggleVariable();
    }
    
    private function addSelect($variable){
        $variableArray = $variable->toArray();
        return new Collection($variableArray);
    }
    
    public function toggleVariable()
    {
        $this->showList = !$this->showList;
    }
    
    public function saveItem()
    {
        $item = new CuentaBancaria();
        $item->name=$this->name;
        $item->num_cuenta=$this->numCuenta;
        $item->beneficiario=$this->beneficiario;
        $item->rtn=$this->rtn;
        $item->predeterminada=$this->predeterminada;
        $item->status=$this->status;
        $item->moneda_id=$this->moneda_id;
        $item->banco_id=$this->banco_id;
        $item->tipo_banco=$this->tipo_banco;
        $item->save();  
        $this->loadItems();
        $this->reset(['name','numCuenta','beneficiario','rtn','predeterminada','status','moneda_id','banco_id','tipo_banco']);
        $this->closeModal();
        
    }
    public function addItem(){
        $this->showModal = true;
    }
  
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name','numCuenta','beneficiario','rtn','predeterminada','status','moneda_id','banco_id','tipo_banco']);
    }
    public function render()
    {
        return view('livewire.admin.select-cuenta-bancaria');
    }
}
