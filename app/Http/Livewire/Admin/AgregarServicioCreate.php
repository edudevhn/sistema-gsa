<?php

namespace App\Http\Livewire\Admin;

use App\Models\Moneda;
use App\Models\Servicio;
use Illuminate\Support\Collection;
use Livewire\Component;
use stdClass;

class AgregarServicioCreate extends Component
{
    public $serviciosArray = [];
    public $monedas;
    public $listaServicios;
    public $servicio_id;
    public $moneda_id;
    public $servicio;
    public $cantidad=1;
    public $descripcion;
    public $precio=1;
    public $tc_hnd;
    public $tc_usd;
    public $total;
    public $um;
    public function mount($moneda_id = null)
    {
        $listaServicios= Servicio::with(['valueType'])
            ->select('id', 'name','cuenta_id','value_type_id')->orderBy('name','asc')->get();
        $this->listaServicios = $this->addSelect($listaServicios);
        $monedas=Moneda::select('id', 'name', 'tasa_cambio')->get();
        $this->monedas =$this->addSelect($monedas);// $monedas;
        $tempProducts = session('tempProducts');
        if ($tempProducts) {
            $array = new stdClass;
            $array= json_decode($tempProducts, true);
            $this->serviciosArray = $array;
            session()->forget('tempProducts');
            $this->calcularTotal();
        }
        if($moneda_id){
            $this->moneda_id=$moneda_id;
            $this->getTazaCambio();
        }
    }

    public function agregarServicio()
    {
        $this->validate([
            'servicio_id' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
            'um' => 'required',
        ]);
        
        $dataSelect=$this->listaServicios->where('id',$this->servicio_id)->first();
        $nombre=array_key_exists('name', $dataSelect) ?$dataSelect['name']:'';
        $tipoValor=array_key_exists('value_type', $dataSelect) ?$dataSelect['value_type']['name']:'';
        $subTotal=$this->cantidad*$this->precio;
        $isv=0;
        if($tipoValor=='GRAVADO'){
            $isv=$subTotal*.15;
        }
        $total=$subTotal+$isv;
        $servicio = [
            'servicio_id' => $this->servicio_id,
            'nombre' =>  $nombre,
            'um' => $this->um,
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'isv' => $isv,
            'tipoValor'=>$tipoValor,
            'total' => $total,
        ];

        // Agregar el producto al array de servicios
        $this->serviciosArray[] = $servicio;
        //Calcular Total
        $this->calcularTotal();
        // Limpiar los campos del formulario después de agregar el producto
        $this->reset(['servicio_id','servicio','descripcion', 'cantidad', 'precio']);
    }

    public function deletServicio($id){
        $found_key = array_search($id, array_column($this->serviciosArray, 'servicio_id'));
        array_splice($this->serviciosArray, $found_key , 1);
        $this->calcularTotal();
    }
    private function calcularTotal(){
        $this->total=0;
        foreach( $this->serviciosArray as $servicio){
            $this->total+=$servicio['total'];
        }
        
    }
    
    public function onMonedaChange()
    {
        $this->getTazaCambio();
        if($this->moneda_id){
            $this->changeValueMoneda();
        }
    }
    
    
    public function getTazaCambio(){
        $dataSelect=$this->monedas->where('id',$this->moneda_id)->first();
        $this->tc_hnd=array_key_exists('tasa_cambio', $dataSelect) ?$dataSelect['tasa_cambio']:'';
        $this->tc_usd=array_key_exists('tasa_cambio', $dataSelect) ?$dataSelect['tasa_cambio']:'';
    }
    public function changeValueMoneda(){
        $simbolo='/';
        if($this->moneda_id==1){
            $simbolo='*';
        }
        foreach( $this->serviciosArray as $servicio => $value){
            $precio=$this->serviciosArray[$servicio]['precio'].$simbolo. $this->tc_usd;
            $isv=$this->serviciosArray[$servicio]['isv'].$simbolo. $this->tc_usd;
            $total=$this->serviciosArray[$servicio]['total'].$simbolo. $this->tc_usd;
            $this->serviciosArray[$servicio]['precio']=number_format(eval("return $precio;"), 2, '.', ''); 
            $this->serviciosArray[$servicio]['isv']=number_format(eval("return $isv;"),2,'.','');
            $this->serviciosArray[$servicio]['total']=number_format(eval("return $total;"),2,'.','');
        }
        $this->calcularTotal();
    }

    public function onServicioChange()
    {
        
        $dataSelect=$this->listaServicios->where('id',$this->servicio_id)->first();
    }

    public function onDescuentoChange()
    {
        //Calcular Total
        $this->calcularTotal();
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
    public function render()
    {
        return view('livewire.admin.agregar-servicio-create');
    }
}
