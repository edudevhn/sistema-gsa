<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mercancia;
use Illuminate\Support\Collection;
use Livewire\Component;

class MercanciaSelect extends Component
{
    public $listaOri;
    public $listaItem;
    public $showList=false;
    public $search;
    public $item_id;
    public $name;
    public $registroPartida;
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
        $list = Mercancia::select('id', 'name','registro_partida')
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
        $item = new Mercancia();
        $item->name=$this->name;
        $item->registro_partida=$this->registroPartida;
        $item->save();
  
        $this->loadItems();
        $this->reset(['name','registroPartida']);
        $this->closeModal();
        
    }
    public function addItem(){
        $this->showModal = true;
    }
  
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.admin.mercancia-select');
    }

         
}
