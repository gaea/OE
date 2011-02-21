<?php

/**
 * Evaluacion filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEvaluacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eva_codigo_profesor'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'eva_codigo_tema_materia'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TemaOMateria'), 'add_empty' => true)),
      'eva_nombre'                => new sfWidgetFormFilterInput(),
      'eva_hora_inicio'           => new sfWidgetFormFilterInput(),
      'eva_hora_fin'              => new sfWidgetFormFilterInput(),
      'eva_numero_personas_grupo' => new sfWidgetFormFilterInput(),
      'eva_publico'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'eva_fecha'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'eva_numero_intentos'       => new sfWidgetFormFilterInput(),
      'eva_mostrar_solucion'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'eva_barajar_preguntas'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'eva_codigo_profesor'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesor'), 'column' => 'pro_codigo')),
      'eva_codigo_tema_materia'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TemaOMateria'), 'column' => 'tom_codigo')),
      'eva_nombre'                => new sfValidatorPass(array('required' => false)),
      'eva_hora_inicio'           => new sfValidatorPass(array('required' => false)),
      'eva_hora_fin'              => new sfValidatorPass(array('required' => false)),
      'eva_numero_personas_grupo' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'eva_publico'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'eva_fecha'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'eva_numero_intentos'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'eva_mostrar_solucion'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'eva_barajar_preguntas'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('evaluacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Evaluacion';
  }

  public function getFields()
  {
    return array(
      'eva_codigo'                => 'Number',
      'eva_codigo_profesor'       => 'ForeignKey',
      'eva_codigo_tema_materia'   => 'ForeignKey',
      'eva_nombre'                => 'Text',
      'eva_hora_inicio'           => 'Text',
      'eva_hora_fin'              => 'Text',
      'eva_numero_personas_grupo' => 'Number',
      'eva_publico'               => 'Boolean',
      'eva_fecha'                 => 'Date',
      'eva_numero_intentos'       => 'Number',
      'eva_mostrar_solucion'      => 'Boolean',
      'eva_barajar_preguntas'     => 'Boolean',
    );
  }
}
