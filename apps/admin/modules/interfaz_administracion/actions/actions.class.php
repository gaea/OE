<?php

/**
 * interfaz_administracion actions.
 *
 * @package    OE
 * @subpackage interfaz_administracion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class interfaz_administracionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->getUser()->setCulture('es_CO');
  }
}
