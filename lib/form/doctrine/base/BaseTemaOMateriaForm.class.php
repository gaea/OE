<?php

/**
 * TemaOMateria form base class.
 *
 * @method TemaOMateria getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTemaOMateriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tom_codigo' => new sfWidgetFormInputHidden(),
      'tom_nombre' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'tom_codigo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('tom_codigo')), 'empty_value' => $this->getObject()->get('tom_codigo'), 'required' => false)),
      'tom_nombre' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tema_o_materia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TemaOMateria';
  }

}
