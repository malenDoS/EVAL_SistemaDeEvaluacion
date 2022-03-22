
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../librerías/bootstrap.min.css">
        <link rel="stylesheet" href="estiloMenuDeOpciones.css">
        <title>Menú de opciones</title>
    </head>
    <body class="container">
    <?php
    //Incluyo la cabecera.
    include("Cabecera.html");
    
        
        //Verifico si la sesión está iniciada.
        session_start();
        if(isset($_SESSION["Tipo"])){
            
            include("../Controlador/RecopilarDatos.php");
                //Compruebo los datos de la persona que entra.
                $idUsuario=$_GET["numero"];
                $usuario=new RecopilarDatos();
                $datos=$usuario->usuarioMenu($idUsuario);
            //Imprimo el menú según el tipo de usuario.
            if($_SESSION["Tipo"]=="Admin"){
                
                
                //Imprimo en un contenedor la información del usuario.
                echo"<div id='infoUsuario' class='row'>
                        <p id='nombreUsuario' class='col-md-4 offset-md-4'>".$datos[0]." ".$datos[1]." / ".$datos[2]."</p>
                         </div>";
                //Imprimo las opciones del menú.
                echo"<div id='imagenes' class='row'> 
                <img src='Iconos/profesora.png' class='col-md-2 offset-md-2 iconoInfo izquierda'><img src='Iconos/asignaturas.png' class='col-md-2 iconoInfo'><img src='Iconos/estudiante.png' class='col-md-2 iconoInfo'>
                <img src='Iconos/informacion.png' class='col-md-2 iconoInfo'>
            </div>
        
        <div id='enlaces' class='row'>
            <button type='button' class='btn-info col-md-2 offset-md-2' ><a>Profesores</a></button><button type='button' class='btn-info col-md-2'><a>Asignaturas</a></button>
            <button type='button' class='btn-info col-md-2'><a>Alumnos</a></button><button type='button' class='btn-info col-md-2'><a>Guía de uso</a></button>
            <div>
            <div id='volver' class='row'>
            <button type='button' id='bVolver' class='btn-info col-md-4 offset-md-4'><a>Salir</a></button>
            </div>";
                
                
            }else{
                echo"<div id='infoUsuario' class='row'>
                        <p id='nombreUsuario' class='col-md-4 offset-md-4'>".$datos[0]." ".$datos[1]." / ".$datos[2]."</p></div>
                <div id='imagenes' class='row'> 
                <img src='Iconos/asignaturas.png' class='offset-md-3 col-md-2 iconoInfo izquierda'><img src='Iconos/estudiante.png' class='col-md-2 iconoInfo'>
                <img src='Iconos/informacion.png' class='col-md-2 iconoInfo'>
            </div>
        
        <div id='enlaces' class='row'>
            <button type='button' class='offset-md-3 btn-info col-md-2'><a>Asignaturas</a></button>
            <button type='button' class='btn-info col-md-2'><a>Alumnos</a></button><button type='button' class='btn-info col-md-2'><a>Guía de uso</a></button>
            <div>
            <div id='volver' class='row'>
            <button type='button' id='bVolver' class='btn-info col-md-1 offset-md-5'><a>Salir</a></button>
            </div>";
                        
            }
            
        }else{
            header("location:Formulario de entrada.php");
        }
        
        
    include("pieDePagina.html");
    ?>
       
        
         <script type="text/javascript" src="../librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../librerías/bootstrap.min.js"></script>
    </body>
</html>

