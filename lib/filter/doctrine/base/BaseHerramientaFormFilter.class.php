<?php

/**
 * Herramienta filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHerramientaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'her_nombre' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'her_nombre' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('herramienta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Herramienta';
  }

  public function getFields()
  {
    return array(
      'her_codigo' => 'Number',
      'her_nombre' => 'Text',
    );
  }
}
