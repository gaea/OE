<?php

/**
 * Dispositivo form base class.
 *
 * @method Dispositivo getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDispositivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dis_codigo' => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'dis_codigo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('dis_codigo')), 'empty_value' => $this->getObject()->get('dis_codigo'), 'required' => false)),
      'nombre'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dispositivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dispositivo';
  }

}
