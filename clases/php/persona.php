<?php

abstract class Persona
{
	//ATRIBUTOS
    private $_apellido;
    private $_dni;
    private $_nombre;
    private $_sexo;
    
    //GETTERS
    public function GetApellido()
    {
        return $this->_apellido;
    }

    public function GetDNI()
    {
        return $this->_dni;
    }

    public function GetNombre()
    {
        return $this->_nombre;
    }

    public function GetSexo()
    {
        return $this->_sexo;
    }

    //CONSTRUCTOR
	public function __construct($dni, $nombre, $apellido, $sexo)
	{
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_dni = $dni;
        $this->_sexo = $sexo; 
    }

    //METODO ABSTRACTO
    public abstract function Hablar($idioma);
    
    //METODOS
    public function ToString()
	{
		return $this->_dni . "-" . $this->_nombre . "-" . $this->_apellido . "-" . $this->_sexo;
	}
    
}