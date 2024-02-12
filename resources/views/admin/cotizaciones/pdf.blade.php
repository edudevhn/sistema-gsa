<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cotización</title>
    <style>       
        body {
            font-family: Arial, sans-serif;
            margin: 0mm;
        }
        footer {
            font-family: Arial, sans-serif;
            margin: 0mm;
            margin-top: 14px;
            text-align: right;
        }
         /* Agregar un borde alrededor de la página */
        @page {
            border: 1px solid black;
            margin: 5mm;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
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
        }
        .table td {
            width: auto;
            font-size:11px;
        }
        td {
            width: auto;
            overflow: hidden;
            /* border: 1px solid #ccc; */
        }
        .tableDet {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            /* border: 1px solid #ccc; */
            /* word-break: break-all !important;
            white-space: nowrap !important; */
        }
        .tableDet th {
            text-align: left;
            /* border: 1px solid #ccc; */
        }
        .tableDet td {
            width: auto;
            font-size:11px;
            padding: 4px !important;
            
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
            font-size:7px;
            /* border: 1px solid #ccc;  */
        }
        .titulo{
            margin: 2px !important;
            text-align: left !important;
            font-weight: bold !important;
            font-size:24px !important;            
        }
        .f20BL{
            margin: 2px !important;
            text-align: left !important;
            font-weight: bold !important;
            font-size:20px !important;            
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
        .f10BR{
            text-align: right !important;
            font-weight: bold !important;
            font-size:10px !important;
        }
        .f10BI{
            font-weight: bold !important;
            font-size:10px !important;
            font-style: italic !important;
        }
        .f10I{
            font-size:10px !important;
            font-style: italic !important;
        }
        .f10C{
            text-align: center !important;
            font-size:10px !important;
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
        .f11R{
            text-align: right !important;
            font-size:11px !important;
        }
        .f11BR{
            text-align: right !important;
            font-weight: bold !important;
            font-size:11px !important;
        }
        .f11B{
            font-weight: bold !important;
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
        .f14B{
            font-weight: bold !important;
            font-size:14px !important;
        }
        .f14BR{
            text-align: right !important;
            font-weight: bold;
            font-size:14px;
        }
        .bodyTable{
            text-align: left;
            font-size:10px;
        }
        .celdaGris{
            background-color: #B9B6B5;
        }
        
        .celVacio{
            padding: 5px !important;
        }
        .bordes{
            border: 1px solid #0a0a0a;
        }
        .bordeBootom{
            border-bottom: 1px solid #0a0a0a;
        }
        .bordeInline{
            border-left: 1px solid #0a0a0a;
            border-right: 1px solid #0a0a0a;
        }
        .bordeTop{
            border-top: 1px solid #0a0a0a;
        }
        .bordeL{
            border-left: 1px solid #0a0a0a;
        }
        .bordeR{
            border-right: 1px solid #0a0a0a;
        }
    </style>
  </head>
  <body>
    @php
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
                    <th colspan="2" rowspan="4"><img src="{{$imagenBase64}}" width=150 height=100 class="data-dialog"></th>
                    <th colspan="7" class="f20BL">{{$globCompanyName}}</th>
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
                    <td colspan="9" class="celVacio"></td>
                </tr>
                <tr>
                    <td colspan="2" class="f11B celdaGris bordes">COTIZACION No.:</td>
                    <td colspan="2" class="f11CB bordes" >{{$cotizacione->num_documento}}</td>
                    <td colspan="2" ></td>
                    <td class="f11R">Fecha:</td>
                    <td colspan="2" class="f11CB bordes">{{$cotizacione->fecha}}</td>
                </tr>
                <tr>
                    <td colspan="9" class="celVacio"></td>
                </tr>
                <tr>
                    <td  class="f11R" >Cliente</td>
                    <td colspan="4" class="f14B bordeBootom">{{$cotizacione->persona->name}}</td>
                    <td ></td>
                    <td class="f11R">RTN No:</td>
                    <td colspan="2" class="f11CB bordeBootom">{{$cotizacione->persona->rtn}}</td>
                </tr>
                <tr>
                    <td class="f11R">Dirección:</td>
                    <td colspan="4" class="f11B bordeBootom bordeBootom">{{$cotizacione->persona->direccion}}</td>
                    <td></td>
                    <td class="f11R">Contacto:</td>
                    <td colspan="2" class="f11CB bordeBootom">{{$cotizacione->persona->email}}</td>
                </tr>
                <tr>
                    <td colspan="9" class="celVacio"></td>
                </tr>
                <tr>
                    <td colspan="9" class="f11CB celdaGris bordes">DETALLES DE EMBARQUE</td>
                </tr>
                <tr class="bordeInline">
                    <td class="f11R">Mercancía:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->mercancia->name}}</td>
                    <td></td>
                    <td class="f11R">Incoterms:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->mercancia->name}}</td>
                </tr>
                <tr class="bordeInline">
                    <td class="f11R">Servicio:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->tipoServicio->name}}</td>
                    <td colspan="2" class="f11R">Lugar de Embarque:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->lugarEmbarque->name}}</td>
                </tr>
                <tr class="bordeInline">
                    <td class="f11R">Aduana:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->aduana->name}}</td>
                    <td colspan="2" class="f11R">Lugar de Entrega:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->lugarEntrega->name}}</td>
                </tr>
                <tr class="bordeInline">
                    <td class="f11R">Término Pago:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->terminoPago->name}}</td>
                    <td colspan="2" class="f11R">Modalidad de Transporte:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->modalidad->name}}</td>
                </tr>
                <tr class="bordeInline">
                    <td class="f11R">Referencia No.:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->num_referencia}}</td>
                    <td></td>
                    <td class="f11R">Valido a fecha:</td>
                    <td colspan="3" class="f11CB bordeBootom">{{$cotizacione->fecha_valida}}</td>
                </tr>
                <tr class="bordeInline">
                    <td colspan="9" class="celVacio"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tableDet">
        <table class="tableDet table-striped" >
            <thead>
                <tr >
                    <th class="f10CB celdaGris bordes" colspan="5">DESCRIPCIÓN DE SERVICIOS</th>
                    <th class="f10CB celdaGris bordes">CANT.</th>
                    <th colspan="2" class="f10CB celdaGris bordes">PRECIO UNITARIO.</th>
                    <th colspan="2" class="f10CB celdaGris bordes">15% ISV.</th>
                    <th colspan="2" class="f10CB celdaGris bordes">SUB TOTAL.</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                @php
                    $filas=17;
                @endphp
                @foreach ($cotizacione->servicios as $item)
                    <tr>
                        <td class="bordeInline" colspan="5">
                            <span class="f10B">{{$item->name}}</span><br>
                            @if ($item->pivot->descripcion)
                               <span class="f10I"> {{$item->pivot->descripcion}}</a>
                            @endif
                        </td>
                        <td class="bordeInline f11C">{{$item->pivot->cantidad}}</td>
                        <td class="f11R">{{$moneda->name}}</td>
                        <td class="bordeR f11BR">{{getForma($item->pivot->precio, $cotizacione->moneda->name,$moneda->name,$cotizacione->tc_usd)}}</td>
                        <td class="f11R">{{$moneda->name}}</td>
                        <td class="bordeR f11BR">{{getForma($item->pivot->isv, $cotizacione->moneda->name,$moneda->name,$cotizacione->tc_usd)}}</td>
                        <td class="f11BR">{{$moneda->name}}</td>
                        <td class="bordeR f11BR">{{getForma($item->pivot->total, $cotizacione->moneda->name,$moneda->name,$cotizacione->tc_usd)}}</td>
                    </tr>
                    @php
                        $filas--;
                    @endphp
                @endforeach
                @while ($filas>0)
                    <tr>
                        <td class="celVacio bordeInline" colspan="5"></td>
                        <td class="celVacio bordeInline" ></td>
                        <td class="celVacio" ></td>
                        <td class="celVacio bordeR" ></td>
                        <td class="celVacio" ></td>
                        <td class="celVacio bordeR" ></td>
                        <td class="celVacio" ></td>
                        <td class="celVacio bordeR" ></td>
                    </tr>
                    @php
                        $filas--;
                    @endphp
                @endwhile
            </tbody>
            <tfoot >
                <tr>
                    <td colspan="5" class="bordes"></td>
                    <td colspan="5" class="f14BR celdaGris bordes">TOTAL</td>
                    <td  class="f14BR celdaGris bordeBootom bordeTop">{{$moneda->name}}</td>
                    <td  class="f14BR celdaGris bordeR bordeBootom bordeTop">
                        {{getForma($cotizacione->total, $cotizacione->moneda->name,$moneda->name,$cotizacione->tc_usd)}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    {{-- <p> {{number_format($total, 2, '.', ' ');}}</p> --}}
    <div>
        <table class="table table-striped" >
            <tbody class="bodyTable">
                <tr>
                    <td colspan="9" class="bordes f9">
                       <p class="f10BI">NOTES:</p> 
                       {!! htmlspecialchars_decode($cotizacione->notas) !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="9">Siempre estamos disponibles para atender cualquier consulta adicional.</td>
                </tr>
                <tr>
                    <td colspan="9" class="celVacio"></td>
                </tr>
                <tr >
                    <td colspan="9">Muchas gracias por su preferencia en nuestros servicios.</td>
                </tr>
                <tr>
                    <td colspan="9" class="celVacio"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bordeBootom f11B">{{$globShortCompanyName}}</td>
                    <td class="f11R">Contact Email:</td>
                    <td colspan="2" class="bordeBootom f11B">{{$globCompanyEmail}}</td>
                    <td class="f11R">Phone No.:</td>
                    <td colspan="2" class="bordeBootom f11B">{{$globCompanyCellPhone}}</td>
                </tr>
            </tbody>
        </table>
    </div>
  </body>
</html>
