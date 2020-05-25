<?php
require "../clases/php/fabrica.php";

$baja = $_GET['legajo'];

$listaEmpleados = array(); 
$archivo = fopen("../archivos/empleados.txt", "r");
$x = 0;

while(!feof($archivo))
{
    $strEmpleado = trim(fgets($archivo));
    $arrayEmpleado = explode("-", $strEmpleado); 

    if($arrayEmpleado[0] != "")
    {
        array_push($listaEmpleados, new Empleado 
        (   $arrayEmpleado[0], 
            $arrayEmpleado[1], 
            $arrayEmpleado[2],
            $arrayEmpleado[3],
            $arrayEmpleado[4],
            $arrayEmpleado[5],
            $arrayEmpleado[6]
        )); 

        $path = $arrayEmpleado[7]."-".$arrayEmpleado[8];
        $aux = $listaEmpleados[$x];
        $aux->SetPathFoto($path);
        $x++;
    } 
}

$fabrica = new Fabrica("test");
$fabrica->SetCantidadMaxima(7);
$fabrica->TraerDeArchivo("../archivos/empleados.txt");

for($i=0;$i<count($fabrica->GetEmpleados()); $i++)
{
    if($baja == $listaEmpleados[$i]->GetLegajo())
    {
        if($fabrica->EliminarEmpleado($listaEmpleados[$i]))
        {
            echo "Se ha eliminado el empleado: <br>" ;
            echo $listaEmpleados[$i]->ToString() . "<br><br>"; 
            $fabrica->GuardarEnArchivo("../archivos/empleados.txt");
        break;
        }

        else
        {
            echo "No se pudo eliminar al empleado <br>" ;
        }
    }
        //PREGUNTAR DESPUES A GONZA
    //echo "El empleado no existe" ;
}   

fclose($archivo);

echo '<a href="mostrar.php">Mostrar empleados</a><br>';
echo '<a href="../frontend/index.php">Alta empleados</a>';

