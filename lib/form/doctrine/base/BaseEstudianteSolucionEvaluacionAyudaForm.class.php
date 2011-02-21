<?php

/**
 * EstudianteSolucionEvaluacionAyuda form base class.
 *
 * @method EstudianteSolucionEvaluacionAyuda getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteSolucionEvaluacionAyudaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_estudiante' => new sfWidgetFormInputHidden(),
      'codigo_pregunta'   => new sfWidgetFormInputHidden(),
      'codigo_evaluacion' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'codigo_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_estudiante')), 'empty_value' => $this->getObject()->get('codigo_estudiante'), 'required' => false)),
      'codigo_pregunta'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_pregunta')), 'empty_value' => $this->getObject()->get('codigo_pregunta'), 'required' => false)),
      'codigo_evaluacion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_evaluacion')), 'empty_value' => $this->getObject()->get('codigo_evaluacion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_solucion_evaluacion_ayuda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteSolucionEvaluacionAyuda';
  }

}
