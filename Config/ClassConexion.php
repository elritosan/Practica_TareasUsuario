<?php

class ClassConexion
{
    public $Conectar;

    public function __construct()
    {
        $this->Conectar = new mysqli("localhost","root","","bdtareasusuario");

        if ($this->Conectar->connect_error) 
        {
            throw new Exception("Error Processing Request", $this->Conectar->connect_error);
        }
    }

    public function CerrarConexion()
    {
        $this->Conectar->close();
    }
}