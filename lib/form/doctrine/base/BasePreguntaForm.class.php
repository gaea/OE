<?php

/**
 * Pregunta form base class.
 *
 * @method Pregunta getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePreguntaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pre_codigo'                => new sfWidgetFormInputHidden(),
      'pre_codigo_profesor'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => false)),
      'pre_codigo_tema_o_materia' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TemaOMateria'), 'add_empty' => true)),
      'pre_codigo_tipo_pregunta'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPregunta'), 'add_empty' => true)),
      'pre_cuerpo'                => new sfWidgetFormTextarea(),
      'pre_solucion'              => new sfWidgetFormTextarea(),
      'pre_publico'               => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'pre_codigo'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('pre_codigo')), 'empty_value' => $this->getObject()->get('pre_codigo'), 'required' => false)),
      'pre_codigo_profesor'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'))),
      'pre_codigo_tema_o_materia' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TemaOMateria'), 'required' => false)),
      'pre_codigo_tipo_pregunta'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPregunta'), 'required' => false)),
      'pre_cuerpo'                => new sfValidatorString(array('required' => false)),
      'pre_solucion'              => new sfValidatorString(array('required' => false)),
      'pre_publico'               => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pregunta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pregunta';
  }

}
