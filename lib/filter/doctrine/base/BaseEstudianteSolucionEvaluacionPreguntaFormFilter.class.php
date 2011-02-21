<?php

/**
 * EstudianteSolucionEvaluacionPregunta filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionPreguntaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_pregunta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacionPregunta';
  }

  public function getFields()
  {
    return array(
      'est_sol_eva_pre_codigo_estudiante' => 'Number',
      'est_sol_eva_pre_codigo_pregunta'   => 'Number',
      'est_sol_eva_pre_codigo_evaluacion' => 'Number',
    );
  }
}
