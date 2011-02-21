<?php

/**
 * TemaOMateria filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTemaOMateriaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tom_nombre' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tom_nombre' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tema_o_materia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TemaOMateria';
  }

  public function getFields()
  {
    return array(
      'tom_codigo' => 'Number',
      'tom_nombre' => 'Text',
    );
  }
}
