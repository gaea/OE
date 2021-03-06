<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('EvaluacionPreguntaAyuda', 'doctrine');

/**
 * BaseEvaluacionPreguntaAyuda
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $eva_pre_ayu_codigo_evaluacion
 * @property integer $eva_pre_ayu_codigo_pregunta
 * @property integer $eva_pre_ayu_codigo_ayuda
 * @property Ayuda $Ayuda
 * 
 * @method integer                 getId()                            Returns the current record's "id" value
 * @method integer                 getEvaPreAyuCodigoEvaluacion()     Returns the current record's "eva_pre_ayu_codigo_evaluacion" value
 * @method integer                 getEvaPreAyuCodigoPregunta()       Returns the current record's "eva_pre_ayu_codigo_pregunta" value
 * @method integer                 getEvaPreAyuCodigoAyuda()          Returns the current record's "eva_pre_ayu_codigo_ayuda" value
 * @method Ayuda                   getAyuda()                         Returns the current record's "Ayuda" value
 * @method EvaluacionPreguntaAyuda setId()                            Sets the current record's "id" value
 * @method EvaluacionPreguntaAyuda setEvaPreAyuCodigoEvaluacion()     Sets the current record's "eva_pre_ayu_codigo_evaluacion" value
 * @method EvaluacionPreguntaAyuda setEvaPreAyuCodigoPregunta()       Sets the current record's "eva_pre_ayu_codigo_pregunta" value
 * @method EvaluacionPreguntaAyuda setEvaPreAyuCodigoAyuda()          Sets the current record's "eva_pre_ayu_codigo_ayuda" value
 * @method EvaluacionPreguntaAyuda setAyuda()                         Sets the current record's "Ayuda" value
 * 
 * @package    OE
 * @subpackage model
 * @author     gaea
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvaluacionPreguntaAyuda extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('evaluacion_pregunta_ayuda');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('eva_pre_ayu_codigo_evaluacion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('eva_pre_ayu_codigo_pregunta', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('eva_pre_ayu_codigo_ayuda', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ayuda', array(
             'local' => 'eva_pre_ayu_codigo_ayuda',
             'foreign' => 'ayu_codigo'));
    }
}