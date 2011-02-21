<?php

/**
 * EstudianteEvaluacionGrupo filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteEvaluacionGrupoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'est_eva_gru_codigo_estudiante' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'add_empty' => true)),
      'est_eva_gru_codigo_evaluacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluacion'), 'add_empty' => true)),
      'est_eva_gru_numero_grupo'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'est_eva_gru_codigo_estudiante' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estudiante'), 'column' => 'est_codigo')),
      'est_eva_gru_codigo_evaluacion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Evaluacion'), 'column' => 'eva_codigo')),
      'est_eva_gru_numero_grupo'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('estudiante_evaluacion_grupo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteEvaluacionGrupo';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'est_eva_gru_codigo_estudiante' => 'ForeignKey',
      'est_eva_gru_codigo_evaluacion' => 'ForeignKey',
      'est_eva_gru_numero_grupo'      => 'Number',
    );
  }
}
