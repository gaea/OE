<?php

/**
 * Usuario form base class.
 *
 * @method Usuario getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usu_codigo'   => new sfWidgetFormInputHidden(),
      'usu_login'    => new sfWidgetFormTextarea(),
      'usu_password' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'usu_codigo'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('usu_codigo')), 'empty_value' => $this->getObject()->get('usu_codigo'), 'required' => false)),
      'usu_login'    => new sfValidatorString(array('required' => false)),
      'usu_password' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}
