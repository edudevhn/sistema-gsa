<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>{{$documentoFiscal->documentoTipo->name}}</title>
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
                <tr class="titulo">
                    <th colspan="7">{{$globCompanyName}}</th>
                    <th colspan="2" rowspan="4"><img src="{{$imagenBase64}}" width=150 height=100 class="data-dialog"></th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="7">RTN: {{$globCompanyRTN}}</th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="7">{{$globCompanyAddress}}</th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="7">{{$globCompanyCity}}, {{$globCompanyCountry}} | TEL: {{$globCompanyPhone}}</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <tr>
                    <td colspan="9"></td>
                </tr>
                <tr>
                    <td colspan="2" class="f10R">FECHA EMISION</td>
                    <td colspan="2" class="bordes f11CB">{{$documentoFiscal->documentoFiscalDetalles->fecha_emision}}</td>
                    <td colspan="2" ></td>
                    <td colspan="3" class="f12CB bordeInline bordeTop">{{$documentoFiscal->documentoTipo->name}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="f10R">FECHA VENCIMIENTO</td>
                    <td colspan="2" class="bordes f11CB">{{$documentoFiscal->documentoFiscalDetalles->fecha_vencimiento}}</td>
                    <td colspan="2" ></td>
                    <td colspan="3" class="f12CB bordeInline">No. {{$documentoFiscal->numero_documento}}</td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td colspan="3" class="f13CB bordes">ORIGINAL</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="2" class="bordeInline bordeTop f12">FACTURA A:</td>
                    <td colspan="3" class="f9R bordeTop">Embarcador:</td>
                    <td colspan="2" class="bordeTop bordeR f9B">{{$documentoFiscal->embarque->embarcador}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f9R">Consignatario:</td>
                    <td colspan="2" class="bordeR f9B" >{{$documentoFiscal->embarque->consignatario}}</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="2" class="bordeInline f12B">{{$documentoFiscal->embarque->persona->name}}</td>
                    <td colspan="3" class="f9R">Lugar Embarque:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->lugarEmbarque->name}}</td>
                </tr>               
                <tr>
                    <td colspan="3" class="f9R">Lugar Desembarque:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->lugarEntrega->name}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="bordeInline f12">RTN No:</td>
                    <td colspan="3" class="f9R">No. Booking / Master Doc:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->no_booking}}</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" class="bordeInline f12B">{{$documentoFiscal->embarque->persona->rtn}}</td>
                    <td colspan="3" class="f9R">No. Documento Transporte:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->no_documento_transporte}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f9R">Detalle de Carga:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->peso}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f9R">Equipo:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->equipo}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="bordeInline f12">DIRECCION FISCAL:</td>
                    <td colspan="3" class="f9R">Aduana de Ingreso/Salida:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->aduana->name}}</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" class="bordeInline bordeBootom f12B">{{$documentoFiscal->embarque->persona->direccion}}</td>
                    <td colspan="3" class="f9R">Destino final:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->lugarEntrega->name}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f9R">Numero de Embarque:</td>
                    <td colspan="2" class="bordeR f9B">{{$documentoFiscal->embarque->num_embarque}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="f9R bordeBootom">DUCA/Poliza No.:</td>
                    <td colspan="2" class="bordeR f9B bordeBootom">{{$documentoFiscal->documentoFiscalDetalles->duca}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tableDet">
        <table class="tableDet table-striped" >
            <thead>
                <tr class="titulo2 celdaGris">
                    <th class="f9CB celdaGris bordes" colspan="7">CONCEPTO / DESCRIPCIÓN</th>
                    <th class="f9CB celdaGris bordes">UNIDAD</th>
                    <th class="f9CB celdaGris bordes">CANTIDAD</th>
                    <th class="f9CB celdaGris bordes">PRECIO UNITARIO.</th>
                    <th class="f9CB celdaGris bordes">VALOR TOTAL.</th>
                    <th class="f9CB celdaGris bordes">% ISV.</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                {{$documentoFiscal->documentoFiscalDetalles->moneda}}
                @php
                    $filas=15;
                    @endphp
                @foreach ($documentoFiscal->servicios as $item)
                    {{-- @if ($item->valueType->documentoTipo->name==$documentoFiscal->name) --}}
                        <tr>
                            <td class="bordeInline f11" colspan="7">
                                {{$item->name}}<br>
                                @if ($item->pivot->descripcion)
                                    <span class="f11B">{{$item->pivot->descripcion}}</span>
                                @endif
                            </td>
                            <td class="bordeInline f8C">UNIDAD</td>
                            <td class="bordeInline f11C">{{$item->pivot->cantidad}}</td>
                            <td class="bordeInline f11R">{{getForma($item->pivot->precio,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                            <td class="bordeInline f11R">{{getForma($item->pivot->total,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                            <td class="bordeInline f11R">{{getForma($item->pivot->isv,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                        </tr>
                        @php
                            $filas--;
                        @endphp
                    {{-- @endif --}}
                @endforeach
                @while ($filas>0)
                <tr>
                    <td class="celVacio bordeInline"  colspan="7"></td>
                    <td class="celVacio bordeInline" ></td>
                    <td class="celVacio bordeInline" ></td>
                    <td class="celVacio bordeInline" ></td>
                    <td class="celVacio bordeInline" ></td>
                    <td class="celVacio bordeInline" ></td>
                </tr>
                @php
                        $filas--;
                        @endphp
                @endwhile
                <tr>
                    <td class="celVacio bordeInline bordeBootom" colspan="7"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                    <td class="celVacio bordeInline bordeBootom"></td>
                </tr> 
            </tbody>
        </table>
    </div>
    <div class="table2">
        <table class="table2 table-striped f8" >
                <tr>
                    <td colspan="6" class="bordeInline bordeBootom"><p>CAI: {{$documentoFiscal->rangoDocumento->numero_cai}}</p></td>
                    <td colspan="2" class="f8R">IMPORTE GRAVADO 15%</td>
                    <td colspan="1" class="f11C">{{$moneda->name}}</td>
                    @if ($documentoFiscal->documentoTipo->slug=='F')
                        <td class="f11R">{{getForma($documentoFiscal->documentoFiscalDetalles->importe_gravado,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    @else
                        <td class="f11R">{{getForma(0,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    @endif
                    <td class="bordeR"></td>
                </tr>
                <tr>
                    <td colspan="6" class="bordeInline"><p>RANGO AUTORIZADO: {{$documentoFiscal->rangoDocumento->numero_inicial}} Al {{$documentoFiscal->rangoDocumento->numero_final}}</p></td>
                    <td colspan="2" class="f8R">IMPORTE EXENTO:</td>
                    <td colspan="1" class="f11C">{{$moneda->name}}</td>
                    @if ($documentoFiscal->documentoTipo->slug=='F')
                        <td class="f11R">{{getForma(0,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    @else
                        <td class="f11R">{{getForma($documentoFiscal->documentoFiscalDetalles->importe_exento,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    @endif
                    <td class="bordeR"></td>
                </tr>
                <tr>
                    <td colspan="6" class="bordeInline"><p>FECHA LIMITE DE EMISION: {{$documentoFiscal->rangoDocumento->fecha_limite_emision}} Al {{$documentoFiscal->rangoDocumento->numero_final}}</p></td>
                    <td colspan="2" class="bordeBootom f8R">DESCUENTOS</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="bordeBootom f11R">{{getForma($documentoFiscal->documentoFiscalDetalles->descuento,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom bordeL">Nº identificativo del registro de la SAG:</td>
                    <td colspan="3" class="bordeBootom bordeR">{{$documentoFiscal->embarque->persona->no_sag}}</td>
                    <td colspan="2" class="bordeBootom f8R">IMPORTE EXONERADO</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="bordeBootom f11R">{{getForma($documentoFiscal->embarque->importe_exonerado,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom bordeL" >Nº Correlativo de Orden de Compra Exenta:</td>
                    <td colspan="3" class="bordeBootom bordeR">{{$documentoFiscal->embarque->no_compra_externa}}</td>
                    <td colspan="2" class="bordeBootom f8R">SUB TOTAL</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="f11R bordeBootom">{{getForma($documentoFiscal->sub_total,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom bordeL">Nº Correlativo de constancia de registro exonerado:</td>
                    <td colspan="3" class="bordeBootom bordeR">{{$documentoFiscal->embarque->persona->name}}</td>
                    <td colspan="2" class="bordeBootom f8R">I.S.V. 15%	</td>
                    <td colspan="1" class="bordeBootom f11C">{{$moneda->name}}</td>
                    <td class="f11R bordeBootom">{{getForma($documentoFiscal->isv,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    <td class="bordeR bordeBootom"></td>
                </tr>
                <tr>
                    <td colspan="6" class="bordeBootom bordeL"><p>TODO CHEQUE DEBE SER EMITIDO A NOMBRE DE:</p></td>
                    <td colspan="2" rowspan="2" class="bordeBootom bordeL f12BR">TOTAL A PAGAR</td>
                    <td colspan="1" rowspan="2" class="bordeBootom f12CB">{{$moneda->name}}</td>
                    <td  rowspan="2" class="bordeBootom f12CB">{{getForma($documentoFiscal->total,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                    <td rowspan="2" class="bordeR bordeBootom"></td>
                </tr>
                <tr>
                    <td colspan="6" class="bordeBootom bordeL f10B"><p><b>{{$globShortCompanyName}} Y/O SINDY JOHANNA FONSECA HERNANDEZ</b></p></td>
                </tr>
                <tr>
                    <td colspan="6" class="bordeL">Cuentas Bancarias para Pago:</td>
                    <td colspan="2" class="bordeL f8R" f8R>VALOR EN LETRAS:</td>
                    <td colspan="3" class="bordeR"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL">BAC HONDURAS - Cuenta de cheques en USD:</td>
                    <td colspan="3" class="f10B">XXXXXX</td>
                    <td colspan="5" rowspan="2"  class="bordeBootom bordeInline f10CBI">TREINTA Y NUEVE MIL QUINIENTOS SETENTA Y CINCO LEMPIRAS CON 00/100 CTVS</td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL">BAC HONDURAS - Cuenta de cheques en HNL</td>
                    <td colspan="3" class="f10B">XXXXXX</td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL">FICOHSA - Cuenta de cheques en USD</td>
                    <td colspan="3" class="f10B">XXXXXX</td>
                    <td colspan="2" rowspan="2" class="bordeL bordeBootom">CONVERSIÓN A TASA DEL DÍA:</td>
                    <td  colspan="1"  rowspan="2" class="bordeBootom">{{getMonedaConvert($moneda->name)}}</td>
                    <td  colspan="2" rowspan="2" class="bordeR bordeBootom">{{getValMonedaConvert($documentoFiscal->total,$documentoFiscal->documentoFiscalDetalles->moneda->name,$moneda->name,$documentoFiscal->documentoFiscalDetalles->tc_usd)}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeL bordeBootom" >FICOHSA - Cuenta de cheques en HNL</td>
                    <td colspan="3" class="bordeBootom f10B">XXXXXX</td>
                </tr>
                <tr>
                    <td colspan="6" class="bordes">Favor indicar la referencia de Cobro al momento de realizar depósito/pago para una mejor relación en su Estado de Cuenta.</td>
                    <td colspan="5" class="bordes">Observaciones:  UNA VEZ EMITIDO EL DOCUMENTO FINAL DE COBRO, DEBE SER CANCELADO EN PLAZO ESTABLECIDO. CASO CONTRARIO SE APLICARÁ RECARGO POR MORA EQUIVALENTE AL 4% MENSUAL A PARTIR DE LA FECHA DE VENCIMIENTO.</td>
                </tr>
            </tbody>
        </table>
    </div>
     {{-- documentoTipo
rangoDocumento
documentoFiscalDetalles
embarque
servicios --}}


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
