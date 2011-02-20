<?php

/**
 * gestion_profesores actions.
 *
 * @package    OE
 * @subpackage gestion_profesores
 * @author     Your name here
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

		try
		{  
			$profesoresTable =  Doctrine_Core::getTable('Profesor');  
			$profesores =  $profesoresTable->findAll();  

			foreach($profesores As $profesor)
			{
				$datos[$fila]['pro_codigo_usuario'] = $profesor->getCodigoUsuario();
				$datos[$fila]['usu_login'] = $profesor->getUsuario()->getLogin();
				$datos[$fila]['pro_codigo'] = $profesor->getCodigo();
				$datos[$fila]['pro_nombres'] = $profesor->getNombres();

				//$identificacion = IdentificacionPeer::retrieveByPK($profesor->getCodigoIdentificacion());
				$identificacionTable =  Doctrine_Core::getTable('Identificacion');  
				$identificacion = $identificacionTable->find($profesor->getCodigoIdentificacion()); 
				
				
				
				//$datos[$fila]['ges_pro_identificacion'] = $profesor->getIdentificacion();
				$datos[$fila]['pro_identificacion_codigo'] = $identificacion->getCodigo();
				$datos[$fila]['pro_tipo_identificacion_nombre'] = $identificacion->getTipo();

				$datos[$fila]['pro_apellidos'] = $profesor->getApellidos();
				$datos[$fila]['pro_e-mail'] = $profesor->getEMail();
				$datos[$fila]['pro_telefono'] = $profesor->getTelefono();
				$datos[$fila]['pro_url-image'] = $profesor->getUrlImagen();

				$datos[$fila]['pro_habilitado'] = $profesor->getHabilitado();

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
		$salida = "";
		
		try
		{
			$usuario = new Usuario();
			$usuario->setLogin($request->getParameter('usu_login'));
			$usuario->setPassword($request->getParameter('usu_password'));
			$usuario->save();
			
			$profesor = new Profesor();
			$profesor->setUsuario($usuario);
			$profesor->setCodigoIdentificacion('1');	
			$profesor->setNombres($request->getParameter('pro_nombres'));
			$profesor->setApellidos($request->getParameter('pro_apellidos'));
			$profesor->setTelefono($request->getParameter('pro_telefono'));
			$profesor->setEMail($request->getParameter('pro_e-mail'));
			if($request->getParameter('pro_habilitado') == 'true')
			{
				$profesor->setHabilitado($request->getParameter('pro_habilitado'));
			}
			else
			{
				$profesor->setHabilitado(false);
			}
			
			$nombre_carpeta = "uploads/".$usuario->getLogin();
			
			if(!is_dir($nombre_carpeta))
			{
				mkdir($nombre_carpeta, 0777, true);
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
					$profesor->setUrlImagen($nombre_carpeta."/".$nombre);
					$profesor->save();
					$salida = "({success: true, mensaje:'El profesor fue creado exitosamente'})";
				}
			}

			return $this->renderText($salida);
		}
		catch (Exception $exception)
		{
			$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar profesor ' , error: '".$exception->getMessage()."'}})";
			return $this->renderText($salida);
		}
	}
	
	/*public function executeCrearCancion(sfWebRequest $request)
  {
	$salida	='';

	try
	{  
		$nombre_carpeta = "uploads";

		if(!is_dir($nombre_carpeta))
		{
			mkdir($nombre_carpeta, 0777, true);
		}

		sleep(2);

		$nombre = $_FILES['can_archivo']['name'];//$iv_nombre;//
		$tamano = $_FILES['can_archivo']['size'];
		$tipo = $_FILES['can_archivo']['type'];
		$temporal = $_FILES['can_archivo']['tmp_name'];

		if(file_exists($nombre_carpeta."/".$nombre))
		{
			$salida = "({success: false, errors: { reason: 'Ya existe el archivo con el mismo nombre en la base de datos'}})";
		}
		else
		{
			if($tamano > 2100000)//$tamano > algo 1000000 aprox 1mega
			{
				$salida = "({success: false, errors: { reason: 'El archivo exede el limite de tamano'}})";
			}
			else
			{

			$copio=copy($temporal, "uploads/".$nombre);

			if($copio)
			{
				$atributos_cancion = GetAllMP3info($temporal);
				//playtime_string, fileformat
				$cancion = new Cancion();
				$cancion->setNombre($atributos_cancion['id3']['id3v1']['title']);//$cancion->setNombre($this->getRequestParameter('can_nombre'));//
				$cancion->setAutor($atributos_cancion['id3']['id3v1']['artist']);//$cancion->setAutor($this->getRequestParameter('can_autor'));
				$cancion->setAlbum($atributos_cancion['id3']['id3v1']['album']);//$cancion->setAlbum($this->getRequestParameter('can_album'));
				$cancion->setFechaDePublicacion($atributos_cancion['id3']['id3v1']['year']);//$cancion->setFechaDePublicacion($this->getRequestParameter('can_fecha_de_publicacion'));
				$cancion->setDuracion($atributos_cancion['playtime_string']);//$cancion->setDuracion($this->getRequestParameter('can_duracion'));
				$cancion->setUrl("uploads/".$nombre);
				$cancion->setHabilitada($this->getRequestParameter('can_habilitada'));
				$cancion->setPrecio($this->getRequestParameter('can_precio'));
				$cancion->setRanking($this->getRequestParameter('can_ranking'));
				$cancion->save();	

				$salida = "({success: true, mensaje:'La canci&oacute;n fue creada exitosamente'})";
				return $this->renderText($salida);
			}
			else
			{
				$salida = "({success: false, errors: { reason: 'No se puede copiar Canci&oacute;n para subir'}})";
			}

			//}
		}
	}
	catch (Exception $exception)
	{
		$salida = "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en gestionar Canci&oacute;n ' , error: '".$exception->getMessage()."'}})";
		return $this->renderText($salida);
	}

	return $this->renderText($salida);
  }*/
}
