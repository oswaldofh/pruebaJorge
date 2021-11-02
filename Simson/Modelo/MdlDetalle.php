<?php 
   
    include_Once '../Controlador/ClsDetallePedido.php';
    include_Once 'MdlPedido.php';


   

  function CrearDetalle($Articulo,$Cantidad,$Total)
  {
     $Detalle = new ClsDetallePedido();

     $Detalle->Articulo = $Articulo;
     $Detalle->Cantidad = $Cantidad;
     $Detalle->Total = $Total;


     return $Detalle;
  }


  function OrdenarPedido($Pedido)
  { 
    $Mover;
     for ($i=0; $i < count($Pedido)-1 ; $i++) 
     { 
         
        for ($j=$i+1; $j < count($Pedido); $j++) 
        { 
          
           if ($Pedido[$j]->Total< $Pedido[$i]->Total) 
           {
               $Mover = $Pedido[$i];
               $Pedido[$i]=$Pedido[$j];
               $Pedido[$j]=$Mover;
           }
        }
      
     }


 
     $Mover = null;

     return $Pedido;

  }


 


?>