<html>
    <head>
        <meta charset="utf-8">
        <title>Guía de uso</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="librerías/bootstrap.min.css">
        <link rel="stylesheet" href="css/estiloGuiaUso.css">
           <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="javascript/gUsoJavascript.js"></script>
    </head>
    <body class="container">
        <?php
        //Compruebo si el usuario ha iniciado sesión.
        session_start();
        if(isset($_SESSION["Tipo"])){
            include("comunes/Cabecera.html");
            
            
             ?>
        
        <!--Un contenedor para los botones.-->
        <div id="contenedorBotones" class="row col-md-12">
            <!--//Botones de opciones.-->
            <span id="boton1" class="col-md-3 botonGuia">Modificar al usuario -</span><span id="boton2" class="col-md-12 botonGuia">Modificar profesores (Administrador) -</span><span id="boton3" class="col-md-12 botonGuia">Evaluar alumnos -</span><span id="boton4" class="col-md-12 botonGuia">Modificar alumno</span>
            
        </div>
        <!--Un contenedor para las imágenes  y la información.-->
        <div id="contenedorInfo"><img id="imagen1" class="imagenGuia" style="width:470px; height:500px;" src=""><img id="imagen2" class="imagenGuia" style="width:470px; height:500px;" src=""><img id="imagen3" class="imagenGuia" style="width:470px; height:500px;" src=""></div>
        <?php
         echo"<button type='button' class='offset-md-5 btn-info col-md-2 bot'><a href='MenuDeOpciones.php'>Salir</a></button>";
         
        }else{
            header("Formulario de entrada.php");
        }
        include("comunes/pieDePagina.html");
            ?>
      
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>

