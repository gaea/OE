<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Identificacion', 'doctrine');

/**
 * BaseIdentificacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $codigo
 * @property string $tipo
 * @property Doctrine_Collection $Estudiante
 * @property Doctrine_Collection $Profesor
 * 
 * @method integer             getCodigo()     Returns the current record's "codigo" value
 * @method string              getTipo()       Returns the current record's "tipo" value
 * @method Doctrine_Collection getEstudiante() Returns the current record's "Estudiante" collection
 * @method Doctrine_Collection getProfesor()   Returns the current record's "Profesor" collection
 * @method Identificacion      setCodigo()     Sets the current record's "codigo" value
 * @method Identificacion      setTipo()       Sets the current record's "tipo" value
 * @method Identificacion      setEstudiante() Sets the current record's "Estudiante" collection
 * @method Identificacion      setProfesor()   Sets the current record's "Profesor" collection
 * 
 * @package    OE
 * @subpackage model
 * @author     gaea
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIdentificacion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('identificacion');
        $this->hasColumn('codigo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'identificacion_codigo',
             'length' => 4,
             ));
        $this->hasColumn('tipo', 'string', null, array(
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
        $this->hasMany('Estudiante', array(
             'local' => 'codigo',
             'foreign' => 'codigo_identificacion'));

        $this->hasMany('Profesor', array(
             'local' => 'codigo',
             'foreign' => 'codigo_identificacion'));
    }
}