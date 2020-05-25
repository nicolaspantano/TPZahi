function ValidarCamposVacios(campo) {
    var retorno = true;
    if (campo == "") {
        retorno = false;
    }
    return retorno;
}
function ValidarRangoNumerico(validar, minimo, maximo) {
    var retorno = true;
    if (validar < minimo || validar > maximo) {
        retorno = false;
    }
    return retorno;
}
function ValidarCombo(combo, valor) {
    var retorno = false;
    if (combo != valor) {
        retorno = true;
    }
    return retorno;
}
function ObtenerTurnoSeleccionado() {
    var input = document.getElementsByTagName("input");
    var checked = "";
    for (var i = 0; i < input.length; i++) {
        if (input[i].type == "radio") {
            if (input[i].checked) {
                checked += input[i].value;
            }
        }
    }
    return checked;
}
function ObtenerSueldoMaximo(turno) {
    var retorno = 0;
    if (turno == "Mañana") {
        retorno = 20000;
    }
    else if (turno == "Tarde") {
        retorno = 185000;
    }
    else if (turno == "Noche") {
        retorno = 25000;
    }
    return retorno;
}
function AdministrarSpanError(validar, valor) {
    if (valor == false) {
        document.getElementById(validar).style.display = "block";
    }
    else {
        document.getElementById(validar).style.display = "none";
    }
}
function AdministrarValidaciones(e) {
    var dni = document.getElementById("txtDni").value;
    var apellido = document.getElementById("txtApellido").value;
    var nombre = document.getElementById("txtNombre").value;
    var legajo = document.getElementById("txtLegajo").value;
    var sueldo = document.getElementById("txtSueldo").value;
    var sexo = document.getElementById("cboSexo").value;
    var foto = document.getElementById("btFoto").value;
    //Parseo
    var dniInt = parseInt(dni);
    var legajoInt = parseInt(legajo);
    var sueldoInt = parseInt(sueldo);
    //Validacion
    AdministrarSpanError("spanDni", ValidarCamposVacios(dni));
    if (document.getElementById("spanDni").style.display == "none")
        AdministrarSpanError("spanDni", ValidarRangoNumerico(dniInt, 1000000, 55000000));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    AdministrarSpanError("spanNombre", ValidarCamposVacios(nombre));
    AdministrarSpanError("spanLegajo", ValidarCamposVacios(legajo));
    if (document.getElementById("spanLegajo").style.display == "none")
        AdministrarSpanError("spanLegajo", ValidarRangoNumerico(legajoInt, 100, 550));
    AdministrarSpanError("spanSueldo", ValidarCamposVacios(sueldo));
    if (document.getElementById("spanSueldo").style.display == "none")
        AdministrarSpanError("spanSueldo", ValidarRangoNumerico(sueldoInt, 8000, 25000));
    AdministrarSpanError("spanSexo", ValidarCombo(sexo, "---"));
    AdministrarSpanError("spanFoto", ValidarCamposVacios(foto));
    if (VerificarValidacionesLogin()) {
        document.getElementById("enviar").onsubmit;
    }
    else {
        e.preventDefault();
    }
}
function AdministrarValidacionesLogin(e) {
    var dni = document.getElementById("txtDniLogin").value;
    var apellido = document.getElementById("txtApellidoLogin").value;
    var dniInt = parseInt(dni);
    AdministrarSpanError("spanDni", ValidarCamposVacios(dni));
    if (document.getElementById("spanDni").style.display == "none")
        AdministrarSpanError("spanDni", ValidarRangoNumerico(dniInt, 1000000, 55000000));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    if (VerificarValidacionesLogin()) {
        document.getElementById("enviar").onsubmit;
    }
    else {
        e.preventDefault();
    }
}
function VerificarValidacionesLogin() {
    var span = document.getElementsByTagName("span");
    var retorno = true;
    for (var i = 0; i < span.length; i++) {
        if (span[i].style.display == "block") {
            retorno = false;
        }
    }
    return retorno;
}
function AdministrarModificar(dni) {
    document.getElementById("hiddenDni").value = dni;
    var form = document.getElementById('formDni');
    form.submit();
}
