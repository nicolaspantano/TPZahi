function ValidarCamposVacios(campo : string) : boolean
{
    var retorno : boolean = true;
    
    if(campo == "")
    {
        retorno = false;
    }

    return retorno;
}

function ValidarRangoNumerico(validar : number, minimo : number, maximo : number) : boolean
{
    var retorno : boolean = true;

    if(validar < minimo || validar > maximo)
    {
        retorno = false;
    } 

    return retorno;
}

function ValidarCombo(combo : string, valor : string) : boolean
{
    var retorno : boolean = false;
    
    if(combo != valor)
    {
        retorno = true;
    }

    return retorno;
}

function ObtenerTurnoSeleccionado() : string
{
    let input:HTMLCollectionOf<HTMLInputElement> = document.getElementsByTagName("input");
    let checked:string = "";
    
    for (let i = 0; i < input.length; i++)
    {
        if(input[i].type == "radio")
        {
            if (input[i].checked)
            {
                checked += input[i].value;
            }
        }   
    }

    return checked;
}

function ObtenerSueldoMaximo(turno : string) : number
{
    var retorno : number = 0;

    if(turno == "Mañana")
    {
        retorno = 20000;
    }
    
    else if(turno == "Tarde")
    {
        retorno = 185000;
    }

    else if(turno == "Noche")
    {
        retorno = 25000;
    }

    return retorno;
}

function AdministrarSpanError(validar : string, valor : boolean) : void
{
    if(valor == false)
    {       
        (<HTMLInputElement>document.getElementById(validar)).style.display = "block";
    }

    else
    {
        (<HTMLInputElement>document.getElementById(validar)).style.display = "none";
    }
}

function AdministrarValidaciones(e:Event) : void
{
    let dni : string = (<HTMLInputElement>document.getElementById("txtDni")).value;
    let apellido : string = (<HTMLInputElement>document.getElementById("txtApellido")).value;
    let nombre : string = (<HTMLInputElement>document.getElementById("txtNombre")).value;
    let legajo : string = (<HTMLInputElement>document.getElementById("txtLegajo")).value;
    let sueldo : string = (<HTMLInputElement>document.getElementById("txtSueldo")).value;
    let sexo : string = (<HTMLInputElement>document.getElementById("cboSexo")).value;
    let foto : string = (<HTMLInputElement>document.getElementById("btFoto")).value;

    //Parseo
    var dniInt = parseInt(dni);
    var legajoInt = parseInt(legajo);
    var sueldoInt = parseInt(sueldo);

    //Validacion
    AdministrarSpanError("spanDni", ValidarCamposVacios(dni));
    if((<HTMLInputElement>document.getElementById("spanDni")).style.display == "none")
        AdministrarSpanError("spanDni", ValidarRangoNumerico(dniInt, 1000000, 55000000));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    AdministrarSpanError("spanNombre", ValidarCamposVacios(nombre));
    AdministrarSpanError("spanLegajo", ValidarCamposVacios(legajo));
    if((<HTMLInputElement>document.getElementById("spanLegajo")).style.display == "none")
        AdministrarSpanError("spanLegajo", ValidarRangoNumerico(legajoInt, 100, 550));
    AdministrarSpanError("spanSueldo", ValidarCamposVacios(sueldo));
    if((<HTMLInputElement>document.getElementById("spanSueldo")).style.display == "none")
        AdministrarSpanError("spanSueldo", ValidarRangoNumerico(sueldoInt, 8000, 25000));
    AdministrarSpanError("spanSexo", ValidarCombo(sexo, "---"));
    AdministrarSpanError("spanFoto", ValidarCamposVacios(foto));
    
    if(VerificarValidacionesLogin())
    {
        (<HTMLElement>document.getElementById("enviar")).onsubmit;
    }
    else
    {
        e.preventDefault();
    }
            
}

function AdministrarValidacionesLogin(e:Event) : void
{
    let dni : string = (<HTMLInputElement>document.getElementById("txtDniLogin")).value;
    let apellido : string = (<HTMLInputElement>document.getElementById("txtApellidoLogin")).value;
    var dniInt = parseInt(dni);
    
    AdministrarSpanError("spanDni", ValidarCamposVacios(dni));
    if((<HTMLInputElement>document.getElementById("spanDni")).style.display == "none")
        AdministrarSpanError("spanDni", ValidarRangoNumerico(dniInt, 1000000, 55000000));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));

    if(VerificarValidacionesLogin())
    {
        (<HTMLElement>document.getElementById("enviar")).onsubmit;
    }
    else
    {
        e.preventDefault();
    }

}

function VerificarValidacionesLogin() : boolean
{
    let span:HTMLCollectionOf<HTMLSpanElement> = document.getElementsByTagName("span");
    let retorno : boolean = true;

    for (let i = 0; i < span.length; i++)
    {
        if(span[i].style.display == "block")
        {
            retorno = false;
        }   
    }

    return retorno;
}

function AdministrarModificar(dni : string)
{
    (<HTMLInputElement>document.getElementById("hiddenDni")).value = dni;

    let form:HTMLFormElement = <HTMLFormElement>document.getElementById('formDni');

    form.submit();
}