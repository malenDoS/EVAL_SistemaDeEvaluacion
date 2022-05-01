
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="librerías/bootstrap.min.css">
        <link rel="stylesheet" href="css/estiloFormulario.css">
        <title>Formulario de entrada</title>
    </head>
    <body class="container">
        <!--Contenedor principal-->
        <?php
        //Compruebo si se ha pulsado el botón de enviar del formulario.
        if(isset($_POST["enviar"])){
            include("../Controlador/Registrado.php");
            //Guardo los datos.
           $correo=$_POST["correo"];
           $contrasegna=$_POST["contrasegna"];
           $entrada=new Registrado();
           $entrada->comprobarRegistro($correo,$contrasegna);
        }
        include("comunes/Cabecera.html");
        ?>
        
        <!--Formulario-->
        <div id="contenedor" class="row">
            <div id="cFormulario" class="col-md-4 offset-md-4">
            <form id="formulario" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="input-group">
                <label for="email" class="form-control">Email:</label><input id="mail" type="text" class="form-control" name="correo">
                </div>
                <div class="input-group">
                <label for="contrasegna" class="form-control">Contraseña</label><input id="contra" type="password" class="form-control" name="contrasegna">
                </div>
                <input type="submit" id="login" name="enviar" class="form-control">
                <p id="fraseValidacion"><?php if(isset($_GET["datos"])){
                echo"Datos no encontrados";}?></p>
                
            </form>
        </div>
        </div>
        
       
        
        <!--Footer-->
        <?php
        include("comunes/pieDePagina.html");
        ?>
        <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
        <script type="text/javascript" src="javascript/validaFormulario.js"></script>
    </body>
</html>
