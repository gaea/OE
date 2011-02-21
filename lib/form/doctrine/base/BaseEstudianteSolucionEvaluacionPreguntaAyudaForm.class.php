<?php

/**
 * EstudianteSolucionEvaluacionPreguntaAyuda form base class.
 *
 * @method EstudianteSolucionEvaluacionPreguntaAyuda getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionPreguntaAyudaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                    => new sfWidgetFormInputHidden(),
      'est_sol_eva_pre_ayu_codigo_estudiante' => new sfWidgetFormInputText(),
      'est_sol_eva_pre_ayu_codigo_pregunta'   => new sfWidgetFormInputText(),
      'est_sol_eva_pre_ayu_codigo_evaluacion' => new sfWidgetFormInputText(),
      'est_sol_eva_pre_ayu_codigo_ayuda'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ayuda'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'est_sol_eva_pre_ayu_codigo_estudiante' => new sfValidatorInteger(array('required' => false)),
      'est_sol_eva_pre_ayu_codigo_pregunta'   => new sfValidatorInteger(array('required' => false)),
      'est_sol_eva_pre_ayu_codigo_evaluacion' => new sfValidatorInteger(array('required' => false)),
      'est_sol_eva_pre_ayu_codigo_ayuda'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ayuda'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_pregunta_ayuda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacionPreguntaAyuda';
  }

}
