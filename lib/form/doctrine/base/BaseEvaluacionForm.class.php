<?php

/**
 * Evaluacion form base class.
 *
 * @method Evaluacion getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eva_codigo'                => new sfWidgetFormInputHidden(),
      'eva_codigo_profesor'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => false)),
      'eva_codigo_tema_materia'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TemaOMateria'), 'add_empty' => true)),
      'eva_nombre'                => new sfWidgetFormTextarea(),
      'eva_hora_inicio'           => new sfWidgetFormTime(),
      'eva_hora_fin'              => new sfWidgetFormTime(),
      'eva_numero_personas_grupo' => new sfWidgetFormInputText(),
      'eva_publico'               => new sfWidgetFormInputCheckbox(),
      'eva_fecha'                 => new sfWidgetFormDate(),
      'eva_numero_intentos'       => new sfWidgetFormInputText(),
      'eva_mostrar_solucion'      => new sfWidgetFormInputCheckbox(),
      'eva_barajar_preguntas'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'eva_codigo'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('eva_codigo')), 'empty_value' => $this->getObject()->get('eva_codigo'), 'required' => false)),
      'eva_codigo_profesor'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'))),
      'eva_codigo_tema_materia'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TemaOMateria'), 'required' => false)),
      'eva_nombre'                => new sfValidatorString(array('required' => false)),
      'eva_hora_inicio'           => new sfValidatorTime(array('required' => false)),
      'eva_hora_fin'              => new sfValidatorTime(array('required' => false)),
      'eva_numero_personas_grupo' => new sfValidatorInteger(array('required' => false)),
      'eva_publico'               => new sfValidatorBoolean(array('required' => false)),
      'eva_fecha'                 => new sfValidatorDate(array('required' => false)),
      'eva_numero_intentos'       => new sfValidatorInteger(array('required' => false)),
      'eva_mostrar_solucion'      => new sfValidatorBoolean(array('required' => false)),
      'eva_barajar_preguntas'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evaluacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Evaluacion';
  }

}
