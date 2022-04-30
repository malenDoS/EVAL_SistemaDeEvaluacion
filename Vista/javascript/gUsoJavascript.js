$(document).ready(function(){
    
    //Guardo las imágenes en un array.
    var imagenes=new Array(12);
    imagenes[0]="imagenes/imagenesGuiaUso/boton1/1.png";
    imagenes[1]="imagenes/imagenesGuiaUso/boton1/2.png";
    imagenes[2]="imagenes/imagenesGuiaUso/boton1/3.png";
    imagenes[3]="imagenes/imagenesGuiaUso/boton2/1.png";
    imagenes[4]="imagenes/imagenesGuiaUso/boton2/2.png";
    imagenes[5]="imagenes/imagenesGuiaUso/boton2/3.png";
    imagenes[6]="imagenes/imagenesGuiaUso/boton3/1.png";
    imagenes[7]="imagenes/imagenesGuiaUso/boton3/2.png";
    imagenes[8]="imagenes/imagenesGuiaUso/boton3/3.png";
    imagenes[9]="imagenes/imagenesGuiaUso/boton4/1.png";
    imagenes[10]="imagenes/imagenesGuiaUso/boton4/2.png";
    imagenes[11]="imagenes/imagenesGuiaUso/boton4/3.png";
    
    //Identifico las opciones.
    var boton1=$("#boton1");
    var boton2=$("#boton2");
    var boton3=$("#boton3");
    var boton4=$("#boton4");
    
    //Identifico el contenedor con las imágenes.
    var contenedor=$("#contenedorInfo");
    //Identifico las imágenes.
    var imagen1=$("#imagen1");
    var imagen2=$("#imagen2");
    var imagen3=$("#imagen3");
    
    //Pongo a la escucha a los botones.
    boton1.hover(function(){
        
        
        imagen1.attr("src",imagenes[0]);
        imagen2.attr("src",imagenes[1]);
        imagen3.attr("src",imagenes[2]);
        //cambio la visibilidad del contenedor.
        contenedor.css("visibility","visible");
    },function(){
        //Cambio la visibilidad del contenedor.
        contenedor.css("visibility","hidden");
    });
    
    boton2.hover(function(){
        
        
        imagen1.attr("src",imagenes[3]);
        imagen2.attr("src",imagenes[4]);
        imagen3.attr("src",imagenes[5]);
        //cambio la visibilidad del contenedor.
        contenedor.css("visibility","visible");
    },function(){
        //Cambio la visibilidad del contenedor.
        contenedor.css("visibility","hidden");
    });
    
    boton3.hover(function(){
        
        
        imagen1.attr("src",imagenes[6]);
        imagen2.attr("src",imagenes[7]);
        imagen3.attr("src",imagenes[8]);
        //cambio la visibilidad del contenedor.
        contenedor.css("visibility","visible");
    },function(){
        //Cambio la visibilidad del contenedor.
        contenedor.css("visibility","hidden");
    });
    
    boton4.hover(function(){
        
        
        imagen1.attr("src",imagenes[9]);
        imagen2.attr("src",imagenes[10]);
        imagen3.attr("src",imagenes[11]);
        //cambio la visibilidad del contenedor.
        contenedor.css("visibility","visible");
    },function(){
        //Cambio la visibilidad del contenedor.
        contenedor.css("visibility","hidden");
    });
});

