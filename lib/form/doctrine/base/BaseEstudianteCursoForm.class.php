<?php

/**
 * EstudianteCurso form base class.
 *
 * @method EstudianteCurso getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'est_cur_codigo_curso'      => new sfWidgetFormInputHidden(),
      'est_cur_codigo_estudiante' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'est_cur_codigo_curso'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('est_cur_codigo_curso')), 'empty_value' => $this->getObject()->get('est_cur_codigo_curso'), 'required' => false)),
      'est_cur_codigo_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('est_cur_codigo_estudiante')), 'empty_value' => $this->getObject()->get('est_cur_codigo_estudiante'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstudianteCurso';
  }

}
