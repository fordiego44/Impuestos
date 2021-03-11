
<html>

   <head>
    <meta charset="UTF-8">
   <style>
   body {font-family: sans-serif;
       font-size: 10pt;
   }

     border: 1px solid black;

   p {
       margin: 0pt;
       }

   table.items {
       border: 0.1mm solid #000000;
       border: 1px solid black;/*--- */
   }
   td{
       vertical-align: top;

   }
   .items td {
       border-left: 0.1mm solid #000000;
       border-right: 0.1mm solid #000000;
       border: 1px solid black;/*--- */
   }
   table thead td { background-color: #EEEEEE;
       text-align: center;
       border: 0.1mm solid #000000;
       font-variant: small-caps;
       border: 1px solid black;/*--- */
   }
   .items td.blanktotal {
       background-color: #EEEEEE;
       border: 0.1mm solid #000000;
       background-color: #FFFFFF;
       border: 0mm none #000000;
       border-top: 0.1mm solid #000000;
       border-right: 0.1mm solid #000000;
       border: 1px solid black;/*--- */
   }
   .items td.totals {
       text-align: right;
       border: 0.1mm solid #000000;
   }
   .items td.cost {
       text-align: "." center;
   }
   </style>


   </head>
   <body>

 <!--mpdf
<htmlpageheader name="myheader">


    <table width="100%">
         <tr>
            <td width="40%" style="text-align: center; font-weight: bold; font-size: 14pt; vertical-align: middle;" >
                {{$reception[0]->company}}
            </td>
            <td width="60%"  style="text-align: center; font-weight: bold; font-size: 14pt; vertical-align: middle;" colspan="3" >
                Facturación Electronica
            </td>
        </tr>

        <tr>
            <td width="40%" style="color:#000000; font-size: 12px;text-align: center;">
                <span >
                    {{$reception[0]->address}}
                </span>
                <br />
                <span style="font-family:dejavusanscondensed;">
                    &#9742;
                </span>
                +{{$reception[0]->phone}}
            </td>

            <td width="18%" style="text-align: left; ">
                RUC:
                <br/>
                <span style="font-weight: bold; font-size: 10pt;">
                    <span style="font-weight: bold; font-size: 10pt;">
                          {{$reception[0]->ruc}}
                    </span>
                </span>
            </td>

            <td width="32%" style="text-align: left;">
                Email:
                <br />
                    <span style="font-weight: bold; font-size: 10pt;">
                        {{$reception[0]->email}}
                    </span>
            </td>

            <td width="10%" style="text-align: left;">
                Fecha:
                <br />
                <span style="font-weight: bold; font-size: 10pt;">
                    <span style="font-weight: bold; font-size: 10pt;">

                        {{$reception[0]->date_reception}}
                    </span>
                </span>
            </td>
        </tr>

    </table>
    <br>
    @php
    $id=1;
    $total=0.0;
    $cantidad=0.0;
    @endphp
    @foreach ($reception as $receptions)
      @php
        $total +=   $receptions->total;
      @endphp
    @endforeach
    <table width="100%">

        <tr>

            <td width="8%" style="text-align: left; ">


                <span style="font-weight: bold; font-size: 10pt;">Sr(a):
                </span>

            </td>
            <td width="62%" style="text-align: left; ">
               {{$reception[0]->cname}}, {{$reception[0]->clast_name}}

            </td>
            <td width="10%" style="text-align: left; ">

                <span style="font-weight: bold; font-size: 10pt;">DNI:
                </span>
            </td>
            <td width="20%" style="text-align: left; ">

               71780874
            </td>

        </tr>

        <tr>

                <td width="8%" style="text-align: left; ">

                    <span style="font-weight: bold; font-size: 10pt;">Dirección:
                   </span>
                </td>
                <td width="62%" style="text-align: left; ">


                    {{$reception[0]->direction}}

                </td>
                <td width="10%" style="text-align: left; ">
                    <span style="font-weight: bold; font-size: 10pt;">Total:
                    </span>
                </td>
                <td width="20%" style="text-align: left; ">

                    S/. {{$total}}
                </td>


        </tr>
    </table>

</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

</br>
<h3 style="">1. Productos comprados:</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="5.5">
    <thead>
        <tr>
            <td width="5%" align="center">N°</td>
            <td width="65%" align="center">Producto</td> 
            <td width="15%" align="center">Cantidad</td>
            <td width="15%" align="center">Total</td>
        </tr>
    </thead>

    <tbody>
      @foreach ($reception as $receptions)


        <tr>
            <td align="center">{{$id}}</td>
            <td align="center">{{$receptions->name}} {{$receptions->at_name}} {{$receptions->va_name}}</td>

            <td align="center">{{$receptions->quantity}}</td>

            <td align="center">S/. {{$receptions->total}}</td>
        </tr>
        @php
        $id +=1;
        $cantidad +=   $receptions->quantity;
        @endphp

      @endforeach
        <tr>
            <td align="center" colspan="2">Total</td>
            <td align="center">{{$cantidad}}</td>
            <td align="center">S/.{{$total}}</td>
        </tr>


    </tbody>




</table>
