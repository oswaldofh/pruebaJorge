<?php 

   echo '<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title>Solicitud de Pedido</title>
  
</head>
<body>';

    date_default_timezone_set("America/Panama");
     

    if(isset($_POST['btnAprobar']))
    {

       $Post =  $_POST['PedidoAprobar'];

       $Pedido = json_decode($Post[0],true); 
      
   

       if (date("H:i") != date($Pedido["Hora"])) 
       {
       	     echo "<br><div class='alert alert-danger' role='alert'> 
   	  	                    No se puede aprobar ya que  supero el tiempo
   	  	            </div>";

       }else
       {
       	  $Pedido["Hora"]=date("H:i");
       	  $Pedido["Estado_Cordinador"] = true;


       	   $Json = json_encode($Pedido);
       	 

          echo "
         <div class='container'>
		 <div class='row'>
		 	<div class='card-header'>
				<div class='row text-center'>
					<label><strong> AUTORIZACION DE PEDIDO</strong></label>
				</div>
				<label><strong>Bienvenido: </strong>".$Pedido["Empleado"]["Nombre"]."</label>
				<label><strong>Cargo: </strong>Gerente</label>
			</div>"; 

			echo "<div class='row'>".
			         "<table class='table table-hover'>
		 			<thead>
		 				<tr>
		 					<th scope='col'>Articulo</th>
		 					<th scope='col'>Valor</th>
		 					<th scope='col'>Cantidad</th>
		 					<th scope='col'>Total</th>
		 				</tr>
		 			</thead>
		 			<tbody>";

                      $Detalle = $Pedido["Detalle"];

                         foreach ($Detalle as $key => $value) 
                         {
                         	 echo "<tr>".
                                     "<td>".$value["Articulo"]["Nombre_Articulo"]."</td>".
                                     "<td>".number_format($value["Articulo"]["Precio"])."</td>".
                                     "<td>".$value["Cantidad"]."</td>".
                                     "<td>".number_format($value["Total"])."</td>".
                         	       "</tr>";
                         }

			      echo " 
			            <tr>
		 					<td></td>
		 					<td></td>
		 					<td><strong>Total</strong></td>
		 					<td>". number_format($Pedido["Total"])."</td>
		 				</tr>
			         </tbody>
			       </table>
			      </div>

                      <form method='post' action='Gerente.php'>
                            <input type='hidden' name='PedidoG[]' value='".$Json."'>
                   	       <input type='submit' name='btnAprobarG' value='Aprobar' class='btn btn-primary'>
                         </form>

                        <form method='post' action='Coordinador.php'>
                   	        <input type='hidden' name='PedidoC[]' value='".$Json."'>
                   	       <input type='submit' name='btnRechazoC' value='Rechazo' class='btn btn-danger'>
                        </form>

			      ";


       }

    } 
    

       if (isset($_POST['btnAprobarG'])) 
       {
              $Post =  $_POST['PedidoG'];

               $Pedido = json_decode($Post[0],true);


               if ($Pedido["Hora"] != date("H:i")) 
               {

                 	echo "<br><div class='alert alert-danger' role='alert'> 
   	  	                    No se puede aprobar ya que  supero el tiempo
   	  	            </div>";
               	  
               }else {

                          echo "
                   <div class='alert alert-success' role='alert'>
                        El pedido se aprobo correctamente
                   </div>";

               }

    	 

    	      
       }




    echo "</body>
</html>";
       
?>