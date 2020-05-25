<?php
require "fabrica.php";

$objE1 = new Empleado("Juan", "Lopez1", 1234578, "M", 100, 20000, "Mañana");
$objE2 = new Empleado("Juan", "Lopez2", 1234578, "M", 100, 20000, "Mañana");
$objE3 = new Empleado("Juan", "Lopez3", 1234578, "M", 100, 20000, "Mañana");
$objE4 = new Empleado("Juan", "Lopez4", 1234578, "M", 100, 20000, "Mañana");
$objE5 = new Empleado("Juan", "Lopez5", 1234578, "M", 100, 20000, "Mañana");
$objE6 = new Empleado("Juan", "Lopez6", 1234578, "M", 100, 20000, "Mañana");
$objE7 = new Empleado("Juan", "Lopez6", 1234578, "M", 100, 20000, "Mañana");

$objF = new Fabrica("Mecanico");

$idiomas = array("Español", "Ingles", "Frances");

$objE1->Hablar($idiomas);

echo "<i>Nota: Agrego 4 empleados del cual uno es repetido y no se agrega a la lista.<br><br></i>";
$objF->AgregarEmpleado($objE1);
$objF->AgregarEmpleado($objE2);
$objF->AgregarEmpleado($objE3);
$objF->AgregarEmpleado($objE2);
echo $objF->ToString();
echo "<br><b>--------------------------------------------------------------------------------------------</b><br>";

echo "<i>Nota: Agrego 3 empleados mas pero solo carga 2 porque el maximo es 5.<br><br></i>";
$objF->AgregarEmpleado($objE4);
$objF->AgregarEmpleado($objE5);
$objF->AgregarEmpleado($objE6);
echo $objF->ToString();
echo "<br><b>--------------------------------------------------------------------------------------------</b><br>";

echo "<i>Nota: Elimino un empleado de la lista.<br><br></i>";
$objF->EliminarEmpleado($objE4);
echo $objF->ToString();

