<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PreguntaHerramienta', 'doctrine');

/**
 * BasePreguntaHerramienta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $pre_her_codigo_herramienta
 * @property integer $pre_her_codigo_pregunta
 * @property Herramienta $Herramienta
 * @property Pregunta $Pregunta
 * 
 * @method integer             getId()                         Returns the current record's "id" value
 * @method integer             getPreHerCodigoHerramienta()    Returns the current record's "pre_her_codigo_herramienta" value
 * @method integer             getPreHerCodigoPregunta()       Returns the current record's "pre_her_codigo_pregunta" value
 * @method Herramienta         getHerramienta()                Returns the current record's "Herramienta" value
 * @method Pregunta            getPregunta()                   Returns the current record's "Pregunta" value
 * @method PreguntaHerramienta setId()                         Sets the current record's "id" value
 * @method PreguntaHerramienta setPreHerCodigoHerramienta()    Sets the current record's "pre_her_codigo_herramienta" value
 * @method PreguntaHerramienta setPreHerCodigoPregunta()       Sets the current record's "pre_her_codigo_pregunta" value
 * @method PreguntaHerramienta setHerramienta()                Sets the current record's "Herramienta" value
 * @method PreguntaHerramienta setPregunta()                   Sets the current record's "Pregunta" value
 * 
 * @package    OE
 * @subpackage model
 * @author     gaea
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePreguntaHerramienta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pregunta_herramienta');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('pre_her_codigo_herramienta', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pre_her_codigo_pregunta', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Herramienta', array(
             'local' => 'pre_her_codigo_herramienta',
             'foreign' => 'her_codigo'));

        $this->hasOne('Pregunta', array(
             'local' => 'pre_her_codigo_pregunta',
             'foreign' => 'pre_codigo'));
    }
}