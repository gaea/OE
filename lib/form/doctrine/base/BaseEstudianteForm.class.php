<?php

/**
 * Estudiante form base class.
 *
 * @method Estudiante getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'est_codigo_usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'est_codigo_identificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Identificacion'), 'add_empty' => false)),
      'est_codigo'                => new sfWidgetFormInputHidden(),
      'est_nombres'               => new sfWidgetFormTextarea(),
      'est_apellidos'             => new sfWidgetFormTextarea(),
      'est_telefono'              => new sfWidgetFormTextarea(),
      'est_e_mail'                => new sfWidgetFormTextarea(),
      'est_habilitado'            => new sfWidgetFormTextarea(),
      'est_url_imagen'            => new sfWidgetFormTextarea(),
      'pre_identificacion'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'est_codigo_usuario'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'est_codigo_identificacion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Identificacion'))),
      'est_codigo'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('est_codigo')), 'empty_value' => $this->getObject()->get('est_codigo'), 'required' => false)),
      'est_nombres'               => new sfValidatorString(array('required' => false)),
      'est_apellidos'             => new sfValidatorString(array('required' => false)),
      'est_telefono'              => new sfValidatorString(array('required' => false)),
      'est_e_mail'                => new sfValidatorString(array('required' => false)),
      'est_habilitado'            => new sfValidatorString(array('required' => false)),
      'est_url_imagen'            => new sfValidatorString(array('required' => false)),
      'pre_identificacion'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiante';
  }

}
