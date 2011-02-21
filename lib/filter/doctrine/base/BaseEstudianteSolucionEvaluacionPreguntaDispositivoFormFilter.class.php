<?php

/**
 * EstudianteSolucionEvaluacionPreguntaDispositivo filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionPreguntaDispositivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'est_sol_eva_pre_dis_codigo_estudiante'  => new sfWidgetFormFilterInput(),
      'est_sol_eva_pre_dis_codigo_pregunta'    => new sfWidgetFormFilterInput(),
      'est_sol_eva_pre_dis_codigo_evaluacion'  => new sfWidgetFormFilterInput(),
      'est_sol_eva_pre_dis_codigo_dispositivo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dispositivo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'est_sol_eva_pre_dis_codigo_estudiante'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'est_sol_eva_pre_dis_codigo_pregunta'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'est_sol_eva_pre_dis_codigo_evaluacion'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'est_sol_eva_pre_dis_codigo_dispositivo' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Dispositivo'), 'column' => 'dis_codigo')),
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_pregunta_dispositivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacionPreguntaDispositivo';
  }

  public function getFields()
  {
    return array(
      'id'                                     => 'Number',
      'est_sol_eva_pre_dis_codigo_estudiante'  => 'Number',
      'est_sol_eva_pre_dis_codigo_pregunta'    => 'Number',
      'est_sol_eva_pre_dis_codigo_evaluacion'  => 'Number',
      'est_sol_eva_pre_dis_codigo_dispositivo' => 'ForeignKey',
    );
  }
}
