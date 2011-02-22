<?php


class IdentificacionTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Identificacion');
    }
    
    public static function getIdentificacionArray()
    {
		$datos;
		$fila = 0;
		
		$identificacionTable =  Doctrine_Core::getTable('Identificacion');  
		$identificacion =  $identificacionTable->findAll();  

		foreach($identificacion As $temp)
		{
			$datos[$fila]['ide_codigo'] = $temp->getIdeCodigo();
			$datos[$fila]['ide_tipo'] = $temp->getIdeTipo();
			
			$fila ++;
		}
		
        return $datos;
    }
}
