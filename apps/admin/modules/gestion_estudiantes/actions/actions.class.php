<?php

/**
 * gestion_estudiantes actions.
 *
 * @package    OE
 * @subpackage gestion_estudiantes
 * @author     gaea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestion_estudiantesActions extends sfActions
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
			
			switch ($campo_busqueda) {
				case 'nombres':
					$query->where('est_nombres LIKE ?', '%'.$busqueda.'%');
					break;
				case 'apellidos':
					$query->where('est_apellidos LIKE ?', '%'.$busqueda.'%');
					break;
				case 'login':
					$query->innerJoin('Estudiante.Usuario');
					$query->where('usu_login LIKE ?', '%'.$busqueda.'%');
					break;
				case 'e-mail':
					$query->where('est_e_mail LIKE ?', '%'.$busqueda.'%');
					break;
				case 'identificacion':
					$query->where('est_identificacion LIKE ?', '%'.$busqueda.'%');
					break;
					case 'habilitados':
					$query->where('est_habilitado = TRUE');
					break;
				case 'desabilitados':
					$query->where('est_habilitado = FALSE');
					break;
				case 'todos': // la instruccion andWhere no me funciona logicamente asi que probe con orWhere y tambien es un metodo de Doctrine_Query
					$query->where('est_nombres LIKE ?', '%'.$busqueda.'%');
					$query->orWhere('est_apellidos LIKE ?', '%'.$busqueda.'%');
					$query->orWhere('est_e_mail LIKE ?', '%'.$busqueda.'%');
					$query->orWhere('est_identificacion LIKE ?', '%'.$busqueda.'%');
					break;
			}
			
			$estudiantes = new sfDoctrinePager('Estudiante', $limit);
			$estudiantes->setQuery($query);
			$estudiantes->setPage($start);
			$estudiantes->init();
			

			foreach($estudiantes As $estudiante)
			{
				$datos[$fila]['est_codigo_usuario'] = $estudiante->getEstCodigoUsuario();
				$datos[$fila]['usu_login'] = $estudiante->getUsuario()->getUsuLogin();
				$datos[$fila]['est_codigo'] = $estudiante->getEstCodigo();
				$datos[$fila]['est_nombres'] = $estudiante->getEstNombres();

				//$identificacion = IdentificacionPeer::retrieveByPK($estudiante->getEstCodigoIdentificacion());
				$identificacionTable =  Doctrine_Core::getTable('Identificacion');  
				$identificacion = $identificacionTable->find($estudiante->getEstCodigoIdentificacion()); 
				if($identificacion)
				{
					$datos[$fila]['ide_codigo'] = $identificacion->getIdeCodigo();
					$datos[$fila]['ide_tipo'] = $identificacion->getIdeTipo();
				}
				
				$datos[$fila]['est_identificacion'] = $estudiante->getEstIdentificacion();

				$datos[$fila]['est_apellidos'] = $estudiante->getEstApellidos();
				$datos[$fila]['est_e-mail'] = $estudiante->getEstEMail();
				$datos[$fila]['est_telefono'] = $estudiante->getEstTelefono();
				$datos[$fila]['est_url-image'] = $estudiante->getEstUrlImagen();

				$datos[$fila]['est_habilitado'] = $estudiante->getEstHabilitado();

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
			$this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar los estudiantes ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
	}
	
	public function executeGuardar_estudiante(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: 'desconocido'}})";
		
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection();  
		$connection->beginTransaction();  
		
		try
		{
			$usuario = new Usuario();
			$usuario->setUsuLogin($request->getParameter('usu_login'));
			$usuario->setUsuPassword(md5($request->getParameter('usu_password')));
			$usuario->save();
			
			$estudiante = new estudiante();
			$estudiante->setUsuario($usuario);
			$estudiante->setEstCodigoIdentificacion($request->getParameter('ide_codigo'));
			$estudiante->setEstIdentificacion($request->getParameter('est_identificacion'));	
			$estudiante->setEstNombres($request->getParameter('est_nombres'));
			$estudiante->setEstApellidos($request->getParameter('est_apellidos'));
			$estudiante->setEstTelefono($request->getParameter('est_telefono'));
			$estudiante->setEstEMail($request->getParameter('est_e-mail'));
			$estudiante->setEstHabilitado(true);
			
			/*if($request->getParameter('est_habilitado') == 'true')
			{
				$estudiante->setEstHabilitado($request->getParameter('est_habilitado'));
			}
			else
			{
				$estudiante->setEstHabilitado(false);
			}*/
			
			$nombre_carpeta = "uploads/".$usuario->getUsuLogin();
			
			if(!is_dir($nombre_carpeta))
			{
				if(!mkdir($nombre_carpeta, 0777, true))
				{
					$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: 'no se pudo crear la carpeta del usuario'}})";
				}
			}
			
			sleep(2);
			$nombre = $_FILES['est_url-imagen']['name'];
			$tamano = $_FILES['est_url-imagen']['size'];
			$tipo = $_FILES['est_url-imagen']['type'];
			$temporal = $_FILES['est_url-imagen']['tmp_name'];
			

			if($tamano > 2100000)//$tamano >  1000000 aprox 1mega
			{
				$salida = "El archivo excede el limite de tama&ntilde;o";
				
			}
			else
			{
				$copio=move_uploaded_file($temporal, $nombre_carpeta."/".$nombre);

				if($copio)
				{
					$estudiante->setEstUrlImagen($nombre_carpeta."/".$nombre);
					
					$salida = "({success: true, mensaje:'El estudiante fue creado exitosamente'})";
				}
			}
			
			$estudiante->save();
			
			$connection->commit();
			$salida = "({success: true, mensaje:'El estudiante fue creado exitosamente'})";
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeActualizar_estudiante(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al actualizar el estudiante estudiante ' , error: 'desconocido'}})";
		
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection(); 
		$connection->beginTransaction();  
		
		try
		{
			$codigo_estudiante = $request->getParameter('codigo_estudiante');
			$estudianteTable =  Doctrine_Core::getTable('estudiante');  
			$estudiante = $estudianteTable->find($codigo_estudiante); 
			
			if($estudiante)
			{
				$usuario = $estudiante->getUsuario();
				$usuario->setUsuLogin($request->getParameter('usu_login'));
				$usuario->setUsuPassword(md5($request->getParameter('usu_password')));
				$estudiante->setUsuario($usuario);
				$usuario->save();
				
				$estudiante->setEstCodigoIdentificacion($request->getParameter('ide_codigo'));
				$estudiante->setEstIdentificacion($request->getParameter('est_identificacion'));	
				$estudiante->setEstNombres($request->getParameter('est_nombres'));
				$estudiante->setEstApellidos($request->getParameter('est_apellidos'));
				$estudiante->setEstTelefono($request->getParameter('est_telefono'));
				$estudiante->setEstEMail($request->getParameter('est_e-mail'));
				
				/*if($request->getParameter('est_habilitado') == 'true')
				{
					$estudiante->setEstHabilitado($request->getParameter('est_habilitado'));
				}
				else
				{
					$estudiante->setEstHabilitado(false);
				}*/
				
				$nombre_carpeta = "uploads/".$usuario->getUsuLogin();
				/*
				if(!is_dir($nombre_carpeta))
				{
					if(!mkdir($nombre_carpeta, 0777, true))
					{
						$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: 'no se pudo crear la carpeta del usuario'}})";
					}
				}*/
				
				sleep(2);
				$nombre = $_FILES['est_url-imagen']['name'];
				$tamano = $_FILES['est_url-imagen']['size'];
				$tipo = $_FILES['est_url-imagen']['type'];
				$temporal = $_FILES['est_url-imagen']['tmp_name'];
				

				if($tamano > 2100000)//$tamano >  1000000 aprox 1mega
				{
					$salida = "El archivo excede el limite de tama&ntilde;o";
					
				}
				else
				{
					$copio=move_uploaded_file($temporal, $nombre_carpeta."/".$nombre);

					if($copio)
					{
						$estudiante->setEstUrlImagen($nombre_carpeta."/".$nombre);
						
						$salida = "({success: true, mensaje:'El estudiante fue creado exitosamente'})";
					}
				}
				
				$estudiante->save();
				$salida = "({success: true, mensaje:'El estudiante fue actualizado exitosamente'})";
			}
			$connection->commit();
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeConsultar_tipos_identificacion(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		try
		{
			$identificacionTable =  Doctrine_Core::getTable('Identificacion');  
			$tipos_identificacion =  $identificacionTable->getIdentificacionArray();
		
			if(count($tipos_identificacion) > 0)
			{
				$jsonresult = json_encode($tipos_identificacion);
				$salida = '({"total":"'.count($tipos_identificacion).'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $exception)
		{
			$this->renderText("({success: false, errors: { reason: 'Hubo una excepci&oacute;n en listar los tipos de identificacion ' , error: '".$exception->getMessage()."'}})");
		}

		return $this->renderText($salida);
	}
	
	public function executeHabilitar_estudiante(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al habilitar el estudiante estudiante ' , error: 'desconocido'}})";
		
		try
		{
			$codigo_estudiante = $request->getParameter('codigo_estudiante');
			$estudianteTable =  Doctrine_Core::getTable('estudiante');  
			$estudiante = $estudianteTable->find($codigo_estudiante); 
			
			if($estudiante)
			{
				$estudiante->setEstHabilitado(true);
				$estudiante->save();
				
				$salida = "({success: true, mensaje:'El estudiante fue habilitado exitosamente'})";
			}
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeDesabilitar_estudiante(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al habilitar el estudiante estudiante ' , error: 'desconocido'}})";
		
		try
		{
			$codigo_estudiante = $request->getParameter('codigo_estudiante');
			$estudianteTable =  Doctrine_Core::getTable('estudiante');  
			$estudiante = $estudianteTable->find($codigo_estudiante); 
			
			if($estudiante)
			{
				$estudiante->setEstHabilitado(false);
				$estudiante->save();
				
				$salida = "({success: true, mensaje:'El estudiante fue habilitado exitosamente'})";
			}
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar estudiante ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeImportar_estudiante(sfWebRequest $request)
	{
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection(); 
		$connection->beginTransaction(); 
		
		try
		{
			$texto="";
			sleep(2);
			$nombre = $_FILES['est_importar']['name'];
			$tamano = $_FILES['est_importar']['size'];
			$tipo = $_FILES['est_importar']['type'];
			$temporal = $_FILES['est_importar']['tmp_name'];
			
			if($tamano > 2100000)//$tamano >  1000000 aprox 1mega
			{
				$salida = "El archivo excede el limite de tama&ntilde;o";
				
			}
			else
			{
				$archivo_csv = fopen($temporal,"r");

				while ($linea= fgets($archivo_csv))
				{
					$texto.=$linea;
					$campos = explode(";", $linea);
					//$linea = str_replace($cadena,"<b>$cadena</b>",$linea);
					$usuario = new Usuario();
					$usuario->setUsuLogin($campos[0]);
					$usuario->setUsuPassword(md5($campos[1]));
					$usuario->save();
					
					$estudiante = new estudiante();
					$estudiante->setUsuario($usuario);
					//$estudiante->setEstCodigoIdentificacion(1);/// 1 para la cedula
					//$estudiante->setEstIdentificacion();	
					$estudiante->setEstNombres($campos[2]);
					$estudiante->setEstApellidos($campos[3]);
					//$estudiante->setEstTelefono();
					$estudiante->setEstEMail($campos[4]);
					$estudiante->setEstHabilitado(true);
					
					$estudiante->save();
				}
			}
			$connection->commit();
			$salida = "({success: true, mensaje:'La importacion fue concluida exitosamente'})";
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en proceso de importacion ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeExportar_estudiante(sfWebRequest $request)
	{
		try
		{
			$estudiantesTable =  Doctrine_Core::getTable('estudiante'); 
			$estudiantes =  $estudiantesTable->findAll();
			
			$cvs_estudiantes = "";

			foreach($estudiantes As $estudiante)
			{
				$cvs_estudiantes .= $estudiante->getUsuario()->getUsuLogin().";";
				$cvs_estudiantes .= $estudiante->getEstCodigo().";";
				$cvs_estudiantes .= $estudiante->getEstNombres().";";
				$cvs_estudiantes .= $estudiante->getEstApellidos()."\n";
			}
			
			$this->getContext()->getResponse()->setContentType('text/csv');
			
			$this->getContext()->getResponse()->setHttpHeader('Content-Disposition', 'inline;filename=estudiantes_'.date("Y-m-d_Hi").'.csv;');
			return $this->renderText($cvs_estudiantes);
		
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en proceso de importacion ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
}
