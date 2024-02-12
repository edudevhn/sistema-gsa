<?php

namespace App\Http\Livewire\Admin;

use App\Models\Aduana;
use Illuminate\Support\Collection;
use Livewire\Component;

class SelectAduanas extends Component
{
    public $listaOri;
    public $listaItem;
    public $showList=false;
    public $search;
    public $item_id;
    public $name;
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
        $list = Aduana::select('id', 'name')
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
        $item = new Aduana();
        $item->name=$this->name;
        $item->save();
  
        $this->loadItems();
        $this->reset(['name']);
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
        return view('livewire.admin.select-aduanas');
    }
}
