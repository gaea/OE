<?php

/**
 * Ayuda filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAyudaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ayu_nombre'       => new sfWidgetFormFilterInput(),
      'ayu_penalizacion' => new sfWidgetFormFilterInput(),
      'ayu_cuerpo'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ayu_nombre'       => new sfValidatorPass(array('required' => false)),
      'ayu_penalizacion' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ayu_cuerpo'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ayuda_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ayuda';
  }

  public function getFields()
  {
    return array(
      'ayu_codigo'       => 'Number',
      'ayu_nombre'       => 'Text',
      'ayu_penalizacion' => 'Number',
      'ayu_cuerpo'       => 'Text',
    );
  }
}
