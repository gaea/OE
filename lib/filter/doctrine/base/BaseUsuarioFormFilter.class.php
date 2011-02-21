<?php

/**
 * Usuario filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usu_login'    => new sfWidgetFormFilterInput(),
      'usu_password' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'usu_login'    => new sfValidatorPass(array('required' => false)),
      'usu_password' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

  public function getFields()
  {
    return array(
      'usu_codigo'   => 'Number',
      'usu_login'    => 'Text',
      'usu_password' => 'Text',
    );
  }
}
