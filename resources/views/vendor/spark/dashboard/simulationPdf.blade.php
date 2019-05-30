<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
	<div>
		 <img src="{{ asset('images/top-login-header.svg') }}" alt="logo">
	</div>
    
                <table id="table-left">
                 
                        <tr>
                            <td>Piscina</td>
                            <td>{{$info[0]->val}}</td>
                        </tr>
                        <tr>
                            <td>Fecha de Siembra</td>
                            <td>{{$info[1]->val}}</td>
                        </tr>
                        <tr>
                            <td>Hectareas</td>
                            <td>{{$info[2]->val}}</td>
                        </tr>
                        <tr>
                            <td>Precio Ponderado</td>
                            <td>{{$info[3]->val}}</td>
                        </tr>
                        <tr>
                            <td>Densidad Sembrada: Larvas x HA</td>
                            <td>{{$info[4]->val}}</td>
                        </tr>
                        <tr>
                            <td>Precio larva (millar) $</td>
                            <td>{{$info[5]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo Larva Piscina</td>
                            <td>{{$info[6]->val}}</td>
                        </tr>
                        <tr>
                            <td>Días corrida</td>
                            <td>{{$info[7]->val}}</td>
                        </tr>
                        <tr>
                            <td>Peso cosechado en gr</td>
                            <td>{{$info[8]->val}}</td>
                        </tr>
                        <tr>
                            <td>Incremento g (semanal)</td>
                            <td>{{$info[9]->val}}</td>
                        </tr>
                        <tr>
                            <td>% Supervivencia</td>
                            <td>{{$info[10]->val}}</td>
                        </tr>
                        <tr>
                            <td>Biomasa lbs/ha</td>
                            <td>{{$info[11]->val}}</td>
                        </tr>
                        <tr>
                            <td>Biomasa total x piscina</td>
                            <td>{{$info[12]->val}}</td>
                        </tr>
                        <tr>
                            <td>Días / Ha </td>
                            <td>{{$info[13]->val}}</td>
                        </tr>
                        <tr>
                            <td>FCA</td>
                            <td>{{$info[14]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo Fijo (Cost/Ha/día)</td>
                            <td>{{$info[15]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo FIJO Total / ha (-bal-lar)</td>
                            <td>{{$info[16]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo Balanceado / ha</td>
                            <td>{{$info[17]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo Larva x ha</td>
                            <td>{{$info[18]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo Total x ha</td>
                            <td>{{$info[19]->val}}</td>
                        </tr>
                        <tr>
                            <td>Costo Total Piscina</td>
                            <td>{{$info[20]->val}}</td>
                        </tr>
                         
                        <tr>
                            <td>Costo/Libra de camarón</td>
                            <td>{{$info[21]->val}}</td>
                        </tr>
                        <tr>
                            <td>Precio de Venta x KILO</td>
                            <td>{{$info[22]->val}}</td>
                        </tr>
                        <tr>
                            <td>Precio de Venta x LIBRA</td>
                            <td>{{$info[23]->val}}</td>
                        </tr>
                        <tr>
                            <td>Ingreso x ha</td>
                            <td>{{$info[24]->val}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>INGRESO TOTAL CORRIDA</td>
                            <td>{{$info[25]->val}}</td>
                        </tr>
                        <tr>
                            <td>Utilidad x ha</td>
                            <td>{{$info[26]->val}}</td>
                        </tr>
                        <tr>
                            <td>Utilidad x piscina</td>
                            <td>{{$info[27]->val}}</td>
                        </tr>
                        <tr>
                            <td>UP/Ha/día</td>
                            <td>{{$info[28]->val}}</td>
                        </tr>
                        <tr>
                            <td>Rentabilidad %</td>
                            <td>{{$info[29]->val}}</td>
                        </tr>
                        <tr>
                            <td>Utilidad x libra</td>
                            <td>{{$info[30]->val}}</td>
                        </tr>
                 
                </table>
          
        
                <table id="table-balanced" class="">
                    <thead class="thead-primary">
                        <th>Producto</th>
                        <th>$/Saco</th>
                        <th>Saco Kg</th>
                        <th>$/Kg</th>
                        <th>Kilos Aplicados</th>
                        <th>Precio Pond.</th>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
           
                    <table id="table-total" class="table table-bordered">

                        <tbody>
                            <tr>
                                <td>Costo Total Balanceado</td>
                                <td><input id="t1" class="form-control" type="text" readonly></td>

                            </tr>
                            <tr>
                                <td>Costo Balanceado x Ha</td>
                                <td><input id="t2" class="form-control" type="text" readonly> </td>

                            </tr>
                            <tr>
                                <td>Total Kilos Alimento</td>
                                <td><input id="t3" class="form-control" type="text" readonly ></td>
                            </tr>
                            <tr>
                                <td>Total Libras Alimento</td>
                                <td><input id="t4" class="form-control" type="text" readonly ></td>
                            </tr>
                            <tr>
                                <td>Total Libras Cosechadas</td>
                                <td><input id="t5" class="form-control" type="text" readonly ></td>
                            </tr>
                            <tr>
                                <td>FCA</td>
                                <td><input id="t6" class="form-control" type="text" readonly></td>
                            </tr>
                        </tbody>

                    </table>
                       
 
</body>
</html>
