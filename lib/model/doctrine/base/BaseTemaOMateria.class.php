<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TemaOMateria', 'doctrine');

/**
 * BaseTemaOMateria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $codigo
 * @property string $nombre
 * @property Doctrine_Collection $Evaluacion
 * @property Doctrine_Collection $Pregunta
 * 
 * @method integer             getCodigo()     Returns the current record's "codigo" value
 * @method string              getNombre()     Returns the current record's "nombre" value
 * @method Doctrine_Collection getEvaluacion() Returns the current record's "Evaluacion" collection
 * @method Doctrine_Collection getPregunta()   Returns the current record's "Pregunta" collection
 * @method TemaOMateria        setCodigo()     Sets the current record's "codigo" value
 * @method TemaOMateria        setNombre()     Sets the current record's "nombre" value
 * @method TemaOMateria        setEvaluacion() Sets the current record's "Evaluacion" collection
 * @method TemaOMateria        setPregunta()   Sets the current record's "Pregunta" collection
 * 
 * @package    OE
 * @subpackage model
 * @author     gaea
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTemaOMateria extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tema_o_materia');
        $this->hasColumn('codigo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'tema_o_materia_codigo',
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Evaluacion', array(
             'local' => 'codigo',
             'foreign' => 'codigo_tema_materia'));

        $this->hasMany('Pregunta', array(
             'local' => 'codigo',
             'foreign' => 'codigo_tema_o_materia'));
    }
}