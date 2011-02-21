<?php

/**
 * EstudianteSolucionEvaluacion filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_estudiante' => new sfWidgetFormFilterInput(),
      'codigo_pregunta'   => new sfWidgetFormFilterInput(),
      'codigo_evaluacion' => new sfWidgetFormFilterInput(),
      'codigo_ayuda'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ayuda'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'codigo_estudiante' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_pregunta'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_evaluacion' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_ayuda'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ayuda'), 'column' => 'ayu_codigo')),
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacion';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'codigo_estudiante' => 'Number',
      'codigo_pregunta'   => 'Number',
      'codigo_evaluacion' => 'Number',
      'codigo_ayuda'      => 'ForeignKey',
    );
  }
}
