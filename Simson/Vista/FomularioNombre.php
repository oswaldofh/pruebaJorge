<?php
  include_Once("../Controlador/ClsEmpleado.php");

   
   $Rol =  empty($_GET['Rol']) ? header('Location: Index.php') :  $_GET['Rol'] ;
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<title>Datos de Empleado</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				
			</div>
			<div class="col-sm-5">
				<div class="card">
				  <div class="card-header text-center">
				  	<h2>Datos del <?php echo $Rol?></h2>
				  </div>
				  <div class="card-body">
				  	<form method="post" action="#">
				  		  <label for="inputEmail4" class="form-label">Numero de Documento</label>
				  		  <input type="text" name="VlrDocuento" id="Documento" class="form-control">
				  		  <label for="inputEmail4" class="form-label">Nombre</label>
				  		  <input type="text" name="VlrNombre" id="Nombre" class="form-control">
				  		  <label for="inputEmail4" class="form-label">Rol</label>
				  		  <input type="text" name="VlrRol" id="Rol" class="form-control" value=<?php echo "$Rol" ?> readonly>
				  		  <br>
				  		  <input type="submit" name="Registrar" class="btn btn-primary">
				  		  <a href="Index.php" class="btn btn-danger">Regresar</a>
				  	</form>
				  	
				  </div>
			    <div>
			</div>
			<div class="col-sm-4">
			</div>
				
			</div>
			
		</div>
		
	</div>

</body>
</html>

<?php

   if ($_POST) 
   {
   	  $Empleado = new ClsEmpleado();
      $Empleado->Id = $_POST['VlrDocuento'];
      $Empleado->Nombre =  $_POST['VlrNombre'];


      if ($Empleado->ValidarEmpleado($_POST['VlrRol'])) 
      {
      	session_start();

      	$_SESSION['Empleado'] = $Empleado;
          
         switch ($Rol) {
         	case 'Empleado':
         		header("Location: Empleado.php");
         		break;
         	case 'Coordinador': 
         	   header("Location: Coordinador.php");
         		break; 
         	case 'Gerente':
         	   header("Location: Gerente.php");
         		 break;
         
         }

      }else
      {
      	echo "<br><div class='alert alert-danger' role='alert'>".$Empleado->GetError().
             "</div>";	

      }
     

     $Empleado = null; 
     $Rol = null; 

   }




?>



