<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('EvaluacionPregunta', 'doctrine');

/**
 * BaseEvaluacionPregunta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $codigo_evaluacion
 * @property integer $codigo_pregunta
 * @property Pregunta $Pregunta
 * @property Evaluacion $Evaluacion
 * 
 * @method integer            getCodigoEvaluacion()  Returns the current record's "codigo_evaluacion" value
 * @method integer            getCodigoPregunta()    Returns the current record's "codigo_pregunta" value
 * @method Pregunta           getPregunta()          Returns the current record's "Pregunta" value
 * @method Evaluacion         getEvaluacion()        Returns the current record's "Evaluacion" value
 * @method EvaluacionPregunta setCodigoEvaluacion()  Sets the current record's "codigo_evaluacion" value
 * @method EvaluacionPregunta setCodigoPregunta()    Sets the current record's "codigo_pregunta" value
 * @method EvaluacionPregunta setPregunta()          Sets the current record's "Pregunta" value
 * @method EvaluacionPregunta setEvaluacion()        Sets the current record's "Evaluacion" value
 * 
 * @package    OE
 * @subpackage model
 * @author     gaea
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvaluacionPregunta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('evaluacion_pregunta');
        $this->hasColumn('codigo_evaluacion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('codigo_pregunta', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pregunta', array(
             'local' => 'codigo_pregunta',
             'foreign' => 'codigo'));

        $this->hasOne('Evaluacion', array(
             'local' => 'codigo_evaluacion',
             'foreign' => 'codigo'));
    }
}