<?php

/**
 * EvaluacionPregunta form base class.
 *
 * @method EvaluacionPregunta getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluacionPreguntaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eva_pre_codigo_evaluacion' => new sfWidgetFormInputHidden(),
      'eva_pre_codigo_pregunta'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'eva_pre_codigo_evaluacion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('eva_pre_codigo_evaluacion')), 'empty_value' => $this->getObject()->get('eva_pre_codigo_evaluacion'), 'required' => false)),
      'eva_pre_codigo_pregunta'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('eva_pre_codigo_pregunta')), 'empty_value' => $this->getObject()->get('eva_pre_codigo_pregunta'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evaluacion_pregunta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EvaluacionPregunta';
  }

}
