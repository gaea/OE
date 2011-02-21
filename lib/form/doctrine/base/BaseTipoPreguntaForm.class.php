<?php

/**
 * TipoPregunta form base class.
 *
 * @method TipoPregunta getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoPreguntaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tip_pre_codigo'    => new sfWidgetFormInputHidden(),
      'tip_pre_nombre'    => new sfWidgetFormTextarea(),
      'tip_pre_plantilla' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'tip_pre_codigo'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('tip_pre_codigo')), 'empty_value' => $this->getObject()->get('tip_pre_codigo'), 'required' => false)),
      'tip_pre_nombre'    => new sfValidatorString(array('required' => false)),
      'tip_pre_plantilla' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_pregunta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoPregunta';
  }

}
