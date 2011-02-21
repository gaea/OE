<?php

/**
 * Identificacion form base class.
 *
 * @method Identificacion getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseIdentificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ide_codigo' => new sfWidgetFormInputHidden(),
      'ide_tipo'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ide_codigo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ide_codigo')), 'empty_value' => $this->getObject()->get('ide_codigo'), 'required' => false)),
      'ide_tipo'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('identificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Identificacion';
  }

}
