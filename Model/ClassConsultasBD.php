<?php

include_once(__DIR__.'/../Config/ClassConexion.php');

include_once(__DIR__.'/../Controller/Entidades/ClassENCUESTA.php');
include_once(__DIR__.'/../Controller/Entidades/ClassTAREA.php');
include_once(__DIR__.'/../Controller/Entidades/ClassUSUARIO.php');
include_once(__DIR__.'/../Controller/Entidades/ClassUSUARIO_ENCUESTA.php');
include_once(__DIR__.'/../Controller/Entidades/ClassAsignacionTarea.php');

class ClassConsultasBD
{
    public function InsertarUsuario(ClassUSUARIO $oUsuario)
    {
        $oConexion = new ClassConexion();

        $SQL = "INSERT INTO usuario(nombre,correo,clave,tipo) VALUES (?,?,?,?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "ssss",
            $oUsuario->nombre,
            $oUsuario->correo,
            $oUsuario->clave,
            $oUsuario->tipo
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function InsertarTarea(ClassTAREA $oTarea)
    {
        $oConexion = new ClassConexion();

        $SQL = "INSERT INTO tarea(titulo) VALUES (?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "s",
            $oTarea->titulo
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function InsertarEncuesta(ClassENCUESTA $oEncuesta)
    {
        $oConexion = new ClassConexion();

        $SQL = "INSERT INTO encuesta(descripcion,idtarea) VALUES (?,?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "si",
            $oEncuesta->descripcion,
            $oEncuesta->idtarea
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function InsertarUsuarioEncuesta(ClassUSUARIO_ENCUESTA $oUsuarioEncuesta)
    {
        $oConexion = new ClassConexion();

        $SQL = "INSERT INTO usuarioencuesta(idusuario,idencuesta,estado) VALUES (?,?,?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "iis",
            $oUsuarioEncuesta->idusuario,
            $oUsuarioEncuesta->idencuesta,
            $oUsuarioEncuesta->estado
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function ConsultarUsuario()
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM usuario";
        $Resultado = $oConexion->Conectar->query($SQL);

        $Lista = array();

        while($Row = $Resultado->fetch_assoc())
        {
            $oUsuario = new ClassUSUARIO();

            $oUsuario->idusuario = $Row['idusuario'];
            $oUsuario->nombre = $Row['nombre'];
            $oUsuario->correo = $Row['correo'];
            $oUsuario->clave = $Row['clave'];
            $oUsuario->tipo = $Row['tipo'];

            $Lista[] = $oUsuario;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    public function ConsultarTarea()
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM tarea";
        $Resultado = $oConexion->Conectar->query($SQL);

        $Lista = array();

        while($Row = $Resultado->fetch_assoc())
        {
            $oTarea= new ClassTAREA();

            $oTarea->idtarea = $Row['idtarea'];
            $oTarea->titulo = $Row['titulo'];

            $Lista[] = $oTarea;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    public function ConsultarEncuesta()
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM encuesta";
        $Resultado = $oConexion->Conectar->query($SQL);

        $Lista = array();

        while($Row = $Resultado->fetch_assoc())
        {
            $oEncuesta= new ClassENCUESTA();

            $oEncuesta->idencuesta = $Row['idencuesta'];
            $oEncuesta->descripcion = $Row['descripcion'];
            $oEncuesta->idtarea = $Row['idtarea'];

            $Lista[] = $oEncuesta;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    public function ConsultarUsuario_Encuesta()
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM usuarioencuesta";
        $Resultado = $oConexion->Conectar->query($SQL);

        $Lista = array();

        while($Row = $Resultado->fetch_assoc())
        {
            $oUsuario_Encuesta= new ClassUSUARIO_ENCUESTA();

            $oUsuario_Encuesta->idusuario = $Row['idusuario'];
            $oUsuario_Encuesta->idencuesta = $Row['idencuesta'];
            $oUsuario_Encuesta->estado = $Row['estado'];

            $Lista[] = $oUsuario_Encuesta;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    
    public function AsignarTarea(ClassAsignacionTarea $oAT)
    {
        $oConexion = new ClassConexion();

        $SQL = "CALL asignarEncuestas(?,?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "ii",
            $oAT->idusuario,
            $oAT->idtarea
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function ConsultarAsignarTarea()
    {
        $oConexion = new ClassConexion();

        $SQL = "CALL asignarEncuestas(?,?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        //pendiente

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }
}