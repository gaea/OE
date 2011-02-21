<?php

/**
 * Pregunta filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePreguntaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pre_codigo_profesor'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'pre_codigo_tema_o_materia' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TemaOMateria'), 'add_empty' => true)),
      'pre_codigo_tipo_pregunta'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPregunta'), 'add_empty' => true)),
      'pre_cuerpo'                => new sfWidgetFormFilterInput(),
      'pre_solucion'              => new sfWidgetFormFilterInput(),
      'pre_publico'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'pre_codigo_profesor'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesor'), 'column' => 'pro_codigo')),
      'pre_codigo_tema_o_materia' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TemaOMateria'), 'column' => 'tom_codigo')),
      'pre_codigo_tipo_pregunta'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoPregunta'), 'column' => 'tip_pre_codigo')),
      'pre_cuerpo'                => new sfValidatorPass(array('required' => false)),
      'pre_solucion'              => new sfValidatorPass(array('required' => false)),
      'pre_publico'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('pregunta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pregunta';
  }

  public function getFields()
  {
    return array(
      'pre_codigo'                => 'Number',
      'pre_codigo_profesor'       => 'ForeignKey',
      'pre_codigo_tema_o_materia' => 'ForeignKey',
      'pre_codigo_tipo_pregunta'  => 'ForeignKey',
      'pre_cuerpo'                => 'Text',
      'pre_solucion'              => 'Text',
      'pre_publico'               => 'Boolean',
    );
  }
}
