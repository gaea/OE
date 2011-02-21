<?php

/**
 * Curso form base class.
 *
 * @method Curso getObject() Returns the current form's model object
 *
 * @package    OE
 * @subpackage form
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cur_codigo' => new sfWidgetFormInputHidden(),
      'cur_nombre' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'cur_codigo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cur_codigo')), 'empty_value' => $this->getObject()->get('cur_codigo'), 'required' => false)),
      'cur_nombre' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Curso';
  }

}
