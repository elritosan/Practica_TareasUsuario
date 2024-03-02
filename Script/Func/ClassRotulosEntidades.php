<?php

include_once(__DIR__.'/../../Model/ClassConsultasBD.php');

class ClassRotulosEntidades
{
    public function RetornarRotulo_Usuario($Id)
    {
        $oBD = new ClassConsultasBD();

        $Lista = $oBD->ConsultarUsuario();

        $Rotulo = "";

        foreach ($Lista as $x) 
        {
            if ($x->idusuario == $Id) 
            {
                $Rotulo = $x->nombre;
                break;
            }
        }

        return $Rotulo;
    }

    public function RetornarRotulo_Tarea($Id)
    {
        $oBD = new ClassConsultasBD();

        $Lista = $oBD->ConsultarTarea();

        $Rotulo = "";

        foreach ($Lista as $x)
        {
            if ($x->idtarea == $Id) 
            {
                $Rotulo = $x->titulo;
                break;
            }
        }

        return $Rotulo;
    }

    public function RetornarRotulo_Encuesta($Id)
    {
        $oBD = new ClassConsultasBD();

        $Lista = $oBD->ConsultarEncuesta();

        $Rotulo = "";

        foreach ($Lista as $x) 
        {
            if ($x->idencuesta == $Id) 
            {
                $Rotulo = $x->descripcion;
                break;
            }
        }

        return $Rotulo;
    }
}