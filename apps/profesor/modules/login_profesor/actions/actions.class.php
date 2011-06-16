<?php

/**
 * login_profesor actions.
 *
 * @package    OE
 * @subpackage login_profesor
 * @author     gustavo espinosa
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class login_profesorActions extends sfActions
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
  
   /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAutenticar(sfWebRequest $request)
  {
		$salida = "({success: true, mensaje:'El usuario o password incorrectos'})";
		$usu_login=$this->getRequestParameter('usu_login');
		$usu_password=$this->getRequestParameter('usu_password');
		
		try
		{
				$query = Doctrine_Query::create();
				$query->from('Profesor');
				$query->innerJoin('Profesor.Usuario');

				$query->where('Usuario.usu_login = ?', $usu_login);
				$query->andWhere('Usuario.usu_password = ?', md5($usu_password));		
				
				$profesores = $query->fetchArray();
 
				foreach ($profesores as $profesor) 
				{
					$this->getUser()->setCulture('es_CO');
					$this->getUser()->setAttribute('pro_codigo', $profesor['pro_codigo']);
					$this->getUser()->setAttribute('usu_login', $profesor['Usuario']['usu_login']);
					$this->getUser()->setAttribute('pro_nombres', $profesor['pro_nombres']);
					$this->getUser()->setAttribute('pro_apellidos', $profesor['pro_apellidos']);
					
					$this->getUser()->setAuthenticated(true);
					$this->getUser()->addCredential('profesor');
					
					$salida = "({success: true, mensaje:'profesor'})";
				}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en autenticar".$excepcion."'}})";
		}

		return $this->renderText($salida);
  }
  
	public function executeDesautenticar()
	{
		if($this->getUser()->isAuthenticated())
		{
			$this->getUser()->setAuthenticated(false);
			$this->getUser()->clearCredentials();
			$this->getUser()->getAttributeHolder()->clear();
		}
		return $this->renderText("{success: true, mensaje: 'El usuario ha terminado'}");
	}
}
