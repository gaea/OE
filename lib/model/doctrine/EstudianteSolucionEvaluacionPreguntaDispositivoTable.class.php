<?php


class EstudianteSolucionEvaluacionPreguntaDispositivoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EstudianteSolucionEvaluacionPreguntaDispositivo');
    }
}