<?php

/**
 * Herramienta form base class.
 *
 * @method Herramienta getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHerramientaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'her_codigo' => new sfWidgetFormInputHidden(),
      'her_nombre' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'her_codigo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('her_codigo')), 'empty_value' => $this->getObject()->get('her_codigo'), 'required' => false)),
      'her_nombre' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('herramienta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Herramienta';
  }

}
