<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Recibo</title>
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
            margin: 10mm;
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
            /* border: 1px solid #ccc; */
        }
        .table td {
            width: auto;
            font-size:11px;
            /* border: 1px solid #ccc; */
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
            padding: 12px !important;
            
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
        .f10BC{
            font-weight: bold !important;
            text-align: center !important;
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
        .f11BC{
            font-weight: bold !important;
            text-align: center !important;
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
        .f48CB{
            text-align: center !important;
            font-weight: bold !important;
            font-size:48px !important;
        }
        .f11BR{
            text-align: right !important;
            font-weight: bold !important;
            font-size:11px !important;
        }
        .f11BL{
            text-align: left;
            font-weight: bold;
            font-size:11px;
            padding: 6px !important;
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
        .f12R{
            text-align: right !important;
            font-size:12px !important;
        }
        .f13CB{
            text-align: center !important;
            font-weight: bold !important;
            font-size:13px !important;
        }
        .f16B{
            font-weight: bold !important;
            font-size:19px !important;
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
                <tr>
                    <th colspan="7" ><img src="{{$imagenBase64}}" width=150 height=100 class="data-dialog"></th>
                    <th colspan="3" class="f48CB" >RECIBO</th>
                </tr>
                <tr class="subTitulo bordeTop">
                    
                    <th colspan="10">{{$globCompanyName}}</th>
                </tr>
                <tr class="f11BL">
                    <th colspan="2">RTN: {{$globCompanyRTN}}</th>
                    <th colspan="8">{{$globCompanyAddress}}</th>
                </tr>
                <tr class="f11BL bordeBootom">
                    <th colspan="10">{{$globCompanyCity}}, {{$globCompanyCountry}} | TEL: {{$globCompanyPhone}} | {{$globCompanyEmail}} </th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <tr>
                    <td colspan="10"></td>
                </tr>
                <tr>
                    <td  rowspan="2"  class="f10R bordeBootom" > Recibimos de:</td>
                    <td colspan="6" rowspan="2" class="f16B bordeBootom">{{$pago->persona->name}}</td>
                    <td  class="f10R">Fecha:</td>
                    <td colspan="2" class="f10CB">{{$pago->fecha}}</td>
                </tr>
                <tr>
                    <td  class="f10R bordeBootom">N.º de Recibo:</td>
                    <td colspan="2" class="f10CB bordeBootom">{{$pago->num_documento}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class="tableDet">
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th class="f10BC" colspan="2">Método de pago</th>
                    <th class="f11BC" colspan="3">{{$pago->metodoPago->name}}</th>
                    <th class="f10BC" colspan="2">Referencia de Pago</th>
                    <th class="f11BC" colspan="3">{{$pago->referencia}}</th>
                    <th class="f10BC" colspan="2">Banco</th>
                    <th class="f11BC" colspan="3">{{$pago->banco->name}}</th>
                    {{-- <th class="f10BC" colspan="2">Banco</th>
                    <th class="f10BC" colspan="2">Fecha de Pago</th> --}}
                </tr>
                <tr>
                    <th class="f10BC" colspan="2">Fecha de Pago</th>
                    <th class="f11BC" colspan="3">{{$pago->fecha_pago}}</th>
                    <th class="f10BC" colspan="2" >Constancia de Rentencion No.</th>
                    <th class="f11BC" colspan="3">{{$pago->constancia_retencion}}</th>
                </tr>
            </thead>
            {{-- <tbody class="bodyTable">
                <tr>
                    <td class="f11BC bordes" colspan="2">{{$pago->metodo_pago}}</td>
                    <td class="f11BC bordes" colspan="2">{{$pago->num_cheque}}</td>
                    <td class="f11BC bordes" colspan="2">{{$pago->referencia}}</td>
                    <td class="f11BC bordes" colspan="2">{{$pago->banco->name}}</td>
                    <td class="f11BC bordes" colspan="2">{{$pago->fecha_pago}}</td>
                </tr>
            </tbody> --}}
        </table>
    </div>
    <br><br>
    <div class="tableDet">
        <table class="table table-striped" >
            <thead>
                <tr class="celdaGris">
                    <th class="f10BC bordes" colspan="2">Concepto</th>
                    {{-- <th class="f10BC bordes" colspan="2">Descripcion</th> --}}
                    <th class="f10BC bordes" >Moneda</th>
                    <th class="f10BC bordes" colspan="4">Cliente</th>
                    <th class="f10BC bordes" colspan="2">Valor Facturado</th>
                    <th class="f10BC bordes" colspan="2">Pago Recibido</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                
                @php
                    $filas=6;
                @endphp
                <tr>
                    <td class="f11BC bordes" colspan="2">PAGO {{$pago->documentoFiscal->documentoTipo->slug}}: {{$pago->documentoFiscal->numero_documento}}
                        {{-- <td class="f11BC bordes" >{{$pago->moneda->name}}</td> --}}
                    {{-- <td class="f11BC bordes" colspan="2">{{$pago->descripcion}}</td> --}}
                    <td class="f11BC bordes" >{{$moneda->name}}</td>
                    <td class="f11BC bordes" colspan="4">{{$pago->documentoFiscal->embarque->persona->name}}</td>
                    <td class="f11BC bordes" colspan="2">{{$moneda->name}}
                        {{getForma($pago->documentoFiscal->total, $pago->moneda->name,$moneda->name,$pago->documentoFiscal->documentoFiscalDetalles->tc_usd)}}
                    </td>
                    {{-- <td class="f11BC bordes" colspan="2">{{$moneda->name}}
                        {{$pago->documentoFiscal->total}}</td> --}}
                    <td class="f11BR bordes" colspan="2">{{$moneda->name}} 
                        {{getForma($pago->pago_recibido, $pago->moneda->name,$moneda->name,$pago->documentoFiscal->documentoFiscalDetalles->tc_usd)}}
                    </td>
                    {{-- <td class="f11BR bordes" >{{$moneda->name}} {{$pago->pago_recibido}}</td> --}}
                </tr>
                @php
                    $filas--;
                @endphp
                @while ($filas>0)
                    <tr>
                        <td class="celVacio bordes" colspan="2"></td>
                        {{-- <td class="celVacio bordes" colspan="2"></td> --}}
                        <td class="celVacio bordes"></td>
                        <td class="celVacio bordes" colspan="4"></td>
                        <td class="celVacio bordes" colspan="2"></td>
                        <td class="celVacio bordes" colspan="2"></td>
                    </tr>
                    @php
                        $filas--;
                    @endphp
                @endwhile
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" class=""></td>
                    <td colspan="2" class="f12R">Valor Facturado:</td>
                    {{-- <td class="f12BR bordes">{{$moneda->name}} {{$pago->documentoFiscal->total}}</td> --}}
                    <td class="f12BR bordes" colspan="2">{{$moneda->name}} 
                        {{getForma($pago->documentoFiscal->total, $pago->moneda->name,$moneda->name,$pago->documentoFiscal->documentoFiscalDetalles->tc_usd)}}
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class=""></td>
                    <td colspan="2" class="f12R">Pago Recibido:</td>
                    {{-- <td class="f12BR bordes">{{$moneda->name}} {{$pago->pago_recibido}}</td> --}}
                    <td class="f12BR bordes" colspan="2">{{$moneda->name}} 
                        {{-- {{$pago->pago_recibido}} --}}
                        {{getForma($pago->pago_recibido, $pago->moneda->name,$moneda->name,$pago->documentoFiscal->documentoFiscalDetalles->tc_usd)}}
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class=""></td>
                    <td colspan="2" class="f12R">Valor (%) Retencion:</td>
                    {{-- <td class="f12BR bordes">{{$moneda->name}} {{$pago->pago_recibido}}</td> --}}
                    <td class="f12BR bordes" colspan="2">{{$moneda->name}}
                        {{getForma($pago->pago_recibido, $pago->moneda->name,$moneda->name,$pago->documentoFiscal->documentoFiscalDetalles->tc_usd)}}
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class=""></td>
                    <td colspan="2" class="f12BR">Total Pago Aplicado:</td>
                    {{-- <td class="f12BR bordes celdaGris">{{$moneda->name}} {{$pago->pago_recibido}}</td> --}}
                    <td class="f12BR bordes celdaGris" colspan="2">{{$moneda->name}}
                        {{getForma($pago->pago_recibido, $pago->moneda->name,$moneda->name,$pago->documentoFiscal->documentoFiscalDetalles->tc_usd)}}
                    </td>
                </tr>
            </tfoot>
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
