<?php

namespace App\Http\Livewire\Admin;

use App\Models\Embarque;
use Illuminate\Support\Collection;
use Livewire\Component;

class SelectEmbarque extends Component
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
        $list = Embarque::join('documentos_fiscales', 'embarques.id','=','documentos_fiscales.embarque_id')
                ->select('embarques.id', 'num_embarque','fecha',Embarque::raw('SUM(documentos_fiscales.total) as total'))
                ->groupBy('embarques.id')
                ->orderBy('embarques.num_embarque', 'asc')
                ->get();
        $this->listaOri = $this->addSelect($list);
        $this->listaItem = $this->addSelect($list);
    }

 
    public function onChange()
    {
        $items  = collect($this->listaOri)
            ->where(function ($item) {
                $name = stristr($item['num_embarque'], $this->search);
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
        $this->name=array_key_exists('num_embarque', $dataSelect) ?$dataSelect['num_embarque']:'';
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
    
    public function addItem(){
        $this->showModal = true;
    }
  
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['num_embarque']);
    }
    public function render()
    {
        return view('livewire.admin.select-embarque');
    }
}
