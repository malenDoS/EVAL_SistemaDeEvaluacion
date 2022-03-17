
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../librerías/bootstrap.min.css">
        <link rel="stylesheet" href="estiloFormulario.css">
    </head>
    <body class="container">
        <!--Contenedor principal-->
        <?php
        include("Cabecera.html");
        ?>
        
        <!--Formulario-->
        <div id="contenedor" class="row">
            <div id="cFormulario" class="col-md-4 offset-md-4">
            <form id="formulario" method="post" action="../Controlador/Comprobar.php">
                <div class="input-group">
                <label for="email" class="form-control">Email:</label><input id="mail" type="text" class="form-control" name="correo">
                </div>
                <div class="input-group">
                <label for="contrasegna" class="form-control">Contraseña</label><input id="contra" type="password" class="form-control" name="contrasegna">
                </div>
                <input type="submit" id="login" class="form-control"><label for="sesion"  class="recordar">Recordar:</label> <input type="checkbox" id="recordar">
                <p id="fraseValidacion"><?php if(isset($_GET["datos"])){
                echo"Datos no encontrados";}?></p>
                }
            </form>
        </div>
        </div>
        
       
        
        <!--Footer-->
        <?php
        include("pieDePagina.html");
        ?>
        <script type="text/javascript" src="../librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../librerías/bootstrap.min.js"></script>
        <script type="text/javascript" src="validaFormulario.js"></script>
    </body>
</html>
