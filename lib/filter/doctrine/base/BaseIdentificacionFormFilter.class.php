<?php

/**
 * Identificacion filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseIdentificacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ide_tipo'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ide_tipo'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('identificacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Identificacion';
  }

  public function getFields()
  {
    return array(
      'ide_codigo' => 'Number',
      'ide_tipo'   => 'Text',
    );
  }
}
