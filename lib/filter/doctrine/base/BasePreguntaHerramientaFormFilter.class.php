<?php

/**
 * PreguntaHerramienta filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePreguntaHerramientaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pre_her_codigo_herramienta' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Herramienta'), 'add_empty' => true)),
      'pre_her_codigo_pregunta'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'pre_her_codigo_herramienta' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Herramienta'), 'column' => 'her_codigo')),
      'pre_her_codigo_pregunta'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pregunta'), 'column' => 'pre_codigo')),
    ));

    $this->widgetSchema->setNameFormat('pregunta_herramienta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PreguntaHerramienta';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'pre_her_codigo_herramienta' => 'ForeignKey',
      'pre_her_codigo_pregunta'    => 'ForeignKey',
    );
  }
}
