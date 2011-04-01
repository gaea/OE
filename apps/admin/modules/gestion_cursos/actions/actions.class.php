<?php

/**
 * gestion_cursos actions.
 *
 * @package    OE
 * @subpackage gestion_cursos
 * @author     gaea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestion_cursosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  
  public function executeConsultar_profesores(sfWebRequest $request)
  {
		$salida='({"total":"0", "results":""})';
		$datos;
		$fila = 0;
		$campo_busqueda = $request->getParameter('campo');
		$busqueda = $request->getParameter('busqueda');

		try
		{  
			$profesoresTable =  Doctrine_Core::getTable('Profesor'); 
			
			if($campo_busqueda == 'nombres')
			{
				$profesores =  $profesoresTable->findByProNombres($busqueda); 
			}
			else
			{
				$profesores =  $profesoresTable->findAll(); 
			}

			foreach($profesores As $profesor)
			{
				$datos[$fila]['pro_codigo'] = $profesor->getProCodigo();
				$datos[$fila]['pro_nombres'] = $profesor->getProNombres();
				$datos[$fila]['pro_identificacion'] = $profesor->getProIdentificacion();
				$datos[$fila]['pro_apellidos'] = $profesor->getProApellidos();

				$fila++;
			}

			if($fila>0)
			{
				$jsonresult = json_encode($datos);
				$salida = '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $exception)
		{
			$this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar los profesores ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
  }
}
