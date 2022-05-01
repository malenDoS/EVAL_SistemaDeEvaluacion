//Guardo las variables del formulario.
let formulario=document.getElementById("formulario");
let frase=document.getElementById("fraseV");

let eval1=document.getElementById("e1");
let eval2=document.getElementById("e2");
let eval3=document.getElementById("e3");
let eval4=document.getElementById("e4");
let eval5=document.getElementById("e5");
let eval6=document.getElementById("e6");
let eval7=document.getElementById("e7");
let eval8=document.getElementById("e8");
let eval9=document.getElementById("e9");
let eval10=document.getElementById("e10");
let eval11=document.getElementById("e11");
let eval12=document.getElementById("e12");
let eval13=document.getElementById("e13");
let eval14=document.getElementById("e14");
let eval15=document.getElementById("e15");
let eval16=document.getElementById("e16");
let eval17=document.getElementById("e17");
let eval18=document.getElementById("e18");
let eval19=document.getElementById("e19");
let eval20=document.getElementById("e20");
let eval21=document.getElementById("e21");
let eval22=document.getElementById("e22");
let eval23=document.getElementById("e23");
let eval24=document.getElementById("e24");

let obs1=document.getElementById("o1");
let obs2=document.getElementById("o2");
let obs3=document.getElementById("o3");
let obs4=document.getElementById("o4");
let obs5=document.getElementById("o5");
let obs6=document.getElementById("o6");

//Guardo las variables en arrays.
let eval=[eval1,eval2,eval3,eval4,eval5,eval6,eval7,eval8,eval9,eval10,eval11,eval12,eval13,eval14,eval15,eval16,eval17,eval18,eval19,eval20,eval21,eval22,eval23,eval24];
let obs=[obs1,obs2,obs3,obs4,obs5,obs6];

//Pongo a la escucha al formulario.
formulario.addEventListener("submit",validar,false);

function validar(event){
    
    for(let i=0;i<eval.length;i++){
        if(eval[i].value.length>3){
            frase.innerHTML="Las notas no admiten más de 3 números. Las observaciones tienen un mínimo de 20 letras o 0";
            event.preventDefault();
        }
    }
    
    for(let i=0;i<obs.length;i++){
        if(obs[i].value.length<20&&obs[i].value.length!=0){
            frase.innerHTML="Las notas no admiten más de 3 números. Las observaciones tienen un mínimo de 20 letras o 0";
            event.preventDefault();
        }
    }
}