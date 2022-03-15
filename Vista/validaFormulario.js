//Guardo las variables del formulario.
var formulario=document.getElementById("formulario");
var email=document.getElementById("mail");
var contrasegna=document.getElementById("contra");
var boton=document.getElementById("login");
var fraseValidar=document.getElementById("fraseValidacion");
//Pongo a la escucha al formulario.
formulario.addEventListener("submit",validar,false);

function validar(event){
    
    //Compruebo si los inputs son demasiado cortos.
    if(email.value.length<8||contrasegna.value.length<8){
        fraseValidar.innerHTML="Email o contraseña no tienen el tamaño requerido";
        boton.blur();
        event.preventDefault();
    }else{
        /*Creo una expresión regular para saber si
         * el campo de email tiene el signo @. */
        let patron=/[@]/;
        let resultado=email.value.match(patron);
        console.log(resultado);
        if(resultado==null){
            fraseValidar.innerHTML="Introduzca un email válido";
            boton.blur();
        event.preventDefault();
        }else{
            
        }
        
    }
    
}


