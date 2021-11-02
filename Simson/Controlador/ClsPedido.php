<?php
   
   include_Once 'ClsArticulos.php';
   include_Once 'ClsEmpleado.php';
   include_Once 'ClsDetallePedido.php';

 class ClsPedido
 {
 	 public $Empleado; 
 	 public $Fecha;
    public $Hora; 
 	 public $Detalle; 
 	 public $Estado_Cordinador; 
 	 public $Estado_Gerente; 
 	 public  $Total;
    public $Motivo_Anuacion; 


    function SetEstadoC($Estado)
    {
      $this->Estado_Cordinador = $Estado;
    } 

      function SetEstadoG($Estado)
    {
      $this->Estado_Gerente = $Estado;
    }                                      


 }



?>	