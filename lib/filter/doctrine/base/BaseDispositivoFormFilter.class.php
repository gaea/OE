<?php

/**
 * Dispositivo filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDispositivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dispositivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dispositivo';
  }

  public function getFields()
  {
    return array(
      'dis_codigo' => 'Number',
      'nombre'     => 'Text',
    );
  }
}
