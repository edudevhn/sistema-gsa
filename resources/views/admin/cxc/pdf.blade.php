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
            /* border: 1px solid #ccc; */
        }
        .table td {
            width: auto;
            font-size:11px;
            /* border: 1px solid #ccc; */
            
        }
        .footer {
            margin-top: 14px;
            text-align: right;
        }

        td {
            width: auto;
            overflow: hidden;
            padding: 6px !important;
        }
        .titulo{
            margin: 2px;
            text-align: left;
            font-weight: bold;
            font-size:14px;            
        }
        .tituloSecond{
            margin: 2px;
            text-align: center !important;
            font-weight: bold;
            font-size:16px;            
        }
        .titulo2{
            text-align: center;
            font-weight: bold;
            font-size:11px;
        }
        .titulo3{
            text-align: center !important;
            font-weight: bold;
            font-size:10px;
        }
        .titulo4R{
            text-align: right !important;
            font-size:6px;
        }
        .titulo4{
            text-align: center !important;
            font-size:6px;
        }
        .titulo5{
            text-align: center !important;
            font-size:6px;
            font-weight: bold;
        }
        .subTitulo{
            text-align: left;
            font-weight: bold;
            font-size:12px;
            padding: 6px !important;
        }
        .totales{
            text-align: right !important;
            font-weight: bold;
            font-size:10px;
        }
        .detalle{
            text-align: center !important;
            font-size:10px;
        }
        .bodyTable{
            text-align: left;
            font-size:10px;
        }
        .celdaGris{
            background-color: #B9B6B5;
        }
        
        .celVacio{
            padding: 7px !important;
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
    <div>
        <table class="table table-striped" >
            <thead >
                {{-- <tr class="titulo">
                    <th>a</th>
                    <th>b</th>
                    <th>c</th>
                    <th>d</th>
                    <th>e</th>
                    <th>f</th>
                    <th>g</th>
                    <th>h</th>
                    <th>i</th>
                    <th>j</th>
                    <th>k</th>
                    <th>l</th>
                </tr> --}}
                <tr class="titulo">
                    <th colspan="5">GRUPO SERVICIOS ADUANEROS (GSA)</th>
                    <th colspan="3" rowspan="4"><img src="{{$imagenBase64}}" width=150 height=100 class="data-dialog"></th>
                    <th colspan="4"></th>
                </tr>
                <tr >
                    <th class="titulo" colspan="5">RTN: 08011991010995</th>
                    <th class="totales">Fecha:</th>
                    <th class="titulo" colspan="3">{{$fechaInicio}}</th>
                </tr>
                <tr class="titulo">
                    <th colspan="5">RES. COSTA DEL SOL-V ETAPA, BLOQUE 22, LOTE 14 S.E.</th>
                    <th class="totales">Cod Cliente:</th>
                    <th colspan="3">{{$persona->rtn}}</th>
                </tr>
                <tr class="titulo">
                    <th colspan="5">SAN PEDRO SULA, HONDURAS | TEL: +504 2510-5668</th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="celVacio"></th>
                    <th colspan="4"  class="tituloSecond bordeBootom">ESTADO DE CUENTAS POR COBRAR</th>
                    <th colspan="4" class="celVacio"></th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <tr>
                    <td colspan="12"  class="celVacio"></td>
                </tr>
                <tr>
                    <td class="titulo4R">Cliente:</td>
                    <td colspan="4" class="subTitulo">{{$persona->name}}</td>
                    <td class="titulo4R">RTN:</td>
                    <td colspan="2" class="subTitulo">{{$persona->rtn}}</td>       
                    <td class="titulo4R">Término de Pago:</td>            
                    <td colspan="3" class="subTitulo">
                        {{$persona->terminoPago}}
                        @if ($persona->dias_pago)
                            {{$persona->dias_pago}} Días
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="celVacio"></td>
                </tr>
            </tbody> 
        </table>
    </div>
    <div class="table">
        <table class="table table-striped" >
            <thead>
                <tr >
                    <th colspan="2" class="titulo3 celdaGris bordes">Documento de Cobro</th>
                    <th class="titulo3 celdaGris bordes">Embarque No.</th>
                    <th class="titulo3 celdaGris bordes">Fecha de Emisión</th>
                    <th class="titulo3 celdaGris bordes">Fecha Vencimiento</th>
                    <th class="titulo3 celdaGris bordes">Valor USD</th>
                    <th class="titulo3 celdaGris bordes">Valor HNL</th>
                    <th class="titulo3 celdaGris bordes">Morosidad (Dias)</th>
                    <th class="titulo3 celdaGris bordes">Saldo en Mora USD</th>
                    <th class="titulo3 celdaGris bordes">Saldo en Mora HNL</th>
                    <th class="titulo3 celdaGris bordes">Saldo al Dia USD</th>
                    <th class="titulo3 celdaGris bordes">Saldo al Dia HNL</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                @php
                    $filas=14;
                    $total=0;
                    $totalPagado=0;
                @endphp
                @foreach ($documentosFiscales as $item)
                    <tr>
                        <td  colspan="2" class="bordeInline detalle">{{$item->numero_documento}}</td>
                        <td class="bordeInline detalle">{{$item->num_embarque}}</td>
                        <td class="bordeInline detalle">{{$item->fecha_emision}}</td>
                        <td class="bordeInline detalle">{{$item->fecha_vencimiento}}</td>
                        <td class="bordeInline detalle">{{$item->total}}</td>
                        <td class="bordeInline detalle">{{$item->total}}</td>
                        <td class="bordeInline detalle">{{$item->morocidad}}</td>
                        <td class="bordeInline totales">{{$item->total}}</td>
                        <td class="bordeInline totales">{{$item->total}}</td>
                        <td class="bordeInline totales">{{$item->pago_recibido}}</td>
                        <td class="bordeInline totales">{{$item->pago_recibido}}</td>
                    </tr>
                    @php
                        $total+=$item->total;
                        $totalPagado+=$item->pago_recibido;
                        $filas--;
                    @endphp
                @endforeach
                @while ($filas>0)
                    <tr>
                        <td  colspan="2" class="celVacio bordeInline" ></td>
                        <td class="celVacio bordeInline" ></td>
                        <td class="celVacio bordeInline" ></td>
                        <td class="celVacio bordeInline" ></td>
                        <td class="celVacio bordeInline" ></td>
                        <td class="celVacio bordeInline" ></td>
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
            </tbody>
            <tfoot>
                <tr class="footer">
                    
                    <td colspan="4" class="bordes celdaGris"></td>
                    <td colspan class="titulo2 celdaGris bordes">TOTAL</td>
                    <td class="totales celdaGris bordes">{{$total}}</td>
                    <td class="totales celdaGris bordes">{{$total}}</td>
                    <td class="totales celdaGris bordes"></td>
                    <td class="totales celdaGris bordes">{{$total}}</td>
                    <td class="totales celdaGris bordes">{{$total}}</td>
                    <td class="totales celdaGris bordes">{{$totalPagado}}</td>
                    <td class="totales celdaGris bordes">{{$totalPagado}}</td>
                </tr>
                <tr>
                    <td colspan="12" class="celVacio"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="table2">
        <table class="table2 table-striped" >
            <tbody class="bodyTable">
                <tr >
                    <td   colspan="5" class="titulo4 bordeInline bordeTop">
                        TODO CHEQUE DEBE SER EMITIDO A NOMBRE DE:         
                    </td>
                    <td  class="titulo5" colspan="5">
                        FAVOR ENVIAR SUS COMPROBANTES DE PAGO A LOS SIGUIENTES CORREOS:        
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td  class="titulo5 bordeInline" colspan="5">
                        SINDY JOHANNA FONSECA HERNANDEZ / GRUPO SERVICIOS ADUANEROS (GSA)      
                    </td>
                    <td  class="titulo4" colspan="5">
                        1) contabilidad@gsaduanera.com      
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td  class="titulo4 bordeInline" colspan="5" >
                        CUENTAS BANCARIAS PARA PAGO NACIONAL: 
                    </td>
                    <td  class="titulo4" colspan="5">
                        2) sindy.fonseca@gsaduanera.com   
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td  class="titulo4 bordeL " colspan="3">
                        BAC HONDURAS - Cuenta de Ahorros en USD
                    </td>
                    <td  class="titulo4 bordeR" colspan="2">
                        744-797-221
                    </td>
                    <td colspan="7"></td>
                </tr>                
                <tr>
                    <td class="titulo4 bordeL"  colspan="3">
                        BAC HONDURAS - Cuenta de  Ahorros en HNL
                    </td>
                    <td  class="titulo4 bordeR" colspan="2">
                        730-410-301
                    </td>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td  class="titulo4 bordeL" colspan="3">
                        BANCO FICOHSA - Cuenta de Cheques en HNL
                    </td>
                    <td  class="titulo4 bordeR"  colspan="2">
                        20-0010-733177
                    </td>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td class="titulo4 bordeInline" colspan="5">
                        BENEFICIARIO DE LA CUENTA:
                    </td>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td class="titulo5 bordeInline bordeBootom" colspan="5">
                        SINDY JOHANNA FONSECA HERNANDEZ / GRUPO SERVICIOS ADUANEROS (GSA)
                    </td>
                    <td colspan="7"></td>
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
