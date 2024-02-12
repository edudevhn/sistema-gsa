<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Proforma</title>
    <style>       
        body {
            font-family: Arial, sans-serif;
            margin: 0mm;
        }
        footer {
            font-family: Arial, sans-serif;
            margin: 0mm;
        }
         /* Agregar un borde alrededor de la página */
        @page {
            border: 1px solid black;
            margin: 5mm;
        }
        .header {
            text-align: center;
        }
        .table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            /* word-break: break-all !important;
            white-space: nowrap !important; */
        }
        .table th {
            text-align: left;
            /* border: 1px solid #ccc;  */
        }
        .table td {
            width: auto;
            font-size:11px;
            /* border: 1px solid #ccc;  */
        }
        .tableDet {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            
            /* word-break: break-all !important;
            white-space: nowrap !important; */
        }
        .tableDet th {
            text-align: left;
        }
        .tableDet td {
            width: auto;
            font-size:11px;
            padding: 8px !important;
            
             /* border: 1px solid #ccc;  */
        }
        .table2 {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            /* word-break: break-all !important;
            white-space: nowrap !important; */
        }
        .table2 td {
            width: auto;
            font-size:8px;
            /* border: 1px solid #ccc;  */
        }
        td {
            width: auto;
            overflow: hidden;
        }
        .titulo{
            margin: 2px !important;
            text-align: left !important;
            font-weight: bold !important;
            font-size:22px !important;            
        }
        .subTitulo{
            text-align: left;
            font-weight: bold;
            font-size:14px;
            padding: 6px !important;
        }
        .f20BL{
            margin: 2px !important;
            text-align: left !important;
            font-weight: bold !important;
            font-size:20px !important;            
        }
        .f8{
            font-size:4px !important;
        }
        .f8R{
            text-align: right !important;
            font-size:9px !important;
        }
        .f8C{
            text-align: center !important;
            font-size:9px !important;
        }
        .f9R{
            text-align: right !important;
            font-size:9px !important;
        }
        .f9B{
            font-weight: bold !important;
            font-size:9px !important;
        }
        .f9CB{
            font-weight: bold !important;
            text-align: center !important;
            font-size:9px !important;
        }
        .f10R{
            text-align: right !important;
            font-size:10px !important;
        }
        .f10B{
            font-weight: bold !important;
            font-size:10px !important;
        }
        .f10CBI{
            font-weight: bold !important;
            font-size:10px !important;
            font-style: italic !important;
        }
        .f10CB{
            font-weight: bold !important;
            text-align: center !important;
            font-size:10px !important;
        }
        .f11{
            font-size:11px !important;
        }
        .f11C{
            text-align: center !important;
            font-size:11px !important;
        }
        .f11B{
            font-weight: bold !important;
            font-size:11px !important;
        }
        .f11R{
            text-align: right !important;
            font-size:11px !important;
        }
        .f11CB{
            text-align: center !important;
            font-weight: bold !important;
            font-size:11px !important;
        }
        .f12CB{
            text-align: center !important;
            font-weight: bold !important;
            font-size:12px !important;
        }
        .f12{
            font-size:12px !important;
        }
        .f12B{
            font-weight: bold !important;
            font-size:12px !important;
        }
        .f12BR{
            text-align: right !important;
            font-weight: bold !important;
            font-size:12px !important;
        }
        .f13CB{
            text-align: center !important;
            font-weight: bold !important;
            font-size:13px !important;
        }
        .bodyTable{
            text-align: left;
            font-size:10px;
        }
        .celdaGris{
            background-color: #B9B6B5;
        }        
        .celVacio{
            padding: 10px !important;
        }
        .bordes{
            border: 1px solid #0a0a0a;
        }
        .bordeTop{
            border-top: 1px solid #0a0a0a;
        }
        .bordeBootom{
            border-bottom: 1px solid #0a0a0a;
        }
        .bordeL{
            border-left: 1px solid #0a0a0a;
        }
        .bordeR{
            border-right: 1px solid #0a0a0a;
        }
        .bordeInline{
            border-left: 1px solid #0a0a0a;
            border-right: 1px solid #0a0a0a;
        }
    </style>
  </head>
  <body>
    @php
        function getMonedaConvert($monedaSelect){
            $monedaConver='HNL';
            if ($monedaSelect=='HNL'){
                $monedaConver='USD';
            }
            return $monedaConver;
        }
        function getValMonedaConvert($value,$moneda,$monedaSelect,$tc){
            $valMonedaConver=0;
            if ($moneda=='HNL' && $monedaSelect=='USD' ){
                $valMonedaConver=$value;
            }else if($moneda=='USD' && $monedaSelect=='HNL' ) {
                $valMonedaConver=$value;
            }else if($moneda=='HNL' && $monedaSelect=='HNL' ) {
                $valMonedaConver=$value/$tc;
            }else if($moneda=='USD' && $monedaSelect=='USD' ) {
                $valMonedaConver=$value*$tc;
            }
            return number_format($valMonedaConver, 3, '.', ',');
        }
        function getForma($value,$moneda,$monedaSelect,$tc) {
            $convercion=$value;
            if ($moneda=='HNL' && $monedaSelect=='USD'){
                $convercion=$value/$tc;
            }else{
                if ($moneda=='USD' && $monedaSelect=='HNL'){
                    $convercion=$value*$tc;
                } 
            }
            return number_format($convercion, 3, '.', ',');
        }
    @endphp
    <div>
        <table class="table table-striped" >
            <thead >
                {{-- <tr class="titulo">
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                    <th>a</th>
                </tr> --}}
                <tr class="titulo">
                    <th colspan="7" class="f20BL">{{$globCompanyName}}</th>
                    <th colspan="2" rowspan="4"><img src="{{$imagenBase64}}" width=150 height=100 class="data-dialog"></th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="7">RTN: {{$globCompanyRTN}}</th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="7">{{$globCompanyAddress}}</th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="7">{{$globCompanyCity}}, {{$globCompanyCountry}} | TEL: {{$globCompanyPhone}}  | {{$globCompanyEmail}}</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <tr>
                    <td colspan="9"></td>
                </tr>
                <tr>
                    <td colspan="2" class="f10R">FECHA EMISION</td>
                    <td colspan="2" class="bordes f11CB">{{$proforma->fecha_emision}}</td>
                    <td colspan="2"></td>
                    <td colspan="3" class="f12CB bordeInline bordeTop">PROFORMA DE GASTOS</td>
                </tr>
                <tr>
                    <td colspan="2" class="f10R">FECHA VENCIMIENTO</td>
                    <td colspan="2" class="bordes f11CB">{{$proforma->fecha_vencimiento}}</td>
                    <td colspan="2"></td>
                    <td colspan="3" class="f12CB bordeInline">No. {{$proforma->num_documento}}</td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td colspan="3" class="f13CB bordes">SUJETO A FACTURACION FINAL</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="2" class="bordeInline bordeTop f12">FACTURA A:</td>
                    <td colspan="2" class="f9R bordeTop">Embarcador:</td>
                    <td colspan="3" class="bordeTop bordeR f9B">{{$proforma->embarque->embarcador}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="f9R">Consignatario:</td>
                    <td colspan="3" class="bordeR f9B" >{{$proforma->embarque->consignatario}}</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="2" class="bordeInline f12B">{{$proforma->embarque->persona->name}}</td>
                    <td colspan="2" class="f9R">Lugar Embarque:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->lugarEmbarque->name}}</td>
                </tr>               
                <tr>
                    <td colspan="2" class="f9R">Lugar Desembarque:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->lugarEntrega->name}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="bordeInline f12">RTN No:</td>
                    <td colspan="2" class="f9R">No. Booking / Master Doc:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->no_booking}}</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" class="bordeInline f12B" >{{$proforma->embarque->persona->rtn}}</td>
                    <td colspan="2" class="f9R">No. Documento Transporte:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->no_documento_transporte}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="f9R">Detalle de Carga:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->peso}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="f9R">Equipo:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->equipo}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="bordeInline f12">DIRECCION FISCAL:</td>
                    <td colspan="2" class="f9R">Aduana de Ingreso/Salida:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->aduana->name}}</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" class="bordeInline bordeBootom f12B">{{$proforma->embarque->persona->direccion}}</td>
                    <td colspan="2" class="f9R">Destino final:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->lugarEntrega->name}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="f9R">Numero de Embarque:</td>
                    <td colspan="3" class="bordeR f9B">{{$proforma->embarque->num_embarque}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="f9R bordeBootom">DUCA/Poliza No.:</td>
                    <td colspan="3" class="bordeR f9B bordeBootom">{{$proforma->duca}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tableDet">
        <table class="tableDet table-striped" >
            <thead>
                <tr class="celdaGris">
                    <th class="f9CB celdaGris bordes" colspan="7">DESCRIPCIÓN DE SERVICIOS</th>
                    <th class="f9CB celdaGris bordes">DOC. DE COBRO.</th>
                    <th class="f9CB celdaGris bordes">CANT.</th>
                    <th class="f9CB celdaGris bordes">PRECIO UNITARIO.</th>
                    <th class="f9CB celdaGris bordes">VALOR TOTAL.</th>
                    <th class="f9CB celdaGris bordes">% ISV.</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                @php
                    $filas=18;
                @endphp
                @foreach ($proforma->servicios as $item)
                    <tr>
                        <td class="bordeInline f11"  colspan="7">
                            {{$item->name}}<br>
                            @if ($item->pivot->descripcion)
                                <span class="f11B">{{$item->pivot->descripcion}}</span>
                            @endif
                        </td>
                        <td class="bordeInline f8C">{{$item->valueType->documentoTipo->name}}</td>
                        <td class="bordeInline f11C">{{$item->pivot->cantidad}}</td>
                        <td class="bordeR f11R">{{getForma($item->pivot->precio, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                        {{-- <td class="bordeInline f11C">{{$item->pivot->precio}}</td> --}}
                        <td class="bordeR f11R">{{getForma($item->pivot->total, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                        {{-- <td class="bordeInline f11C">{{$item->pivot->total}}</td> --}}
                        <td class="bordeR f11R">{{getForma($item->pivot->isv, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                        {{-- <td class="bordeInline f11C">{{$item->pivot->isv}}</td> --}}
                    </tr>
                    @php
                        $filas--;
                    @endphp
                @endforeach
                @while ($filas>0)
                    <tr>
                        <td class="celVacio bordeInline" colspan="7"></td>
                        <td class="celVacio bordeInline"></td>
                        <td class="celVacio bordeInline"></td>
                        <td class="celVacio bordeInline"></td>
                        <td class="celVacio bordeInline"></td>
                        <td class="celVacio bordeInline"></td>
                    </tr>
                    @php
                        $filas--;
                    @endphp
                @endwhile 
                <tr >
                    {{-- <td colspan="9" class="bordeInline bordeBootom"></td> --}}
                    <td class="celVacio bordeInline bordeBootom" colspan="7"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    {{-- <td colspan="5" class="bordes"></td>
                    <td colspan="3" class="titulo2 celdaGris bordes">TOTAL</td>
                    <td class="totales celdaGris bordes">{{$proforma->total}}</td> --}}
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="table2">
        <table class="table2 table-striped f8" >
            <tr>
                    <td colspan="6" rowspan="3" class="bordeInline bordeBootom"><p>ESTE DOCUMENTO NO ES UNA FACTURA. ES UNICAMENTE UNA PROFORMA PARA ESTIMACIÓN DE GASTOS Y REVISIÓN. FACTURA SERÁ EMITIDA AL MOMENTO DE FINALIZAR OPERACIÓN CONTRATADA. SUJETA A VARIACIONES EN CASO DE CAMBIOS EN TOTAL DE PAGOS A TERCEROS.</p></td>
                    <td colspan="2" class="f8R">IMPORTE GRAVADO 15%</td>
                    <td colspan="1" class="f11C">{{$moneda->name}}</td>
                    <td class="f11R">{{getForma($proforma->importe_gravado, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td class="bordeR"></td>
                    {{-- <td class="bordeR f11C">{{$proforma->importe_gravado}}</td> --}}
                </tr>
                <tr>
                    <td colspan="2" class="f8R">IMPORTE EXENTO:</td>
                    <td colspan="1" class="f11C">{{$moneda->name}}</td>
                    <td class="f11R">{{getForma($proforma->importe_exento, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td class="bordeR"></td>
                    {{-- <td class="bordeR f11C" >{{$proforma->importe_exento}}</td> --}}
                </tr>
                <tr>
                    <td colspan="2" class="bordeBootom f8R">DESCUENTOS</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="bordeBootom f11R">{{getForma($proforma->descuento, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                    {{-- <td class="bordeR bordeBootom f11C">{{$proforma->descuento}}</td> --}}
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom bordeL">Nº identificativo del registro de la SAG:</td>
                    <td colspan="3" class="bordeBootom bordeR">{{$proforma->embarque->no_sag}}</td>
                    <td colspan="2" class="bordeBootom f8R">IMPORTE EXONERADO</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="bordeBootom f11R">{{getForma($proforma->importe_exonerado, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                    {{-- <td class="bordeR bordeBootom f11C">{{$proforma->importe_exonerado}}</td> --}}
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom bordeL">Nº Correlativo de Orden de Compra Exenta:</td>
                    <td colspan="3" class="bordeBootom bordeR">{{$proforma->embarque->no_compra_externa}}</td>
                    {{-- <td colspan="2" class="bordeBootom bordeR">Siiiiiii</td> --}}
                    <td colspan="2" class="bordeBootom f8R">SUB TOTAL</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="bordeBootom f11R">{{getForma($proforma->sub_total, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                    {{-- <td class="bordeR bordeBootom f11C">{{$proforma->sub_total}}</td> --}}
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom bordeL">Nº Correlativo de constancia de registro exonerado:</td>
                    <td colspan="3" class="bordeBootom bordeR">{{$proforma->embarque->persona->name}}</td>
                    <td colspan="2" class="bordeBootom f8R">I.S.V. 15%	</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="bordeBootom f11R">{{getForma($proforma->isv, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                    {{-- <td class="bordeR bordeBootom f11C">{{$proforma->isv}}</td> --}}
                </tr>
                <tr>
                    <td colspan="6" class="bordeBootom bordeL f9"><p>TODO CHEQUE DEBE SER EMITIDO A NOMBRE DE:</p></td>
                    <td colspan="2" rowspan="2" class="bordeBootom bordeL f12BR">TOTAL A PAGAR</td>
                    <td colspan="1" rowspan="2" class="bordeBootom f12CB">{{$moneda->name}}</td>
                    <td rowspan="2" class="bordeBootom f12CB">{{getForma($proforma->total, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                    <td rowspan="2" class="bordeR bordeBootom"></td>
                    {{-- <td  rowspan="2" class="bordeBootom bordeR f12CB">{{$proforma->total}}</td> --}}
                </tr>
                <tr>
                    <td colspan="6" class="bordeBootom bordeL f10B"><p><b>{{$globShortCompanyName}} Y/O SINDY JOHANNA FONSECA HERNANDEZ</b></p></td>
                </tr>
                <tr>
                    <td colspan="6" class="bordeL">Cuentas Bancarias para Pago:</td>
                    <td colspan="2" class="bordeL f8R">VALOR EN LETRAS:</td>
                    <td colspan="3" class="bordeR"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL">BAC HONDURAS - Cuenta de cheques en USD:</td>
                    <td colspan="3" class="f10B">XXXXXX</td>
                    <td colspan="5" rowspan="2"  class="bordeBootom bordeInline f10CBI">TREINTA Y NUEVE MIL QUINIENTOS SETENTA Y CINCO LEMPIRAS CON 00/100 CTVS</td>
                    {{-- <td colspan="5" rowspan="2"  class="bordeBootom bordeInline f10CBI">{{number_words($proforma->total,"lempiras","y","centavos")}}</td> --}}
                </tr>
                <tr>
                    <td colspan="3" class="bordeL">BAC HONDURAS - Cuenta de cheques en HNL</td>
                    <td colspan="3" class="f10B">XXXXXX</td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL">FICOHSA - Cuenta de cheques en USD</td>
                    <td colspan="3" class="f10B" >XXXXXX</td>
                    <td colspan="2" rowspan="2" class="bordeL bordeBootom">CONVERSIÓN A TASA DEL DÍA:</td>
                    <td  colspan="1"  rowspan="2" class="bordeBootom">{{getMonedaConvert($moneda->name)}}</td>
                    <td   colspan="2" rowspan="2" class="bordeR bordeBootom" >{{getValMonedaConvert($proforma->total, $proforma->moneda->name,$moneda->name,$proforma->tc_usd)}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL bordeBootom">FICOHSA - Cuenta de cheques en HNL</td>
                    <td colspan="3" class="bordeBootom f10B">XXXXXX</td>
                </tr>
                <tr>
                    <td colspan="6" class="bordes">Favor indicar la referencia de Cobro al momento de realizar depósito/pago para una mejor relación en su Estado de Cuenta.</td>
                    <td colspan="5" class="bordes">Observaciones:  UNA VEZ EMITIDO EL DOCUMENTO FINAL DE COBRO, DEBE SER CANCELADO EN PLAZO ESTABLECIDO. CASO CONTRARIO SE APLICARÁ RECARGO POR MORA EQUIVALENTE AL 4% MENSUAL A PARTIR DE LA FECHA DE VENCIMIENTO.</td>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
        .create( document.querySelector( '#notas' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>
