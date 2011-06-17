<?php

/**
 * admin_tema_o_materia module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage admin_tema_o_materia
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAdmin_tema_o_materiaGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'tema_o_materia' : 'tema_o_materia_'.$action;
  }
}
