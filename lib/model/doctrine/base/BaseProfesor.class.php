<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Profesor', 'doctrine');

/**
 * BaseProfesor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $pro_codigo
 * @property integer $pro_codigo_usuario
 * @property integer $pro_codigo_identificacion
 * @property string $pro_nombres
 * @property string $pro_apellidos
 * @property string $pro_telefono
 * @property string $pro_e_mail
 * @property boolean $pro_habilitado
 * @property string $pro_url_imagen
 * @property string $pro_identificacion
 * @property Identificacion $Identificacion
 * @property Usuario $Usuario
 * @property Doctrine_Collection $Curso
 * @property Doctrine_Collection $Evaluacion
 * @property Doctrine_Collection $Pregunta
 * 
 * @method integer             getProCodigo()                 Returns the current record's "pro_codigo" value
 * @method integer             getProCodigoUsuario()          Returns the current record's "pro_codigo_usuario" value
 * @method integer             getProCodigoIdentificacion()   Returns the current record's "pro_codigo_identificacion" value
 * @method string              getProNombres()                Returns the current record's "pro_nombres" value
 * @method string              getProApellidos()              Returns the current record's "pro_apellidos" value
 * @method string              getProTelefono()               Returns the current record's "pro_telefono" value
 * @method string              getProEMail()                  Returns the current record's "pro_e_mail" value
 * @method boolean             getProHabilitado()             Returns the current record's "pro_habilitado" value
 * @method string              getProUrlImagen()              Returns the current record's "pro_url_imagen" value
 * @method string              getProIdentificacion()         Returns the current record's "pro_identificacion" value
 * @method Identificacion      getIdentificacion()            Returns the current record's "Identificacion" value
 * @method Usuario             getUsuario()                   Returns the current record's "Usuario" value
 * @method Doctrine_Collection getCurso()                     Returns the current record's "Curso" collection
 * @method Doctrine_Collection getEvaluacion()                Returns the current record's "Evaluacion" collection
 * @method Doctrine_Collection getPregunta()                  Returns the current record's "Pregunta" collection
 * @method Profesor            setProCodigo()                 Sets the current record's "pro_codigo" value
 * @method Profesor            setProCodigoUsuario()          Sets the current record's "pro_codigo_usuario" value
 * @method Profesor            setProCodigoIdentificacion()   Sets the current record's "pro_codigo_identificacion" value
 * @method Profesor            setProNombres()                Sets the current record's "pro_nombres" value
 * @method Profesor            setProApellidos()              Sets the current record's "pro_apellidos" value
 * @method Profesor            setProTelefono()               Sets the current record's "pro_telefono" value
 * @method Profesor            setProEMail()                  Sets the current record's "pro_e_mail" value
 * @method Profesor            setProHabilitado()             Sets the current record's "pro_habilitado" value
 * @method Profesor            setProUrlImagen()              Sets the current record's "pro_url_imagen" value
 * @method Profesor            setProIdentificacion()         Sets the current record's "pro_identificacion" value
 * @method Profesor            setIdentificacion()            Sets the current record's "Identificacion" value
 * @method Profesor            setUsuario()                   Sets the current record's "Usuario" value
 * @method Profesor            setCurso()                     Sets the current record's "Curso" collection
 * @method Profesor            setEvaluacion()                Sets the current record's "Evaluacion" collection
 * @method Profesor            setPregunta()                  Sets the current record's "Pregunta" collection
 * 
 * @package    OE
 * @subpackage model
 * @author     gaea
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfesor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profesor');
        $this->hasColumn('pro_codigo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'profesor_pro_codigo',
             'length' => 4,
             ));
        $this->hasColumn('pro_codigo_usuario', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pro_codigo_identificacion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pro_nombres', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('pro_apellidos', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('pro_telefono', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('pro_e_mail', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('pro_habilitado', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('pro_url_imagen', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('pro_identificacion', 'string', null, array(
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
        $this->hasOne('Identificacion', array(
             'local' => 'pro_codigo_identificacion',
             'foreign' => 'ide_codigo'));

        $this->hasOne('Usuario', array(
             'local' => 'pro_codigo_usuario',
             'foreign' => 'usu_codigo'));

        $this->hasMany('Curso', array(
             'local' => 'pro_codigo',
             'foreign' => 'cur_codigo_profesor'));

        $this->hasMany('Evaluacion', array(
             'local' => 'pro_codigo',
             'foreign' => 'eva_codigo_profesor'));

        $this->hasMany('Pregunta', array(
             'local' => 'pro_codigo',
             'foreign' => 'pre_codigo_profesor'));
    }
}