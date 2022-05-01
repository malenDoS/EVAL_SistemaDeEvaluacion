//Guardo en una variable el formulario.
let formulario=document.getElementById("formularioM");
//Guardo en variables los campos del formulario.
let nombre=document.getElementById("nombreA");
let apellido=document.getElementById("apellidoA");
let cPadre=document.getElementById("contactoP");
let direccion=document.getElementById("direccionA");
let frase=document.getElementById("fraseV");
let clase=document.getElementById("claseA");
let tutor=document.getElementById("tutorA");
//Pongo a la escucha al formulario.
if(formulario!=null){
formulario.addEventListener("submit",validar,false);
}

function validar(event){
    
     if(clase.value==""){
        frase.innerHTML="Tiene que especificar una clase";
        event.preventDefault();
    }
    if(tutor.value==""){
        frase.innerHTML="Tiene que especificar un tutor";
        event.preventDefault();
    }
    
    if(nombre.value.length>20||apellido.value.length>20||direccion.value.length>30){
        frase.innerHTML="No se pueden introducir más de 20 caracteres.";
        event.preventDefault();
    }
    if(cPadre.value.length!=9){
        frase.innerHTML="El teléfono de contacto tiene que tener 9 números.";
        event.preventDefault();
    }
   
}


let formulario2=document.getElementById("formularioA");
let nombreA=document.getElementById("Anombre");
let apellidoA=document.getElementById("Aapellido");
let contactoA=document.getElementById("Acontacto");
let direccionA=document.getElementById("Adireccion");
let claseA=document.getElementById("Aclase");
let tutorA=document.getElementById("Atutor");

if(formulario2!=null){
formulario2.addEventListener("submit",validanadir,false);
}

function validanadir(event){
      
    if(claseA.value==""){
        frase.innerHTML("Tiene que especificar una clase.");
    }
    if(tutorA.value==""){
        frase.innerHTML("Tiene que especificar un tutor.");
    }
   
    if(contactoA.value.length!=9){
        frase.innerHTML="El teléfono de contacto tiene que tener 9 números";
        event.preventDefault();
    }
     if(nombreA.value.length>20||apellidoA.value.length>20||direccionA.value.length>20){
        frase.innerHTML="No se pueden introducir más de 20 caracteres";
        event.preventDefault();
    }

}


