<?php

/**
 * EvaluacionPreguntaAyuda form base class.
 *
 * @method EvaluacionPreguntaAyuda getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluacionPreguntaAyudaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'eva_pre_ayu_codigo_evaluacion' => new sfWidgetFormInputText(),
      'eva_pre_ayu_codigo_pregunta'   => new sfWidgetFormInputText(),
      'eva_pre_ayu_codigo_ayuda'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ayuda'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eva_pre_ayu_codigo_evaluacion' => new sfValidatorInteger(array('required' => false)),
      'eva_pre_ayu_codigo_pregunta'   => new sfValidatorInteger(array('required' => false)),
      'eva_pre_ayu_codigo_ayuda'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ayuda'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evaluacion_pregunta_ayuda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EvaluacionPreguntaAyuda';
  }

}
