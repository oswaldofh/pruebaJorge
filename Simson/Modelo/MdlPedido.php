<?php 

  include_Once '../Controlador/ClsPedido.php';


function CrearPedido($Detalle,$Empleado,$TotaS)
{

  date_default_timezone_set("America/Panama");

   $Pedido = new ClsPedido();
    
   $Pedido->Empleado = $Empleado;
   $Pedido->Fecha = date("d-m-y");
   $Pedido->Hora = date("H:i"); 
   $Pedido->Detalle  = $Detalle;
   $Pedido->SetEstadoC(False);
   $Pedido->SetEstadoG(False);
   $Pedido->Total = $TotaS;

     return $Pedido;
}


?>