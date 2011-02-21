<?php

/**
 * Estudiante filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'est_codigo_usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'est_codigo_identificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Identificacion'), 'add_empty' => true)),
      'est_nombres'               => new sfWidgetFormFilterInput(),
      'est_apellidos'             => new sfWidgetFormFilterInput(),
      'est_telefono'              => new sfWidgetFormFilterInput(),
      'est_e_mail'                => new sfWidgetFormFilterInput(),
      'est_habilitado'            => new sfWidgetFormFilterInput(),
      'est_url_imagen'            => new sfWidgetFormFilterInput(),
      'pre_identificacion'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'est_codigo_usuario'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'usu_codigo')),
      'est_codigo_identificacion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Identificacion'), 'column' => 'ide_codigo')),
      'est_nombres'               => new sfValidatorPass(array('required' => false)),
      'est_apellidos'             => new sfValidatorPass(array('required' => false)),
      'est_telefono'              => new sfValidatorPass(array('required' => false)),
      'est_e_mail'                => new sfValidatorPass(array('required' => false)),
      'est_habilitado'            => new sfValidatorPass(array('required' => false)),
      'est_url_imagen'            => new sfValidatorPass(array('required' => false)),
      'pre_identificacion'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiante';
  }

  public function getFields()
  {
    return array(
      'est_codigo_usuario'        => 'ForeignKey',
      'est_codigo_identificacion' => 'ForeignKey',
      'est_codigo'                => 'Number',
      'est_nombres'               => 'Text',
      'est_apellidos'             => 'Text',
      'est_telefono'              => 'Text',
      'est_e_mail'                => 'Text',
      'est_habilitado'            => 'Text',
      'est_url_imagen'            => 'Text',
      'pre_identificacion'        => 'Text',
    );
  }
}
