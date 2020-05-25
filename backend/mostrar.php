<?php
require "../clases/php/fabrica.php";
include "validarSesion.php";

$fabrica = new Fabrica("test");
$fabrica->SetCantidadMaxima(7);
$fabrica->TraerDeArchivo("../archivos/empleados.txt");

echo "
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'/>
        <title>HTML 5 – Listado de empleados</title>
        <script src='../funciones.js' ></script>
    </head>

    <body>
        <h2>Listado de Empleado</h2>
        <table style='margin-left: 4cm'>
            <tr>
                <td colspan='4'><h4>Info</h4></td>
            </tr> 
            <tr>
                <td
                    colspan='4'><hr>
                </td>
            </tr>";

    foreach($fabrica->GetEmpleados() as $item)
    {
        echo"
            <tr>
                <td>".$item->ToString()."</td>
                <td><img src=".$item->GetPathFoto()." width='90px' height='90px'/></td>
                <td><a href='eliminar.php?legajo=".$item->GetLegajo()."'>Eliminar</a></td>
                <td><input type='button' id='btnModificar' value='Modificar' onclick='AdministrarModificar(".$item->GetDNI().")'/></td>
            </tr>";
    }
echo"
            <tr>
                <td
                    colspan='4'><hr>
                </td>
            </tr>
        </table>
        <form id='formDni' method='post' action='../frontend/index.php'>
            <input type='hidden' name='dniModificar' id='hiddenDni'>
        </form>
    </body>
</html>";

echo '<a href="../frontend/index.php">Alta de empleados</a>';
echo '<br><a href="../backend/cerrarSesion.php">Desloguear</a>';
