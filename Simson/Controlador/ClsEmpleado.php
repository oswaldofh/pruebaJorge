<?php  
    class ClsEmpleado
    {

    	Public $Id; 
    	Public $Nombre;
    	private $Rol; 
        private $Error;

      


        function ValidarEmpleado($Rol)
        {
            if (empty($this->Id)) 
            {
                $this->Error = "El Numero esta vacio";
                return false; 
            }

             if (empty($this->Nombre)) 
            {
                $this->Error = "El Nombre esta vacio";
                return false; 
            }

             $this->Rol = $Rol;
            if ($this->Rol != 'Empleado' && $this->Rol !='Coordinador' && $this->Rol != 'Gerente') 
            {
                $this->Error="No ha seleccionado el Rol";
                 return  false; 
            }


            return true; 

        }

        function GetError()
        {
            return  $this->Error;
        }

        function GetRol()
        {
            return $this->Rol;
        }




    
    }
?>