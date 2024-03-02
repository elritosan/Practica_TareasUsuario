<?php

include_once(__DIR__.'/ClassENCUESTA.php');
include_once(__DIR__.'/ClassTAREA.php');
include_once(__DIR__.'/ClassUSUARIO.php');
include_once(__DIR__.'/ClassUSUARIO_ENCUESTA.php');

class ClassEntidadesUNIVERSAL
{
    public ClassENCUESTA $oEncuesta;
    public ClassTAREA $oTarea;
    public ClassUSUARIO $oUsuario;
    public ClassUSUARIO_ENCUESTA $oUsuarioEncuesta;
}