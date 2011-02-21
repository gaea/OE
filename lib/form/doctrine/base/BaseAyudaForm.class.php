<?php

/**
 * Ayuda form base class.
 *
 * @method Ayuda getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAyudaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ayu_codigo'       => new sfWidgetFormInputHidden(),
      'ayu_nombre'       => new sfWidgetFormTextarea(),
      'ayu_penalizacion' => new sfWidgetFormInputText(),
      'ayu_cuerpo'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ayu_codigo'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ayu_codigo')), 'empty_value' => $this->getObject()->get('ayu_codigo'), 'required' => false)),
      'ayu_nombre'       => new sfValidatorString(array('required' => false)),
      'ayu_penalizacion' => new sfValidatorNumber(array('required' => false)),
      'ayu_cuerpo'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ayuda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ayuda';
  }

}
