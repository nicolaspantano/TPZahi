<?php   
require "persona.php";
require "empleado.php";
require "interfaces.php";

class Fabrica implements IArchivo
{
    //ATRIBUTOS
    private $_cantidadMaxima;
    private $_empleados;
    private $_razonSocial;

    //SETTER Y GETTER
    public function SetCantidadMaxima($cantidad)
    {
        $this->_cantidadMaxima = $cantidad;
    }

    public function GetEmpleados()
    {
        return $this->_empleados;
    }
    
    //CONSTRUCTOR
    public function __construct($razonSocial)
	{
        $this->_razonSocial = $razonSocial; 
        $this->_cantidadMaxima = 5;
        $this->_empleados = array();
    }

    //METODOS
    public function AgregarEmpleado($obj)
    {
        $retorno = false;
        $len = count($this->_empleados);
        
        if($len < $this->_cantidadMaxima)
        {
            array_push($this->_empleados, $obj);
            $this->EliminarEmpleadoRepetido();
            $retorno = true;
        }
        
        else
        {
            echo "No se pueden agregar más empleados.<br>";
        }

        return $retorno;
    }

    public function EliminarEmpleado($obj)
    {
        $retorno = false;

        $len = count($this->_empleados);
        $path = $obj->GetPathFoto();
        
        for($i = 0; $i < $len; $i++)
        {
            if($this->_empleados[$i]->ToString() == $obj->ToString())
            {
                unset($this->_empleados[$i]);
                $retorno = true;
                unlink($path);
                break;
            }
        } 

        return $retorno;
    }

    private function EliminarEmpleadoRepetido()
    {
        $this->_empleados = array_unique($this->_empleados, SORT_REGULAR); 
    }

    public function CalcularSueldos()
    {
        $sueldos = 0;
        
        foreach($this->_empleados as $item)
        {
            $sueldos += $item->GetSueldo();
        }

        return $sueldos;
    }

    public function ToString()
    {
        $cargado = "<b>RAZON SOCIAL: </b>" . $this->_razonSocial . "<b>&nbsp&nbsp&nbsp&nbspTOTAL DE SUELDOS: </b>" . $this->CalcularSueldos() . "<br>";
        $cargado .= "<br>********************************************<br><b>LISTA DE EMPLEADOS</b><br>********************************************<br>";
        
        
        foreach($this->_empleados as $item)
        {
            $cargado .= $item->ToString();
        } 

        return $cargado;
    }

    public function TraerDeArchivo($nombreArchivo) 
    {
        $strEmpleado = "";
        $ar = fopen($nombreArchivo, "r");

        while(!feof($ar))
        {
            $strEmpleado = trim(fgets($ar)); 
            $arrayEmpleado = explode("-", $strEmpleado); 
            
            if(count($arrayEmpleado) == 9) 
            {                
                $path = $arrayEmpleado[7]."-".$arrayEmpleado[8];
                
                $this->AgregarEmpleado($aux = new Empleado
                (
                    $arrayEmpleado[0],
                    $arrayEmpleado[1],
                    $arrayEmpleado[2],
                    $arrayEmpleado[3],
                    $arrayEmpleado[4],
                    $arrayEmpleado[5],
                    $arrayEmpleado[6]
                ));

                $aux->SetPathFoto($path);
            }
        }
        fclose($ar);
    }

    public function GuardarEnArchivo($nombreArchivo) 
    {
        $archivo = fopen($nombreArchivo, "w");
        foreach($this->_empleados as $item)
        { 
            fwrite($archivo, $item->ToString() . "\r\n"); 
        }                                                 
        fclose($archivo);
    }
}