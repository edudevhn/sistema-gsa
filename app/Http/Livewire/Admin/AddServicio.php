<?php

namespace App\Http\Livewire\Admin;

use App\Models\Moneda;
use App\Models\Servicio;
use Livewire\Component;
use Illuminate\Support\Collection;
use stdClass;

class AddServicio extends Component
{
    public $serviciosArray = [];
    public $monedas;
    public $listaServicios;
    public $servicio_id;
    public $moneda_id;
    public $servicio;
    public $cantidad=1;
    public $descripcion;
    public $um;
    public $precio=1;
    public $tc_hnd;
    public $tc_usd;
    public $importeGravado;
    public $importeExento;
    public $descuento=0;
    public $importeExonerado;
    public $subTotal;
    public $isv;
    public $total;
    public function mount($moneda_id = null)
    {
        $listaServicios= Servicio::with(['valueType'])
            ->select('id', 'name','cuenta_id','value_type_id')
            ->orderBy('name','asc')
            ->get();
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
        ]);
        $dataSelect=$this->listaServicios->where('id',$this->servicio_id)->first();
        //dd($dataSelect);
        $nombre=array_key_exists('name', $dataSelect) ?$dataSelect['name']:'';
        $tipoValor=array_key_exists('value_type', $dataSelect) ?$dataSelect['value_type']['name']:'';
        $total=$this->cantidad*$this->precio;
        $isv=0;
        if($tipoValor=='GRAVADO'){
            $isv=$total*.15;
        }
        $servicio = [
            'servicio_id' => $this->servicio_id,
            'nombre' =>  $nombre,
            'descripcion' => $this->descripcion,
            'um' => $this->um,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'tipoValor'=>$tipoValor,
            'isv'=>$isv,
            'total' => $total,
        ];

        // Agregar el producto al array de servicios
        $this->serviciosArray[] = $servicio;
        //Calcular Total
        $this->calcularTotal();
        // Limpiar los campos del formulario después de agregar el producto
        $this->reset(['servicio_id','servicio','descripcion','um', 'cantidad', 'precio']);
    }

    public function deletServicio($id){
        $found_key = array_search($id, array_column($this->serviciosArray, 'servicio_id'));
        array_splice($this->serviciosArray, $found_key , 1);
        $this->calcularTotal();
    }
    private function calcularTotal(){
        $this->importeGravado=0;
        $this->importeExento=0;
        $this->importeExonerado=0;
        $this->subTotal=0;
        $this->isv=0;
        $this->total=0;
        foreach( $this->serviciosArray as $servicio){
            if($servicio['tipoValor']=='GRAVADO'){
                $this->importeGravado+=$servicio['total'];
            }
            if($servicio['tipoValor']=='EXENTO'){
                $this->importeExento+=$servicio['total'];   
            }
            if($servicio['tipoValor']=='EXONERADO'){
                $this->importeExonerado+=$servicio['total'];   
            }
            $this->isv+=$servicio['isv'];
        }
        $this->subTotal= $this->importeGravado+$this->importeExento+$this->importeExonerado-$this->descuento;
        $this->total=$this->subTotal+$this->isv;
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
        //dd($this->serviciosArray);
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
        return view('livewire.admin.add-servicio');
    }
}
