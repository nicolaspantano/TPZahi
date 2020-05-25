<?php
include "../backend/validarSesion.php";
require "../clases/php/fabrica.php";

$tituloNavegador = "HTML 5 – Formulario Alta Empleado";
$titulo = "Alta de Empleado";
$modificar = false;
$masculino = "";
$femenino = "";
$mañana = "";
$tarde = "";
$noche = "";
$boton = 'value="Enviar"';
 
if($_POST)
{
    $modificar = true;
    $fabrica = new Fabrica("test");
    $fabrica->SetCantidadMaxima(7);
    $fabrica->TraerDeArchivo("../archivos/empleados.txt");
    $empleado;

    foreach($fabrica->GetEmpleados() as $item)
    {
        if($item->GetDni() == $_POST["dniModificar"])
        {
            $empleado = $item;
            break;
        }
    }

    $tituloNavegador = "HTML 5 – Formulario Modificar Empleado";
    $titulo = "Modificar Empleado";
    $boton = 'value="Modificar"';

    if(strcasecmp("M",$empleado->GetSexo()) == 0)
    {
        $masculino="selected=true";
    }

    else
    {
        $femenino="selected=true";
    }

    switch ($empleado->GetTurno()) {
        case "Mañana":
            break;
        
        case "Tarde":
            $mañana="";
            $tarde=" checked";
            break;

        case "Noche":
            $mañana="";
            $noche=" checked";
            break;
    }
}

echo' 
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
        <title>'.$tituloNavegador.'</title>
        <script src="funciones.js" ></script>
    </head>

    <body>
        <form id = "frmIndex" action="../backend/administracion.php" method="POST" name="altaEmpleados" enctype="multipart/form-data">
            <h2>
                '.$titulo.'
            </h2>

            <table style="margin-left: 4cm;">
                <tr>
                    <td colspan="2"><h4>Datos Personales</h4></td>
                </tr>                    
                <tr>
                    <td 
                        colspan="2"><hr width="100%" align="left">
                    </td>
                </tr>
                
                <tr>
                    <td>DNI:
                    </td>
                    <td> 
                        <input type="number" id="txtDni" min="1000000" max="55000000" name= "dni"'; 
                        if($modificar)
                        {
                            echo " value = ". $empleado->GetDNI() ." readonly";
                        }
                        echo'>
                        <span style="display: none;" id="spanDni" name = "span">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Apellido:</td>
                    <td> 
                        <input type="text" id="txtApellido" name="apellido"';
                        if($modificar)
                        {
                            echo " value = ". $empleado->GetApellido();
                        }
                        echo '>
                        <span style="display: none;" id="spanApellido" name = "span">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td> 
                        <input type="text" id="txtNombre" name= "nombre"'; 
                        if($modificar)
                        {
                            echo " value = ". $empleado->GetNombre();
                        }
                        echo '>
                        <span style="display: none;" id="spanNombre" name = "span">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Sexo:</td>
                    <td>
						<select id="cboSexo" name="sexo">
                            <option disabled selected value="---">Seleccione</option>
                            <option value="M" '.$masculino.'>Masculino</option>
                            <option value="F"'.$femenino.'>Femenino</option> 
                        </select>
                        <span style="display: none;" id="spanSexo" name = "span">*</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><h4>Datos Laborales</h4></td>
                </tr>                    
                <tr>
                    <td 
                        colspan="2"><hr width="100%" align="left">
                    </td>
                </tr>

                <tr>
                    <td>Legajo:</td>
                    <td> 
                        <input type="number" id="txtLegajo" min="100" max="550" name="legajo"';
                        if($modificar)
                        {
                            echo " value = ". $empleado->GetLegajo() ." readonly";
                        }
                        echo '>
                        <span style="display: none;" id="spanLegajo" name = "span">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Sueldo:</td>
                    <td> 
                        <input type="number" id="txtSueldo" min="8000" max="25000" name="sueldo"';
                        if($modificar)
                        {
                            echo " value = ". $empleado->GetSueldo();
                        }
                        echo '>
                        <span style="display: none;" id="spanSueldo" name = "span">*</span>
                    </td>
                </tr>
                <tr>
					<td colspan="2">Turno:</td>
                </tr>
				<tr>				
					<td  style="text-align:left;padding-left:50px">
						<input type="radio" id="rdoTurnoM" value="Ma&ntilde;ana" checked="checked" name = "rdTurno" '.$mañana.'/>						
                    </td>
                    <td>Ma&ntilde;ana</td>	
				</tr>
				<tr>				
					<td  style="text-align:left;padding-left:50px">
						<input type="radio" id="rdoTurnoT" value="Tarde" name = "rdTurno" '.$tarde.'/>						
                    </td>
                    <td>Tarde</td>	
                </tr>
                <tr>				
					<td  style="text-align:left;padding-left:50px">
						<input type="radio" id="rdoTurnoN" value="Noche" name = "rdTurno" '.$noche.'/>						
                    </td>
                    <td>Noche</td>	
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="file" name="archivo" id = "btFoto"/>
                        <span style="display: none;" id="spanFoto" name = "span">*</span>
                    </td>
                </tr>
                
                <tr>
                    <td  
                        colspan="2"><hr width="100%" align="left">
                    </td>
                </tr>
                
				<tr>
					<td colspan="2" align="right">
						<input type="reset" value="Limpiar"/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<input type="submit" id="btnEnviar" '.$boton.' onclick="AdministrarValidaciones(event)" name="enviar"/>
					</td>
                </tr>
            </table>
            <input type="hidden" name="hdnModificar" id="hdnModificar">            
        </form>
    </body>
</html>';

echo '<br><a href="../backend/cerrarSesion.php">Desloguear</a>';