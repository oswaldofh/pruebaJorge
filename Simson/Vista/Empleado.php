<?php 
    include_Once '../Controlador/ClsEmpleado.php';
    include_Once '../Modelo/MdlArticulo.php';
    include_Once '../Modelo/MdlDetalle.php';
    include_Once '../Modelo/MdlPedido.php';
    include_Once '../Controlador/ClsPedido.php';

    session_start();
    
    $Empleado = $_SESSION['Empleado'];

    if (isset($_POST["btnRechazoC"])) 
    {
         $Motivo = $_POST['txtCancelacion'];

          echo "<br><div class='alert alert-danger' role='alert'> 
                            El coordinador rechazo el pedido ".$Motivo."
                    </div>";
    }
    
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title>Solicitud de Pedido</title>
  
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="card-header">
				<div class="row text-center">
					<label><strong> SOLICITUD DE PEDIDO</strong></label>
				</div>
				<label><strong>Bienvenido :</strong> <?php echo $Empleado->Nombre ?> </label>
				<label><strong>Cargo : </strong>  <?php  echo $Empleado->GetRol()?> </label>
				
			</div>
		</div>
		<div class="row">
           <form method="post">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Precio</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Solicitar</th>
					</tr>
					
				</thead>
				<tbody>
					<?php  ConsultarArticulos();?>
				</tbody>
				
			</table>
			 <input type="submit" value="Enviar" class="btn btn-primary">
          </form>
			
		</div>
	
	</div>

</body>
</html>

<?php 
   
   if ($_POST) 
   {
   	$Pedido=null;

   	  for ($i=1; $i <=CantidadArticulos(); $i++) 
   	  { 
   	  	if (isset($_POST['Chec'.$i])) 
   	  	{
   	  		$N_Articulo = $_POST['Chec'.$i];
   	  		$Cantidad = $_POST["$N_Articulo"];
   	  		$Total = $Cantidad * $_POST['Vlr'.$N_Articulo];
   	  		$VlrUnit = $_POST['Vlr'.$N_Articulo];	
            
            $C_Articulo = CrearArticulo($N_Articulo,$VlrUnit);
            $C_Detalle =  CrearDetalle($C_Articulo,$Cantidad,$Total);

            $Pedido[]=$C_Detalle;
   	  	}

   	  }

   	  if (is_array($Pedido))		
   	  {
   	  	  $Pedido = OrdenarPedido($Pedido);
   	  	  $TotalP=0;

           echo " <div class='container'>
                   <br><div class='card'>".
                    "<div class='card-header text-center'>".
                         "Resumen del Pedido".
                     "</div>".
                     "<div class='card-body'>".
                         "<table class='table table-hover'>".
                            "<thead> 
                              <tr>
                                <th scope='col'>Nombre</th>
                                <th scope='col'>Vlr Articulo</th>
                                <th scope='col'>Cantidad</th>
                                <th scope='col'>Total</th>
                              </tr>
                             </thead>".
                             "<tbody>";

                             foreach ($Pedido as $key => $value) 
                             {
                             	 echo "<tr>".
                             	           "<td>".$value->Articulo->Nombre_Articulo."</td>".
                             	           "<td>".number_format($value->Articulo->Precio
                             	           )."</td>".
                             	           "<td>".$value->Cantidad."</td>".
                             	           "<td>".number_format($value->Total)."</td>".
                             	      "</tr>";
                                   $TotalP += $value->Total;
                             }


                        echo" <tr>
                               <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td>".number_format($TotalP)."</td>
                              </tr>
                           </tbody>".
                         "</table>".
                     "</div>";
                        $Pedido = CrearPedido($Pedido,$Empleado,$TotalP);

                        $Json = json_encode($Pedido);

                echo"      

                     <div class='row'>
                        <div class='col-sm-4'>
                        </div>
                         <div class='col-sm-4'>
                             
                         </div>
                         <div class='col-sm-4'>
                           <form method='post' action='Coordinador.php'>
                                <input type='hidden' name='Pedido[]' value='".$Json."' >      
                            <input type='submit' value='Ir al Coordinador' class='btn btn-primary' name='BtnEnviar'>

                           </form>

                        </div>
                     </div>


                     </div>
                 </div>"; 	

                 

                

                   


   	  }else
   	  {
   	  	  echo "<br><div class='alert alert-danger' role='alert'> 
   	  	                    No se selecciono ningun Articulo
   	  	            </div>";	
   	  }


   	  




   	$N_Articulo = null;
   	$Cantidad = null; 
   	$Total = null; 
   	$VlrUnit = null; 
   	$C_Articulo = null; 
   	$C_Detalle = null;
   	$TotalP =null;
    $Pedido = null; 
    $Json = null;
     
   }


?>