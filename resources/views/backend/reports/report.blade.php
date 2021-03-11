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

    <div style="text-align: center; font-weight: bold; font-size: 12pt; vertical-align: middle;">
        <h1>Declaración de Protocolo de Salubridad</h1>
    </div>
    <table width="100%">
        
        <tr>
            
            <td width="70%" style="text-align: left; ">
                
            @foreach($names as $item)
                <span style="font-weight: bold; font-size: 10pt;">Trabajador:
                </span>{{$item->name}} {{$item->last_name}}
            @endforeach
            </td>
             <td width="30%" style="text-align: left; ">
                 
                <span style="font-weight: bold; font-size: 10pt;">Fecha:
                </span>{{$fecha}}
            </td>
            
        </tr>
        <tr>
            @foreach($empresa as $items)
                <td width="70%" style="text-align: left; ">
                    
                    <span style="font-weight: bold; font-size: 10pt;">Empresa:
                    </span>{{$items->company}}
                </td>
                <td width="30%" style="text-align: left; ">
                    <span style="font-weight: bold; font-size: 10pt;">RUC:
                    </span>{{$items->ruc}}
                </td>
            @endforeach
            
        </tr>
    </table>

    <h3 style="">Cuestionario de preguntas</h3>
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

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="5.5">
    <thead>
        <tr>
            <td width="60%" align="center">Criterio</td>
            <td width="10%" align="center">Cumple</td>
            <td width="10%" align="center">No cumple</td>
            <td width="21%" align="center">Observaciones</td>
                    
        </tr>
    </thead>
    <thead>
        <tr>
            <td colspan="4" align="left">De la Zona de despacho</td>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td align="left">El restaurante o servicio a fin cuenta con una zona exclusiva para empaque y despacho de los alimentos.</td>
            @if($data->quest1 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
              
            <td align="left"></td>  
        </tr>
        
       
    </tbody>
    <thead>
        <tr>
            <td colspan="4" align="left">DEL PERSONAL: despachador/repartidor encargado de acondicionar los alimentos en los contenedores o de transportalos</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="left">ESTADO DE SALUD</td>
            <td align="center"></td>
            <td align="center"></td>  
            <td align="left"></td>  
        </tr>
        <tr>
            <td align="left">Temperatura igual o menor a 37ºC.</td>
            @if($data->quest2 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
              
            <td align="left"></td>  
        </tr>
        <tr>
            <td align="left">No tiene procesos respiratorios, dolor de garganta, tos, dolor de cabeza.</td>
            @if($data->quest3 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">HIGIENE DE PRESTACIÓN</td>
            
        </tr>
        <tr>
            <td align="left"> - Tiene manos con o sin guantes limpias y desinfectadas.</td>
            @if($data->quest4 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left"> - Tiene uñas cortas y limpias.</td>
            @if($data->quest5 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left"> - No tiene heridas infectadas o abiertas.</td>
            @if($data->quest6 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left"> - Tiene protector naso bucal.</td>
            @if($data->quest7 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif  
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left"> - Tiene cabello cubierto.</td>
            @if($data->quest8 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left"> - Tiene la indumentaria limpia.</td>
            @if($data->quest9 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left"> - No tienen joyas, alhajas, relojes.</td>
            @if($data->quest10 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">CAPACITACIÓN</td>
            <td align="center"></td>
            <td align="center"></td>  
            <td align="left"></td>  
        </tr>
        <tr>
            <td align="left">El personal (manipuladores, repartidores) han recibido la capacitación por parte el restaurante para aplicación de la Guía Técnica Sanitaria.</td>
            @if($data->quest11 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        
        
    </tbody>
    <thead>
        <tr>
            <td colspan="4" align="left">DEL REPARTO DE LOS ALIMENTOS</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="left">Los envases y empaques son de primer uso y protegen los mismos.</td>
            @if($data->quest12 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">Los empaques se encuentran bien cerrados.</td>
            @if($data->quest13 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">Los contenedores o cajas para reparto alimentos preparados se encuentran limpios y desinfectados antes de acondicionar los alimentos en ellos.</td>
            @if($data->quest14 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">El cierre de los contenedores asegura la protección de los alimentos de la contaminación extrema</td>
            @if($data->quest15 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">El reparto de alimentos es menor a 1 hora.</td>
            @if($data->quest16 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif 
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">El contenedor o caja se encuentra acondicionado para mantener a los alimentos preparados en las condiciones de caliente o frío.</td>
            @if($data->quest17 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif
            <td align="left"></td> 
        </tr>
        <tr>
            <td align="left">El repartidor cuenta con un desinfectante para manos.</td>
            @if($data->quest18 == 1)
                <td align="center">X</td>
                <td align="center"></td>  
            @else
                <td align="center"></td>
                <td align="center">X</td>
            @endif  
            <td align="left"></td> 
        </tr>
    </tbody>
    
        
   
    
</table>


