<?php

include_once(__DIR__.'/../Config/ClassConexion.php');

include_once(__DIR__.'/../Controller/Entidades/ClassENCUESTA.php');
include_once(__DIR__.'/../Controller/Entidades/ClassTAREA.php');
include_once(__DIR__.'/../Controller/Entidades/ClassUSUARIO.php');
include_once(__DIR__.'/../Controller/Entidades/ClassUSUARIO_ENCUESTA.php');
include_once(__DIR__.'/../Controller/Entidades/ClassEntidadesUNIVERSAL.php');

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

        $SQL = "INSERT INTO usuarioencuesta(idusuario,idencuesta,estado,disponibilidad) VALUES (?,?,?,?)";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "iiss",
            $oUsuarioEncuesta->idusuario,
            $oUsuarioEncuesta->idencuesta,
            $oUsuarioEncuesta->estado,
            $oUsuarioEncuesta->disponibilidad
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
            $oUsuario_Encuesta->disponibilidad = $Row['disponibilidad'];

            $Lista[] = $oUsuario_Encuesta;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    public function EliminarUsuario($Id)
    {
        $oConexion = new ClassConexion();

        $SQL = "DELETE FROM usuario WHERE idusuario=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param("i",$Id);
        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function EliminarTarea($Id)
    {
        $oConexion = new ClassConexion();

        $SQL = "DELETE FROM tarea WHERE idtarea=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param("i",$Id);
        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function EliminarEncuesta($Id)
    {
        $oConexion = new ClassConexion();

        $SQL = "DELETE FROM encuesta WHERE idencuesta=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param("i",$Id);
        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function ValidarUsuario($Correo, $Clave)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM usuario WHERE correo=? AND clave=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param("ss",$Correo,$Clave);
        $Sentencia->execute();

        $Resultado = $Sentencia->get_result();

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

        $Sentencia->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    public function ActualizarUsuario(ClassUSUARIO $oUsuario)
    {
        $oConexion = new ClassConexion();

        $SQL = "UPDATE usuario SET nombre=?, correo=?, clave=?, tipo=? WHERE idusuario=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "ssssi", 
            $oUsuario->nombre,
            $oUsuario->correo,
            $oUsuario->clave,
            $oUsuario->tipo,
            $oUsuario->idusuario
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function ActualizarTarea(ClassTAREA $oTarea)
    {
        $oConexion = new ClassConexion();

        $SQL = "UPDATE tarea SET titulo=? WHERE idtarea=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param("si", $oTarea->titulo, $oTarea->idtarea);

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function ActualizarEncuesta(ClassENCUESTA $oEncuesta)
    {
        $oConexion = new ClassConexion();

        $SQL = "UPDATE encuesta SET descripcion=?, idtarea=? WHERE idencuesta=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "sii", 
            $oEncuesta->descripcion, 
            $oEncuesta->idtarea, 
            $oEncuesta->idencuesta
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function ActualizarUsuario_Encuesta(ClassUSUARIO_ENCUESTA $oUsuarioEncuesta)
    {
        $oConexion = new ClassConexion();

        $SQL = "UPDATE usuarioencuesta SET estado=?, disponibilidad=? WHERE idusuario=? AND idencuesta=?";
        $Sentencia = $oConexion->Conectar->prepare($SQL);

        $Sentencia->bind_param(
            "ssii",
            $oUsuarioEncuesta->estado,
            $oUsuarioEncuesta->disponibilidad,
            $oUsuarioEncuesta->idusuario,
            $oUsuarioEncuesta->idencuesta
        );

        $Sentencia->execute();

        $Sentencia->close();
        $oConexion->CerrarConexion();
    }

    public function BuscarUsuario($Id)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM usuario WHERE idusuario=$Id";
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

    public function BuscarTarea($Id)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM tarea WHERE idtarea=$Id";
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

    public function BuscarEncuesta($Id)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM encuesta WHERE idencuesta=$Id";
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


    public function ConsultarEncuestaPorIdTarea($IdTarea)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT * FROM encuesta WHERE idtarea=$IdTarea";
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

    public function ConsultarUsuario_EncuestaPorIdUsuarioIdTarea($IdUsuario, $IdTarea)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT UE.* FROM usuario AS U 
        INNER JOIN usuarioencuesta AS UE 
        ON U.idusuario=UE.idusuario 
        INNER JOIN encuesta AS E 
        ON UE.idencuesta = E.idencuesta
        INNER JOIN tarea AS T
        ON E.idtarea = T.idtarea
        WHERE U.idusuario=$IdUsuario AND T.idtarea=$IdTarea";
        $Resultado = $oConexion->Conectar->query($SQL);

        $Lista = array();

        while($Row = $Resultado->fetch_assoc())
        {
            $oUsuario_Encuesta= new ClassUSUARIO_ENCUESTA();

            $oUsuario_Encuesta->idusuario = $Row['idusuario'];
            $oUsuario_Encuesta->idencuesta = $Row['idencuesta'];
            $oUsuario_Encuesta->estado = $Row['estado'];
            $oUsuario_Encuesta->disponibilidad = $Row['disponibilidad'];

            $Lista[] = $oUsuario_Encuesta;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }

    public function BuscarUsuarioEncuesta($IdUsuario, $IdEncuesta)
    {
        $oConexion = new ClassConexion();

        $SQL = "SELECT UE.* FROM usuarioencuesta AS UE WHERE UE.idusuario={$IdUsuario} AND UE.idencuesta={$IdEncuesta}";
        $Resultado = $oConexion->Conectar->query($SQL);

        $Lista = array();

        while($Row = $Resultado->fetch_assoc())
        {
            $oUsuario_Encuesta= new ClassUSUARIO_ENCUESTA();

            $oUsuario_Encuesta->idusuario = $Row['idusuario'];
            $oUsuario_Encuesta->idencuesta = $Row['idencuesta'];
            $oUsuario_Encuesta->estado = $Row['estado'];
            $oUsuario_Encuesta->disponibilidad = $Row['disponibilidad'];

            $Lista[] = $oUsuario_Encuesta;
        }

        $Resultado->close();
        $oConexion->CerrarConexion();

        return $Lista;
    }
}