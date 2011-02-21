<?php

/**
 * TipoPregunta filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipoPreguntaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tip_pre_nombre'    => new sfWidgetFormFilterInput(),
      'tip_pre_plantilla' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tip_pre_nombre'    => new sfValidatorPass(array('required' => false)),
      'tip_pre_plantilla' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_pregunta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoPregunta';
  }

  public function getFields()
  {
    return array(
      'tip_pre_codigo'    => 'Number',
      'tip_pre_nombre'    => 'Text',
      'tip_pre_plantilla' => 'Text',
    );
  }
}
