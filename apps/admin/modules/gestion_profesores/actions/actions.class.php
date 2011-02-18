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
		  $profesores = ProfesorPeer::doSelect();

		  foreach($profesores As $profesor)
		  {
				$datos[$fila]['ges_pro_codigo_usuario'] = $profesor->getCodigoUsuario();
				$datos[$fila]['ges_pro_codigo'] = $profesor->getCodigo();
				$datos[$fila]['ges_pro_nombres'] = $profesor->getNombres();

				$identificacion = IdentificacionPeer::retrieveByPK($profesor->getCodigoIdentificacion());
				//$datos[$fila]['ges_pro_identificacion'] = $profesor->getCodigoIdentificacion();
				$datos[$fila]['ges_pro_identificacion_codigo'] = $identificacion->getCodigo();
				$datos[$fila]['ges_pro_tipo_identificacion_nombre'] = $identificacion->getNombre();

				$datos[$fila]['ges_pro_apellidos'] = $persona->getIdentificacion();
				$datos[$fila]['ges_pro_e-mail'] = $persona->getDireccion();
				$datos[$fila]['ges_pro_telefono'] = $persona->getTelefono();
				$datos[$fila]['ges_pro_url-image'] = $persona->getEMail();

				$datos[$fila]['ges_pro_habilitado'] = $admin->getCodigo();

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
		return $this->renderText($salida);
	}
}
