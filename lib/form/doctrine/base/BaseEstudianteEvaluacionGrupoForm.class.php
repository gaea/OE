<?php

/**
 * EstudianteEvaluacionGrupo form base class.
 *
 * @method EstudianteEvaluacionGrupo getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteEvaluacionGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'est_eva_gru_codigo_estudiante' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'add_empty' => true)),
      'est_eva_gru_codigo_evaluacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluacion'), 'add_empty' => true)),
      'est_eva_gru_numero_grupo'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'est_eva_gru_codigo_estudiante' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'required' => false)),
      'est_eva_gru_codigo_evaluacion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluacion'), 'required' => false)),
      'est_eva_gru_numero_grupo'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_evaluacion_grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteEvaluacionGrupo';
  }

}
