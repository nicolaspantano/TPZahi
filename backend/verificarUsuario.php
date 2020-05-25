<?php
session_start();
require "../clases/php/fabrica.php";

$dni = $_POST['dniLogin'];
$apellido = $_POST['apellidoLogin'];
$login = isset($_POST["enviarLogin"]) ? TRUE:FALSE;

$listaEmpleados = array(); 
$archivo = fopen("../archivos/empleados.txt", "r");

if($login)
{
    while(!feof($archivo))
    {
        $strEmpleado = trim(fgets($archivo));
        $arrayEmpleado = explode("-", $strEmpleado); 
        
        if($arrayEmpleado[0] != "")
        {
            array_push($listaEmpleados, new Empleado 
            (   
            $arrayEmpleado[0], 
            $arrayEmpleado[1], 
            $arrayEmpleado[2],
            $arrayEmpleado[3],
            $arrayEmpleado[4],
            $arrayEmpleado[5],
            $arrayEmpleado[6]
        ));
        } 
    } 
}

fclose($archivo);
var_dump($_SESSION);

for($i=0;$i<count($listaEmpleados); $i++)
{
    if($listaEmpleados[$i]->GetApellido() === $apellido)
    {
        $_SESSION['DNIEmpleado'] = $dni;
        header('Location: mostrar.php');
    }
    
    else
    {
        echo "No existe el empleado ingresado <a href='../login.html'>Ingrese nuevamente</a>";
    break;
    }
}   
        

