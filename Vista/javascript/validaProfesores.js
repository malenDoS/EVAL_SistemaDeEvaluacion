//Guardo el formulario en variables.
let formulario=document.getElementById("formulario");

let nombre=document.getElementById("nombre");
let apellido=document.getElementById("apellido");
let telefono=document.getElementById("telefono");
let direccion=document.getElementById("direccion");
let email=document.getElementById("email");
let fechaNacimiento=document.getElementById("fechaNacimiento");
let contrasegna=document.getElementById("contrasegna");
let cargo=document.getElementById("cargo");
let dni=document.getElementById("dni");
let frase=document.getElementById("fraseV");
//Pongo a la escucha al formulario.
formulario.addEventListener("submit",validar,false);

function validar(event){
    //Valido el formulario.
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
    if(fechaNacimiento.value>10){
        frase.innerHTML="Revisa el campo fecha de nacimiento.";
    } 
    
    if(email.value.length<8||contrasegna.value.length<8){
        frase.innerHTML="Email o contraseña no tienen el tamaño requerido";
        event.preventDefault();
    }else{
        /*Creo una expresión regular para saber si
         * el campo de email tiene el signo @. */
        let patron=/[@]/;
        let resultado=email.value.match(patron);
        if(resultado==null){
            frase.innerHTML="Introduzca un email válido";
        event.preventDefault();
}
    
 }
 
   if(nombre.value==""||apellido.value==""||telefono.value==""||direccion.value==""||email.value==""||fechaNacimiento.value==""||contrasenga.value==""||cargo.value==""||dni.value==""){
        frase.innerHTML="No pueden quedar campos vacíos en el formulario.";
        event.preventDefault();
    }
 }