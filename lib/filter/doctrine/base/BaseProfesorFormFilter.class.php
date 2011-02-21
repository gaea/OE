<?php

/**
 * Profesor filter form base class.
 *
 * @package    OE
 * @subpackage filter
 * @author     gaea
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pro_codigo_usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'pro_codigo_identificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Identificacion'), 'add_empty' => true)),
      'pro_nombres'               => new sfWidgetFormFilterInput(),
      'pro_apellidos'             => new sfWidgetFormFilterInput(),
      'pro_telefono'              => new sfWidgetFormFilterInput(),
      'pro_e_mail'                => new sfWidgetFormFilterInput(),
      'pro_habilitado'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'pro_url_imagen'            => new sfWidgetFormFilterInput(),
      'pro_identificacion'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'pro_codigo_usuario'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'usu_codigo')),
      'pro_codigo_identificacion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Identificacion'), 'column' => 'ide_codigo')),
      'pro_nombres'               => new sfValidatorPass(array('required' => false)),
      'pro_apellidos'             => new sfValidatorPass(array('required' => false)),
      'pro_telefono'              => new sfValidatorPass(array('required' => false)),
      'pro_e_mail'                => new sfValidatorPass(array('required' => false)),
      'pro_habilitado'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'pro_url_imagen'            => new sfValidatorPass(array('required' => false)),
      'pro_identificacion'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profesor';
  }

  public function getFields()
  {
    return array(
      'pro_codigo'                => 'Number',
      'pro_codigo_usuario'        => 'ForeignKey',
      'pro_codigo_identificacion' => 'ForeignKey',
      'pro_nombres'               => 'Text',
      'pro_apellidos'             => 'Text',
      'pro_telefono'              => 'Text',
      'pro_e_mail'                => 'Text',
      'pro_habilitado'            => 'Boolean',
      'pro_url_imagen'            => 'Text',
      'pro_identificacion'        => 'Text',
    );
  }
}
