<?php

/**
 * gestion_profesores actions.
 *
 * @package    OE
 * @subpackage gestion_profesores
 * @author     gaea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestion_profesoresActions extends sfActions
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
			//--$profesoresTable =  Doctrine_Core::getTable('Profesor'); 
			
			
			$query = Doctrine_Query::create() ->from('Profesor ');
		 	//$query = Doctrine::getTable('Planillascatastro')->queryPlanillasCatastroBusqueda();
			
			if($campo_busqueda == 'nombres')
			{
			$query =$query->where('pro_nombres LIKE ?', '%'.$busqueda.'%');
			//	$profesores =  $profesoresTable->findByProNombres($busqueda); 
			}
			else
			{
			//	$profesores =  $profesoresTable->findAll(); 
			}
			$profesores = new sfDoctrinePager('Profesor', 20);//limit 20
			$profesores->setQuery($query);	
			//$profesores->getQuery();
			$profesores->setPage(0);//start page
			$profesores->init();

			foreach($profesores as $profesor)
			{
				$datos[$fila]['pro_codigo_usuario'] = $profesor->getProCodigoUsuario();
				$datos[$fila]['usu_login'] = $profesor->getUsuario()->getUsuLogin();
				$datos[$fila]['pro_codigo'] = $profesor->getProCodigo();
				$datos[$fila]['pro_nombres'] = $profesor->getProNombres();
		
				//$identificacion = IdentificacionPeer::retrieveByPK($profesor->getProCodigoIdentificacion());
				$identificacionTable =  Doctrine_Core::getTable('Identificacion');  
				$identificacion = $identificacionTable->find($profesor->getProCodigoIdentificacion()); 
				if($identificacion)
				{
					$datos[$fila]['ide_codigo'] = $identificacion->getIdeCodigo();
					$datos[$fila]['ide_tipo'] = $identificacion->getIdeTipo();
				}
				
				$datos[$fila]['pro_identificacion'] = $profesor->getProIdentificacion();

				$datos[$fila]['pro_apellidos'] = $profesor->getProApellidos();
				$datos[$fila]['pro_e-mail'] = $profesor->getProEMail();
				$datos[$fila]['pro_telefono'] = $profesor->getProTelefono();
				$datos[$fila]['pro_url-image'] = $profesor->getProUrlImagen();

				$datos[$fila]['pro_habilitado'] = $profesor->getProHabilitado();

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
	
	public function executeGuardar_profesor(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: 'desconocido'}})";
		
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection();  
		$connection->beginTransaction();  
		
		try
		{
			$usuario = new Usuario();
			$usuario->setUsuLogin($request->getParameter('usu_login'));
			$usuario->setUsuPassword(md5($request->getParameter('usu_password')));
			$usuario->save();
			
			$profesor = new Profesor();
			$profesor->setUsuario($usuario);
			$profesor->setProCodigoIdentificacion($request->getParameter('ide_codigo'));
			$profesor->setProIdentificacion($request->getParameter('pro_identificacion'));	
			$profesor->setProNombres($request->getParameter('pro_nombres'));
			$profesor->setProApellidos($request->getParameter('pro_apellidos'));
			$profesor->setProTelefono($request->getParameter('pro_telefono'));
			$profesor->setProEMail($request->getParameter('pro_e-mail'));
			$profesor->setProHabilitado(true);
			
			/*if($request->getParameter('pro_habilitado') == 'true')
			{
				$profesor->setProHabilitado($request->getParameter('pro_habilitado'));
			}
			else
			{
				$profesor->setProHabilitado(false);
			}*/
			
			$nombre_carpeta = "uploads/".$usuario->getUsuLogin();
			
			if(!is_dir($nombre_carpeta))
			{
				if(!mkdir($nombre_carpeta, 0777, true))
				{
					$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: 'no se pudo crear la carpeta del usuario'}})";
				}
			}
			
			sleep(2);
			$nombre = $_FILES['pro_url-imagen']['name'];
			$tamano = $_FILES['pro_url-imagen']['size'];
			$tipo = $_FILES['pro_url-imagen']['type'];
			$temporal = $_FILES['pro_url-imagen']['tmp_name'];
			

			if($tamano > 2100000)//$tamano >  1000000 aprox 1mega
			{
				$salida = "El archivo excede el limite de tama&ntilde;o";
				
			}
			else
			{
				$copio=move_uploaded_file($temporal, $nombre_carpeta."/".$nombre);

				if($copio)
				{
					$profesor->setProUrlImagen($nombre_carpeta."/".$nombre);
					
					$salida = "({success: true, mensaje:'El profesor fue creado exitosamente'})";
				}
			}
			
			$profesor->save();
			
			$connection->commit();
			$salida = "({success: true, mensaje:'El profesor fue creado exitosamente'})";
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeActualizar_profesor(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al actualizar el profesor profesor ' , error: 'desconocido'}})";
		
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection(); 
		$connection->beginTransaction();  
		
		try
		{
			$codigo_profesor = $request->getParameter('codigo_profesor');
			$profesorTable =  Doctrine_Core::getTable('Profesor');  
			$profesor = $profesorTable->find($codigo_profesor); 
			
			if($profesor)
			{
				$usuario = $profesor->getUsuario();
				$usuario->setUsuLogin($request->getParameter('usu_login'));
				$usuario->setUsuPassword(md5($request->getParameter('usu_password')));
				$profesor->setUsuario($usuario);
				$usuario->save();
				
				$profesor->setProCodigoIdentificacion($request->getParameter('ide_codigo'));
				$profesor->setProIdentificacion($request->getParameter('pro_identificacion'));	
				$profesor->setProNombres($request->getParameter('pro_nombres'));
				$profesor->setProApellidos($request->getParameter('pro_apellidos'));
				$profesor->setProTelefono($request->getParameter('pro_telefono'));
				$profesor->setProEMail($request->getParameter('pro_e-mail'));
				
				/*if($request->getParameter('pro_habilitado') == 'true')
				{
					$profesor->setProHabilitado($request->getParameter('pro_habilitado'));
				}
				else
				{
					$profesor->setProHabilitado(false);
				}*/
				
				$nombre_carpeta = "uploads/".$usuario->getUsuLogin();
				/*
				if(!is_dir($nombre_carpeta))
				{
					if(!mkdir($nombre_carpeta, 0777, true))
					{
						$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: 'no se pudo crear la carpeta del usuario'}})";
					}
				}*/
				
				sleep(2);
				$nombre = $_FILES['pro_url-imagen']['name'];
				$tamano = $_FILES['pro_url-imagen']['size'];
				$tipo = $_FILES['pro_url-imagen']['type'];
				$temporal = $_FILES['pro_url-imagen']['tmp_name'];
				

				if($tamano > 2100000)//$tamano >  1000000 aprox 1mega
				{
					$salida = "El archivo excede el limite de tama&ntilde;o";
					
				}
				else
				{
					$copio=move_uploaded_file($temporal, $nombre_carpeta."/".$nombre);

					if($copio)
					{
						$profesor->setProUrlImagen($nombre_carpeta."/".$nombre);
						
						$salida = "({success: true, mensaje:'El profesor fue creado exitosamente'})";
					}
				}
				
				$profesor->save();
				$salida = "({success: true, mensaje:'El profesor fue actualizado exitosamente'})";
			}
			$connection->commit();
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$connection->rollback();
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: '".$exception->getMessage()."'}})";
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
	
	public function executeHabilitar_profesor(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al habilitar el profesor profesor ' , error: 'desconocido'}})";
		
		try
		{
			$codigo_profesor = $request->getParameter('codigo_profesor');
			$profesorTable =  Doctrine_Core::getTable('Profesor');  
			$profesor = $profesorTable->find($codigo_profesor); 
			
			if($profesor)
			{
				$profesor->setProHabilitado(true);
				$profesor->save();
				
				$salida = "({success: true, mensaje:'El profesor fue habilitado exitosamente'})";
			}
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeDesabilitar_profesor(sfWebRequest $request)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al habilitar el profesor profesor ' , error: 'desconocido'}})";
		
		try
		{
			$codigo_profesor = $request->getParameter('codigo_profesor');
			$profesorTable =  Doctrine_Core::getTable('Profesor');  
			$profesor = $profesorTable->find($codigo_profesor); 
			
			if($profesor)
			{
				$profesor->setProHabilitado(false);
				$profesor->save();
				
				$salida = "({success: true, mensaje:'El profesor fue habilitado exitosamente'})";
			}
			
			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	public function executeImportar_profesor(sfWebRequest $request)
	{
		$connection = Doctrine_Manager::getInstance()->getCurrentConnection(); 
		$connection->beginTransaction(); 
		
		try
		{
			$texto="";
			sleep(2);
			$nombre = $_FILES['pro_importar']['name'];
			$tamano = $_FILES['pro_importar']['size'];
			$tipo = $_FILES['pro_importar']['type'];
			$temporal = $_FILES['pro_importar']['tmp_name'];
			
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
					
					$profesor = new Profesor();
					$profesor->setUsuario($usuario);
					//$profesor->setProCodigoIdentificacion(1);/// 1 para la cedula
					//$profesor->setProIdentificacion();	
					$profesor->setProNombres($campos[2]);
					$profesor->setProApellidos($campos[3]);
					//$profesor->setProTelefono();
					$profesor->setProEMail($campos[4]);
					$profesor->setProHabilitado(true);
					
					$profesor->save();
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
	
	public function executeExportar_profesor(sfWebRequest $request)
	{
		try
		{
			$profesoresTable =  Doctrine_Core::getTable('Profesor'); 
			$profesores =  $profesoresTable->findAll();
			
			$cvs_profesores = "";

			foreach($profesores As $profesor)
			{
				$cvs_profesores .= $profesor->getUsuario()->getUsuLogin().";";
				$cvs_profesores .= $profesor->getProCodigo().";";
				$cvs_profesores .= $profesor->getProNombres().";";
				$cvs_profesores .= $profesor->getProApellidos()."\n";
			}
			
			$this->getContext()->getResponse()->setContentType('text/csv');
			
			$this->getContext()->getResponse()->setHttpHeader('Content-Disposition', 'inline;filename=Profesores_'.date("Y-m-d_Hi").'.csv;');
			return $this->renderText($cvs_profesores);
		
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en proceso de importacion ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
}
