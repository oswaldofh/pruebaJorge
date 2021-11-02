<?php

class ClsArticulo
{

	Public $Nombre_Articulo; 
	public $Precio; 

    
    function ListarArticulos()
    {
    	
    	$Lista =  array('Articulo1' => array('Lapicero',1000) ,
    	                   'Articulo2'=> array('Lapiz',40000),
    	                   'Articulo3' => array('Minas',500) );

    	return $Lista;

            	 
    }

	

}


?>