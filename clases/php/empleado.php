<?php

class Empleado extends Persona
{
    //ATRIBUTOS
    protected $_legajo;
    protected $_sueldo;
    protected $_turno;
    protected $_pathFoto;

    //GETTERS Y SETTERS
    public function GetLegajo()
    {
        return $this->_legajo;
    }

    public function GetSueldo()
    {
        return $this->_sueldo;
    }

    public function GetTurno()
    {
        return $this->_turno;
    }

    public function GetPathFoto()
    {
        return $this->_pathFoto;
    }

    public function SetPathFoto($foto)
    {
        $this->_pathFoto = $foto;
    }

    //CONSTRUCTOR
    public function __construct($dni, $nombre, $apellido, $sexo, $legajo, $sueldo, $turno)
	{
		parent::__construct($dni, $nombre, $apellido, $sexo);
        $this->_legajo = $legajo;
        $this->_sueldo = $sueldo;
        $this->_turno = $turno;
    }
    
    //POLIMORFISMO  
    public function ToString()
	{
        $base = parent::ToString();
        return $base . "-" . $this->_legajo . "-" . $this->_sueldo . "-" . $this->_turno . "-" . $this->_pathFoto;
    }
    
    //METODO ABSTRACTO
    public function Hablar($idioma)
    {
        $idiomas = "";

        foreach ($idioma as $v) 
        {
            $idiomas .= $v . " ";
        }

        echo "El empleado habla " . $idiomas . "<br>";
	}
}