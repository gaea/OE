<?php

/**
 * EstudianteSolucionEvaluacionPregunta form base class.
 *
 * @method EstudianteSolucionEvaluacionPregunta getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionPreguntaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'est_sol_eva_pre_codigo_estudiante' => new sfWidgetFormInputHidden(),
      'est_sol_eva_pre_codigo_pregunta'   => new sfWidgetFormInputHidden(),
      'est_sol_eva_pre_codigo_evaluacion' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'est_sol_eva_pre_codigo_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('est_sol_eva_pre_codigo_estudiante')), 'empty_value' => $this->getObject()->get('est_sol_eva_pre_codigo_estudiante'), 'required' => false)),
      'est_sol_eva_pre_codigo_pregunta'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('est_sol_eva_pre_codigo_pregunta')), 'empty_value' => $this->getObject()->get('est_sol_eva_pre_codigo_pregunta'), 'required' => false)),
      'est_sol_eva_pre_codigo_evaluacion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('est_sol_eva_pre_codigo_evaluacion')), 'empty_value' => $this->getObject()->get('est_sol_eva_pre_codigo_evaluacion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_pregunta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacionPregunta';
  }

}
