<?php

/**
 * admin_tema_o_materia module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage admin_tema_o_materia
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAdmin_tema_o_materiaGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%tom_codigo%% - %%tom_nombre%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Admin tema o materia List';
  }

  public function getEditTitle()
  {
    return 'Edit Admin tema o materia';
  }

  public function getNewTitle()
  {
    return 'New Admin tema o materia';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'tom_codigo',  1 => 'tom_nombre',);
  }

  public function getFieldsDefault()
  {
    return array(
      'tom_codigo' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'tom_nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'tom_codigo' => array(),
      'tom_nombre' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'tom_codigo' => array(),
      'tom_nombre' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'tom_codigo' => array(),
      'tom_nombre' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'tom_codigo' => array(),
      'tom_nombre' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'tom_codigo' => array(),
      'tom_nombre' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'TemaOMateriaForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'TemaOMateriaFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
