<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="librerías/bootstrap.min.css">
        <link rel="stylesheet" href="css/estiloAlumnos.css">
        <title>Alumnos del centro</title>
    </head>
    <body class="container">
        <?php
        session_start();
        if(isset($_SESSION["Tipo"])){
        include("comunes/Cabecera.html");
        ?>
        <div id="botonesElegir" class="row">
            <button type='button' class='btn-info botonAlumno col-md-2 <?php if($_SESSION["Tipo"]=="Profesor"){echo"offset-md-4";}else{echo"offset-md-1";} ?>'><a>Modificar Alumno</a></button>
            <?php
            if($_SESSION["Tipo"]=="Admin"){
            echo"<button type='button' class='btn-info col-md-2 offset-md-2 botonAlumno'><a>Borrar Alumno</a></button>";
            echo"<button type='button' class='btn-info col-md-2 offset-md-2 botonAlumno'><a>Añadir alumno</a></button>";
            }
            ?>
        </div>
        <div id="contenido" class="row"></div>
        <?php
        include("comunes/pieDePagina.html");
        }else{
            header("location:Formulario de entrada.php");
        }
        ?>}
        <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>