<?php

/**
 * evaluacion actions.
 *
 * @package    OE
 * @subpackage evaluacion
 * @author     gaea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluacionActions extends sfActions
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
  
  public function executeGuardar_evaluacion(sfWebRequest $request)
  {
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en guardar la evaluaci&oacute;n ' , error: 'desconocido'}})";
		
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection();  
		$connection->beginTransaction(); 
	
		$eva_codigo_profesor = 11; // lo capturo de la sesion
		
		try
		{
			$evaluacion = new Evaluacion();
			$evaluacion->setEvaCodigoProfesor($eva_codigo_profesor);
			$evaluacion->setEvaCodigoTemaMateria($request->getParameter('eva_codigo_tema_materia'));
			$evaluacion->setEvaNombre($request->getParameter('eva_nombre'));
			$evaluacion->setEvaHoraInicio($request->getParameter('eva_hora_inicio'));
			$evaluacion->setEvaHoraFin($request->getParameter('eva_hora_fin'));
			$evaluacion->setEvaNumeroPersonasGrupo($request->getParameter('eva_numero_personas_grupo'));
			$evaluacion->setEvaPublico($request->getParameter('eva_publico'));
			$evaluacion->setEvaFecha($request->getParameter('eva_fecha'));
			$evaluacion->setEvaNumeroIntentos($request->getParameter('eva_numero_intentos'));
			$evaluacion->setEvaMostrarSolucion($request->getParameter('eva_mostrar_solucion'));
			$evaluacion->setEvaBarajarPreguntas($request->getParameter('eva_barajar_preguntas'));
			
			$evaluacion->save();
			$connection->commit();
			$salida = "({success: true, mensaje:'La evaluaci&oacute;n fue creada exitosamente'})";
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en guardar evaluaci&oacute;n ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
  }
  
  public function executeConsultar_tema_materia(sfWebRequest $request)
  {
		$salida='({"total":"0", "results":""})';
		$datos;
		$fila = 0;
		$campo_busqueda = $request->getParameter('campo_busqueda');
		$busqueda = $request->getParameter('busqueda');
		$start = $request->getParameter('start');
		$limit = $request->getParameter('limit');
		
		try
		{  
			$query = Doctrine_Query::create()->from('TemaOMateria');
			
			if($campo_busqueda != '') {
				$query->where('tom_nombre LIKE ?', '%'.$busqueda.'%');
				//$query->orWhere('tom_codigo LIKE ?', '%'.$busqueda.'%');
			}
			
			$temasomaterias = new sfDoctrinePager('Profesor', $limit);
			$temasomaterias->setQuery($query);
			$temasomaterias->setPage($start);
			$temasomaterias->init();

			foreach($temasomaterias As $temaomateria)
			{
				$datos[$fila]['tom_codigo'] = $temaomateria->getTomCodigo();
				$datos[$fila]['tom_nombre'] = $temaomateria->getTomNombre();
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
			$this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar los temas o materias ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
  }
  
  public function executeConsultar_evaluacion(sfWebRequest $request)
  {
		$salida='({"total":"0", "results":""})';
		$datos;
		$fila = 0;
		$campo_busqueda = $request->getParameter('campo_busqueda');
		$busqueda = $request->getParameter('busqueda');
		$start = $request->getParameter('start');
		$limit = $request->getParameter('limit');
		
		$eva_codigo_profesor = 11; // lo capturo de la sesion
		
		try
		{  
			$query = Doctrine_Query::create()->from('Evaluacion');
			
			if($campo_busqueda != '') {
				$query->where('eva_nombre LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('eva_codigo_profesor = ?', $eva_codigo_profesor);
				
				/*
				Campos para buscar
				eva_codigo
				eva_codigo_profesor lo saca de la seccion
				eva_codigo_tema_materia
				eva_nombre
				eva_hora_inicio
				eva_hora_fin
				eva_numero_personas_grupo
				eva_publico //b
				eva_fecha 

				eva_numero_intentos
				eva_mostrar_solucion
				eva_barajar_preguntas*/
			}
			
			$query->limit($limit);
			$query->offset($start);
			
			/*$temasomaterias = new sfDoctrinePager('Evaluacion', $limit);
			$temasomaterias->setQuery($query);
			$temasomaterias->setPage($start);
			$temasomaterias->init();*/

			/*foreach($temasomaterias As $temaomateria)
			{
				$datos[$fila]['tom_codigo'] = $temaomateria->getTomCodigo();
				$datos[$fila]['tom_nombre'] = $temaomateria->getTomNombre();
				$fila++;
			}*/
			
			$datos = $query->fetchArray();

			$jsonresult = json_encode($datos);
			$salida = '({"total":"'.$fila.'","results":'.$jsonresult.'})';
		}
		catch (Exception $exception)
		{
			$this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar los temas o materias ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
  }
}
