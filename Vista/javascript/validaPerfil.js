//Guardo las variables del formulario.
let nombre=document.getElementById("nombreP");
let apellido=document.getElementById("apellidoP");
let nacimiento=document.getElementById("nacimientoP");
let telefono=document.getElementById("telefonoP");
let direccion=document.getElementById("direccionP");
let cargo=document.getElementById("cargo");
let dni=document.getElementById("dniP");
//Guardo el formulario.
let formulario=document.getElementById("formulario");
let boton=document.getElementById("botonGuardar");
//Guardo el párrafo de la instrucción de la validación.
let frase=document.getElementById("fraseV");
//Pongo a la escucha al formulario.
formulario.addEventListener("submit",validar,false);

function validar(event){
  
    if(nombre.value==""||apellido.value==""||nacimiento.value==""||telefono.value==""||direccion.value==""||cargo.value==""||dni.value==""){
        frase.innerHTML="No pueden quedar campos vacíos.";
        boton.blur();
        event.preventDefault();
    }
    if(dni.value.length!=9){
        frase.innerHTML="Revisa el DNI introducido.";
    }
    if(nombre.value.length>20||apellido.value.length>30){
        frase.innerHTML="Revisa el nombre y apellido.";
    }
    if(telefono.value.length!=9){
        frase.innerHTML="Revisa el número de teléfono introducido.";
    }
    if(direccion.value.lenght>30){
        frase.innerHTML="Revisa el campo dirección introducido";
    }
    if(cargo.value.lenght>20){
        frase.innerHTML="Revisa el campo cargo introducido.";
    }
    if(nacimiento.value>10){
        frase.innerHTML="Revisa el campo fecha de nacimiento.";
    }
}