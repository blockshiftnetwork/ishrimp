<!DOCTYPE html>

<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', config('app.name'))</title>
    
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 40px;
  margin-top: 40px;

  
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  text-align: left;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


</style>

<body>
   
    <div id="logo">
    <img  src="{{public_path('images\top-header.jpg')}}" alt="" width="190" height="120">
    <h2 style="text-align: center; float: right" >Resultados de la Simulación {{date("Y"."-"."m"."-"."d")}}</h2> 
    </div>
    
    
    
                <table id="table-left">
                 
                        <tr>
                            <td>Piscina</td>
                            <td>{{$info[0]->name}}</td>
                        </tr>
                        <tr>
                            <td>Fecha de Siembra</td>
                            <td>{{$info[1]->val}}</td>
                        </tr>
                        <tr>
                            <td>Hectareas</td>
                            <td>{{number_format((float) $info[2]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Precio Ponderado</td>
                            <td>{{number_format((float) $info[3]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Densidad Sembrada: Larvas x HA</td>
                            <td>{{number_format((float) $info[4]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Precio larva (millar) $</td>
                            <td>{{number_format((float) $info[5]->val  ?? 0,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo Larva Piscina</td>
                            <td>{{number_format((float) $info[6]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Días corrida</td>
                            <td>{{$info[7]->val}}</td>
                        </tr>
                        <tr>
                            <td>Peso cosechado en gr</td>
                            <td>{{number_format((float) $info[8]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Incremento g (semanal)</td>
                            <td>{{number_format((float) $info[9]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>% Supervivencia</td>
                            <td>{{$info[10]->val, ',', '.'}}</td>
                        </tr>
                        <tr>
                            <td>Biomasa lbs/ha</td>
                            <td>{{number_format((float) $info[11]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Biomasa total x piscina</td>
                            <td>{{number_format((float) $info[12]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Días / Ha </td>
                            <td>{{number_format((float) $info[13]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>FCA</td>
                            <td>{{number_format((float) $info[14]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo Fijo (Cost/Ha/día)</td>
                            <td>{{number_format((float) $info[15]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo FIJO Total / ha (-bal-lar)</td>
                            <td>{{number_format((float) $info[16]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo Balanceado / ha</td>
                            <td>{{number_format((float) $info[17]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo Larva x ha</td>
                            <td>{{number_format((float) $info[18]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo Total x ha</td>
                            <td>{{number_format((float) $info[19]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Costo Total Piscina</td>
                            <td>{{number_format((float) $info[20]->val,2, ',', '.')}}</td>
                        </tr>
                         
                        <tr>
                            <td>Costo/Libra de camarón</td>
                            <td>{{number_format((float) $info[21]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Precio de Venta x KILO</td>
                            <td>{{number_format((float) $info[22]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Precio de Venta x LIBRA</td>
                            <td>{{number_format((float) $info[23]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Ingreso x ha</td>
                            <td>{{number_format((float) $info[24]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>INGRESO TOTAL CORRIDA</td>
                            <td>{{number_format((float) $info[25]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Utilidad x ha</td>
                            <td>{{number_format((float) $info[26]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Utilidad x piscina</td>
                            <td>{{number_format((float) $info[27]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>UP/Ha/día</td>
                            <td>{{number_format((float) $info[28]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Rentabilidad %</td>
                            <td>{{number_format((float) $info[29]->val,2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Utilidad x libra</td>
                            <td>{{number_format((float) $info[30]->val,2, ',', '.')}}</td>
                        </tr>
                 
                </table>
          
        
                <table id="table-balanced" class="">
                    <tr><td>Producto</td>
                        <td>$/Saco</td>
                        <td>Saco Kg</td>
                        <td>$/Kg</td>
                        <td>Kilos Aplicados</td>
                        <td>Precio Pond.</td>
                        </tr>
                        
                    
                        @foreach($balanced as $item)
                        <tr><td>{{$item->presentation_name}}</td>
								<td>{{number_format($item->price)}} </td>
								<td>{{number_format($item->presentation_quantity)}} </td>
								<td>{{number_format($item->price / $item->presentation_quantity)}}</td>
								<td>{{number_format($item->quantity_used)}}</td>
								<td>{{number_format($item->quantity_used * $item->price / $item->presentation_quantity)}}</td></tr>
                        @endforeach
               

                </table>
           
                    <table id="table-total" class="table table-bordered">
                        @php 
                            $k = 33 + (count($balanced))*5;

                        @endphp
                        <tbody>
                            <tr>
                                <td>Costo Total Balanceado</td>
                                <td>{{number_format((float) $info[$k]->val,2, ',', '.')}}</td>

                            </tr>
                            <tr>
                                <td>Costo Balanceado x Ha</td>
                                <td>{{number_format((float) $info[$k+1]->val,2, ',', '.')}}</td>

                            </tr>
                            <tr>
                                <td>Total Kilos Alimento</td>
                                <td>{{number_format((float) $info[$k+2]->val,2, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <td>Total Libras Alimento</td>
                                <td>{{number_format((float) $info[$k+3]->val,2, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <td>Total Libras Cosechadas</td>
                                <td>{{number_format((float) $info[$k+4]->val,2, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <td>FCA</td>
                                <td>{{number_format((float) $info[$k+5]->val,2, ',', '.')}}</td>
                            </tr>
                        </tbody>

                    </table>
                       
 
</body>
</html>
