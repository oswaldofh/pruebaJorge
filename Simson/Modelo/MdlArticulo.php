<?php
  include_Once '../Controlador/ClsArticulos.php';



  function ConsultarArticulos()
  {
  	  $Articulos = new ClsArticulo();

  	  $Lista = $Articulos->ListarArticulos();
    
       $Contador=1;
  	  foreach ($Lista as $Articulo => $Desplegue) 
  	  {
  	      echo "<tr>".
  	                "<td>".$Desplegue[0]."</td>".
  	                "<td> $ ".number_format($Desplegue[1])."</td>".
  	                "<td><input type='number' min='0'name='".$Desplegue[0]."' value='1'></td>".
                    "<td><input type='checkbox' value='".$Desplegue[0]."' name='Chec".$Contador."'class='form-check-input'></td>".
                    "<input type='hidden' value='".$Desplegue[1]."' name='Vlr".$Desplegue[0]."'>".
  	             "</tr>";	

                 $Contador++;
  	  }

      $Articulos = null;
      $Lista= NULL;
  }

  function CantidadArticulos()
  {

      $Articulos = new ClsArticulo();

      $Lista = $Articulos->ListarArticulos();
      $Articulos = null;

      return count($Lista);

  }
    
  function CrearArticulo($Nombre,$Precio)
  {
      $Articulo = new ClsArticulo();

      $Articulo->Nombre_Articulo = $Nombre;
      $Articulo->Precio = $Precio;

      return $Articulo;
  }
 


?>