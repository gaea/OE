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
  
  public function executeConsultar_cursos(sfWebRequest $request)
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
			$query = Doctrine_Query::create();
			$query->from('Curso');
			
			/*if($campo_busqueda != '') {
				$query->innerJoin('Curso.Profesor');
				$query->where('cur_nombre LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('cur_habilitado LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_codigo LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_apellidos LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_e_mail LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_identificacion LIKE ?', '%'.$busqueda.'%');
				$query->andWhere('pro_habilitado = TRUE');
			}*/
			
			$cursos = new sfDoctrinePager('Curso', $limit);
			$cursos->setQuery($query);
			$cursos->setPage($start);
			$cursos->init();

			foreach($cursos As $curso)
			{
				$datos[$fila]['cur_codigo'] = $curso->getCurCodigo();
				$datos[$fila]['cur_codigo_profesor'] = $curso->getProfesor()->getProCodigo();
				$datos[$fila]['cur_nombre_profesor'] = $curso->getProfesor()->getProNombres()." ".$curso->getProfesor()->getProApellidos();
				$datos[$fila]['cur_nombre'] = $curso->getCurNombre();
				$datos[$fila]['cur_fecha_creacion'] = $curso->getCurFechaCreacion();
				$datos[$fila]['cur_habilitado'] = $curso->getCurHabilitado();

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
			$this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar los cursos ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
  }
  
  public function executeGuardar_curso(sfWebRequest $request)
  {
		$codigos_estudiantes = json_decode($request->getParameter('codigos_estudiantes'));
	  
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar curso ' , error: 'desconocido'}})";
		
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection();  
		$connection->beginTransaction();  
		
		try
		{
			$curso = new Curso();
			
			$curso->setCurCodigoProfesor($request->getParameter('cur_codigo_profesor'));
			$curso->setCurNombre($request->getParameter('cur_nombre'));
			//$curso->setCurCodigo($request->getParameter('codigos_estudiantes'));
			$curso->setCurFechaCreacion(date('Y-m-d',time()));
			$curso->setCurHabilitado(true);

			$curso->save();
			
			foreach($codigos_estudiantes as $codigo_estudiante)
			{
				$estudiante_curso = new EstudianteCurso();
				$estudiante_curso->setCurso($curso);
				$estudiante_curso->setEstCurCodigoEstudiante($codigo_estudiante);
				
				$estudiante_curso->save();
			}
			
			$connection->commit();
			$salida = "({success: true, mensaje:'El curso fue creado exitosamente'})";
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar curso ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
  }
  
  public function executeConsultar_profesores(sfWebRequest $request)
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
			$query = Doctrine_Query::create()->from('Profesor');
			
			if($campo_busqueda != '') {
				$query->innerJoin('Profesor.Usuario');
				$query->where('usu_login LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_nombres LIKE ?', '%'.$busqueda.'%');
				//$query->orWhere('pro_codigo LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_apellidos LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_e_mail LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('pro_identificacion LIKE ?', '%'.$busqueda.'%');
				$query->andWhere('pro_habilitado = TRUE');
			}
			
			$profesores = new sfDoctrinePager('Profesor', $limit);
			$profesores->setQuery($query);
			$profesores->setPage($start);
			$profesores->init();

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
  
  public function executeConsultar_estudiantes(sfWebRequest $request)
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
			$query = Doctrine_Query::create()->from('Estudiante');
			
			if($campo_busqueda != '') {
				$query->innerJoin('Estudiante.Usuario');
				$query->where('usu_login LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_nombres LIKE ?', '%'.$busqueda.'%');
				//$query->orWhere('pro_codigo LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_apellidos LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_e_mail LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_identificacion LIKE ?', '%'.$busqueda.'%');
				$query->andWhere('est_habilitado = TRUE');
			}
			
			$estudiantes = new sfDoctrinePager('Estudiante', $limit);
			$estudiantes->setQuery($query);
			$estudiantes->setPage($start);
			$estudiantes->init();

			foreach($estudiantes As $estudiante)
			{
				$datos[$fila]['est_codigo'] = $estudiante->getEstCodigo();
				$datos[$fila]['est_nombres'] = $estudiante->getEstNombres();
				$datos[$fila]['est_identificacion'] = $estudiante->getEstIdentificacion();
				$datos[$fila]['est_apellidos'] = $estudiante->getEstApellidos();

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
  
  public function executeConsultar_estudiantes_curso(sfWebRequest $request)
  {
		$salida='({"total":"0", "results":""})';
		$datos;
		$fila = 0;
		$campo_busqueda = $request->getParameter('campo_busqueda');
		$busqueda = $request->getParameter('busqueda');
		$codigo_curso = $request->getParameter('codigo_curso');
		try
		{  
			$query = Doctrine_Query::create()->from('Estudiante');
			
			if($campo_busqueda != '') {
				$query->innerJoin('Estudiante.Curso');
				$query->innerJoin('Estudiante.Usuario');
				$query->where('usu_login LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_nombres LIKE ?', '%'.$busqueda.'%');
				//$query->orWhere('pro_codigo LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_apellidos LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_e_mail LIKE ?', '%'.$busqueda.'%');
				$query->orWhere('est_identificacion LIKE ?', '%'.$busqueda.'%');
				$query->andWhere('est_habilitado = TRUE');
				$query->andWhere('cur_codigo = '.$codigo_curso.'');
			}
			
			$estudiantes = new sfDoctrinePager('Estudiante', 200);
			$estudiantes->setQuery($query);
			$estudiantes->setPage(0);
			$estudiantes->init();

			foreach($estudiantes As $estudiante)
			{
				$datos[$fila]['est_codigo'] = $estudiante->getEstCodigo();
				$datos[$fila]['est_nombres'] = $estudiante->getEstNombres();
				$datos[$fila]['est_identificacion'] = $estudiante->getEstIdentificacion();
				$datos[$fila]['est_apellidos'] = $estudiante->getEstApellidos();

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
