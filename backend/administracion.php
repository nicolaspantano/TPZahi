<?php
require "../clases/php/fabrica.php";
//VALIDACIONES
$carga = isset($_POST["enviar"]) ? TRUE:FALSE;
$destino = "../fotos/" . $_FILES["archivo"]["name"];
$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
//--------------------------------------------------------------------------
//PARA EL NOMBRE DEL ARCHIVO
$dni = $_POST["dni"];
$apellido = $_POST["apellido"];
$nombreArchivo = "../fotos/" . $dni . "-" . $apellido . "." . $tipoArchivo;
//-------------------------------------------------------------------------
//FABRICA Y CARGAR LOS EMPLEADOS
$fabrica = new Fabrica("test");
$fabrica->SetCantidadMaxima(7);
$fabrica->TraerDeArchivo("../archivos/empleados.txt");
//--------------------------------------------------------------------------
//MODIFICAR EL EMPLEADO
$modificar = isset ($_POST["hdnModificar"]) ? TRUE:FALSE;

if($modificar)
{
    foreach($fabrica->GetEmpleados() as $item)
    {
        if(strcmp($item->GetDni(),$dni)==0)
        {
            $fabrica->EliminarEmpleado($item);
            break;
        }
    }
}

if($carga)
{
    //objeto empleado
    $empleado = new Empleado
    (
        $_POST["dni"], 
        $_POST["nombre"], 
        $_POST["apellido"], 
        $_POST["sexo"], 
        $_POST["legajo"], 
        $_POST["sueldo"], 
        $_POST["rdTurno"]
    );

    $empleado->SetPathFoto($nombreArchivo);
    $nuevoEmpleado = $fabrica->AgregarEmpleado($empleado);

    if(!(file_exists($destino)) && $esImagen && $_FILES["archivo"]["size"] <= 1000000)
    {
        if($tipoArchivo == "jpg" || $tipoArchivo == "bmp" || $tipoArchivo == "gif" || $tipoArchivo == "png" || $tipoArchivo == "jpeg") 
        {
            move_uploaded_file($_FILES["archivo"]["tmp_name"],$nombreArchivo);
            if($nuevoEmpleado)
            {
                $fabrica->GuardarEnArchivo("../archivos/empleados.txt");
                echo '<a href="mostrar.php">Mostrar empleados</a>';
            }
        }
    }
    else
    {
        echo "No se pudo agregar el empleado. <br><br>" . '<a href="../frontend/index.php">Alta empleado</a>';
    }

}