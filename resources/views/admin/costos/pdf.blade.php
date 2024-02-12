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
            word-break: break-all !important;
            white-space: nowrap !important;
        }
        .table th {
            padding: 4px;
            border: 1px solid #ccc;
        }
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .footer {
            margin-top: 12px;
            text-align: right;
        }
        th, td {
            max-width: 100px; /* Puedes ajustar el ancho máximo de la celda */
        }

        td {
            white-space: nowrap;
            overflow: hidden;
        }
        .titulo{
            text-align: center;
            font-weight: bold;
            font-size:12px;
        }
        
        .f20BL{
            margin: 2px !important;
            text-align: left !important;
            font-weight: bold !important;
            font-size:20px !important;            
        }
        .titulo2{
            text-align: center;
            font-weight: bold;
            font-size:10px;
        }
        .subTitulo{
            text-align: left;
            font-weight: bold;
            font-size:10px;
        }
        .bodyTable{
            text-align: left;
            font-size:10px;
        }
        .celdaGris{
            background-color: #B9B6B5;
        }
    </style>
  </head>
  <body>
    <div>
        
        <table class="table table-striped" >
            <thead >
                <tr class="titulo">
                    <th colspan="7" rowspan="2"><img src="{{$imagenBase64}}" width=150 height=100 class="data-dialog"></th>
                    <th colspan="2" rowspan="2" style="font-size: 16">RECIBO</th>
                </tr>
                <tr></tr>
                <tr class="subTitulo">
                    <th colspan="9" class="f20BL">{{$globCompanyName}}</th>
                </tr>
                <tr class="subTitulo">
                    <th colspan="2">RTN: {{$globCompanyRTN}}</th>
                    <th colspan="4">{{$globCompanyAddress}}</th>
                    <th colspan="3">{{$globCompanyCity}}, {{$globCompanyCountry}} | TEL: {{$globCompanyPhone}}</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <tr>
                    <td colspan="9"></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="2" >Recibimos de:</td>
                    <td colspan="4" rowspan="2" class="subTitulo">Nombre Cliente</td>
                    <td  >Fecha</td>
                    <td colspan="2" class="subTitulo">{{$pago->fecha}}</td>
                </tr>
                <tr>
                    <td  >N.º de Recibo:</td>
                    <td colspan="2" class="subTitulo">{{$pago->num_documento}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class="table">
        <table class="table table-striped" >
            <thead>
                <tr class="titulo2 celdaGris">
                    <th colspan="2">Método de pago</th>
                    <th colspan="2">N.º de cheque</th>
                    <th colspan="2">Referencia de Pago</th>
                    <th colspan="2">Banco</th>
                    <th>Fecha de Pago</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                <tr>
                    <td colspan="2">{{$pago->metodo_pago}}</td>
                    <td colspan="2">{{$pago->num_cheque}}</td>
                    <td colspan="2">{{$pago->referencia}}</td>
                    <td colspan="2">{{$pago->banco->name}}</td>
                    <td>{{$pago->fecha_pago}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <br><br>
    <div class="table">
        <table class="table table-striped" >
            <thead>
                <tr class="titulo2 celdaGris">
                    <th colspan="2">Descripcion</th>
                    <th >Moneda</th>
                    <th colspan="2">Concepto</th>
                    <th colspan="2">Cliente</th>
                    <th >Pago Recibido</th>
                    <th>Valor Facturado</th>
                </tr>
            </thead>
            <tbody class="bodyTable">
                
                @php
                    $filas=7;
                @endphp
                <tr>
                    <td colspan="2">{{$pago->descripcion}}</td>
                    <td >{{$pago->moneda->name}}</td>
                    <td colspan="2">{{$pago->referencia}}
                    <td colspan="2">{{$pago->referencia}}
                        {{-- @foreach ($pago->factura->documentosRangos as $documento)
                            {{$documento->documentoTipo->slug}}: {{$documento->pivot->numero_documento}}
                            <br>
                        @endforeach --}}
                    </td>
                    <td >{{$pago->factura}}</td>
                    {{-- <td >{{$pago->factura}}</td> --}}
                    <td>{{$pago->pago_recibido}}</td>
                </tr>
                @php
                    $filas--;
                @endphp
                @while ($filas>0)
                    <tr>
                        <td colspan="2"></td>
                        <td ></td>
                        <td colspan="2"></td>
                        <td colspan="2"> </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                        $filas--;
                    @endphp
                @endwhile 
                <tr class="footer">
                    <td colspan="5"></td>
                    <td colspan="3" class="titulo2">TOTAL</td>
                    <td class="titulo2">{{$pago->pago_recibido}}</td>
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
  </body>
</html>
