<?php  

  if (isset($_POST["BtnEnviar"])) 
  {
  	   $Post = isset($_POST['Pedido'])? $_POST['Pedido'] : header('Location: Empleado.php') ;

       $Pedido = json_decode($Post[0],true);  
  }


   


  if (isset($_POST['btnAprobar']) || isset($_POST['btnRechazo'])) 
   {

   	   $Post =  $_POST['PedidoCoor'];

       $Pedido = json_decode($Post[0],true);
   	     
   }

   if (isset($_POST['btnRechazoC'])) 
   {

   	    $Post =  $_POST['PedidoC'];

       $Pedido = json_decode($Post[0],true);
   	 
   }


   
    

    
   
  
  
  	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema de Autorizacion</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta charset="utf-8">
</head>
<body>
	<div class="container">
		 <div class="row">
		 	<div class="card-header">
				<div class="row text-center">
					<label><strong> AUTORIZACION DE PEDIDO</strong></label>
				</div>
				<label><strong>Bienvenido :</strong> <?php echo $Pedido["Empleado"]["Nombre"]; ?> </label>
				<label><strong>Cargo : </strong> Coordinador </label>
				<label><strong>Pedidos : </strong> <?php echo  count($Pedido)>0 && $Pedido["Estado_Cordinador"]== false ? 'Hay pedido':'No hay pedido'?> </label>
			</div>
		 	
		 </div>
		 <div class="row">
		 	<!--<form >-->
		 		<table class="table table-hover">
		 			<thead>
		 				<tr>
		 					<th scope="col">Articulo</th>
		 					<th scope="col">Valor</th>
		 					<th scope="col">Cantidad</th>
		 					<th scope="col">Total</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php   
                         
                         $Detalle = $Pedido["Detalle"];

                         foreach ($Detalle as $key => $value) {
                         	 echo "<tr>".
                                     "<td>".$value["Articulo"]["Nombre_Articulo"]."</td>".
                                     "<td>".number_format($value["Articulo"]["Precio"])."</td>".
                                     "<td>".$value["Cantidad"]."</td>".
                                     "<td>".number_format($value["Total"])."</td>".
                         	       "</tr>";
                         }

		 				?>

		 				<tr>
		 					<td></td>
		 					<td></td>
		 					<td><strong>Total</strong></td>
		 					<td><?php echo number_format($Pedido["Total"]);?></td>
		 				</tr>
		 			</tbody>
		 			
		 		</table>

		 		<div class="card-footer text-muted">

                     <?php $Json = json_encode($Pedido); ?>
                    

		 			<input type="hidden" name="PedidoCoor[]" value='<?php echo $Json; ?>'>

                   <form method="post" action="Gerente.php">
                   	  <input type="hidden" name="PedidoAprobar[]" value='<?php echo $Json; ?>'>
                   	  <input type="submit" name="btnAprobar" value="Aprobar" class="btn btn-primary">
                   </form>

                   <form method="post" action="Empleado.php">
                   	  <input type="hidden" name="PedidoCancelar[]" value='<?php echo $Json; ?>'>
                   	  <input type="submit" name="btnRechazoC" value="Rechazo" class="btn btn-danger">
                   	  <input type="text" name="txtCancelacion"  class="form-control" placeholder="Motivo de Anulacion">
                   </form>
		 			
		 			
		 		</div>
		 	<!--</form>-->
		 </div>
		
	</div>

<?php 

if (isset($_POST['btnRechazoC']))
{
	echo "<br><div class='alert alert-danger' role='alert'> 
   	  	                    El generente rechazo su pedido. 
   	  	            </div>";
               	  
}

?>




</body>
</html>

