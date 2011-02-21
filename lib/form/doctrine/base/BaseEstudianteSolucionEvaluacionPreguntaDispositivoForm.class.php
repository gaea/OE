<?php

/**
 * EstudianteSolucionEvaluacionPreguntaDispositivo form base class.
 *
 * @method EstudianteSolucionEvaluacionPreguntaDispositivo getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionPreguntaDispositivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                     => new sfWidgetFormInputHidden(),
      'est_sol_eva_pre_dis_codigo_estudiante'  => new sfWidgetFormInputText(),
      'est_sol_eva_pre_dis_codigo_pregunta'    => new sfWidgetFormInputText(),
      'est_sol_eva_pre_dis_codigo_evaluacion'  => new sfWidgetFormInputText(),
      'est_sol_eva_pre_dis_codigo_dispositivo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dispositivo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'est_sol_eva_pre_dis_codigo_estudiante'  => new sfValidatorInteger(array('required' => false)),
      'est_sol_eva_pre_dis_codigo_pregunta'    => new sfValidatorInteger(array('required' => false)),
      'est_sol_eva_pre_dis_codigo_evaluacion'  => new sfValidatorInteger(array('required' => false)),
      'est_sol_eva_pre_dis_codigo_dispositivo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dispositivo'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_pregunta_dispositivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacionPreguntaDispositivo';
  }

}
