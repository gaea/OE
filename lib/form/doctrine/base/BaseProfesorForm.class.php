<?php

/**
 * Profesor form base class.
 *
 * @method Profesor getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pro_codigo'                => new sfWidgetFormInputHidden(),
      'pro_codigo_usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'pro_codigo_identificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Identificacion'), 'add_empty' => false)),
      'pro_nombres'               => new sfWidgetFormTextarea(),
      'pro_apellidos'             => new sfWidgetFormTextarea(),
      'pro_telefono'              => new sfWidgetFormTextarea(),
      'pro_e_mail'                => new sfWidgetFormTextarea(),
      'pro_habilitado'            => new sfWidgetFormInputCheckbox(),
      'pro_url_imagen'            => new sfWidgetFormTextarea(),
      'pro_identificacion'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'pro_codigo'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('pro_codigo')), 'empty_value' => $this->getObject()->get('pro_codigo'), 'required' => false)),
      'pro_codigo_usuario'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'pro_codigo_identificacion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Identificacion'))),
      'pro_nombres'               => new sfValidatorString(array('required' => false)),
      'pro_apellidos'             => new sfValidatorString(array('required' => false)),
      'pro_telefono'              => new sfValidatorString(array('required' => false)),
      'pro_e_mail'                => new sfValidatorString(array('required' => false)),
      'pro_habilitado'            => new sfValidatorBoolean(array('required' => false)),
      'pro_url_imagen'            => new sfValidatorString(array('required' => false)),
      'pro_identificacion'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profesor';
  }

}
