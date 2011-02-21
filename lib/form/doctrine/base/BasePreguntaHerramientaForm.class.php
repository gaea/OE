<?php

/**
 * PreguntaHerramienta form base class.
 *
 * @method PreguntaHerramienta getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePreguntaHerramientaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'pre_her_codigo_herramienta' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Herramienta'), 'add_empty' => false)),
      'pre_her_codigo_pregunta'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'pre_her_codigo_herramienta' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Herramienta'))),
      'pre_her_codigo_pregunta'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'))),
    ));

    $this->widgetSchema->setNameFormat('pregunta_herramienta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PreguntaHerramienta';
  }

}
