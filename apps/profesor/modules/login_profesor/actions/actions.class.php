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
		
		try{
			/*	
				$query = Doctrine_Query::create()->from('Usuario ');
				$query->innerJoin('Profesor');

				$query->where('Usuario.usu_login = ?', $usu_login);
				$query->andWhere('Usuario.usu_password = ?', $usu_password);
				$query->andWhere('Usuario.usu_codigo = Profesor.pro_codigo_usuario);				
				
				$users = $query->fetchArray();
 
				foreach ($users[0]['Groups'] as $group) {
					$salida = "({success: true, mensaje:'profesor'})";
				}
				*/
				
			
			if($usu_login=='maryit'){
				$salida = "({success: true, mensaje:'profesor'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en autenticar".$excepcion."'}})";
		}

		return $this->renderText($salida);
  }
}
