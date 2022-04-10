
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="librerías/bootstrap.min.css">
        <link rel="stylesheet" href="css/estiloMenuDeOpciones.css">
        <title>Menú de opciones</title>
    </head>
    <body class="container">
    <?php
    //Incluyo la cabecera.
    include("comunes/Cabecera.html");
    
        
        //Verifico si la sesión está iniciada.
        session_start();
        if(isset($_SESSION["Tipo"])){
            
            include("../Controlador/Registrado.php");
                //Compruebo los datos de la persona que entra.
                $idUsuario=$_SESSION["id"];
                $usuario=new Registrado();
                $datos=$usuario->usuarioMenu($idUsuario);
            //Imprimo el menú según el tipo de usuario.
            if($_SESSION["Tipo"]=="Admin"){
                
                
                //Imprimo en un contenedor la información del usuario.
                echo"<div id='infoUsuario' class='row'>
                        <p id='nombreUsuario' class='col-md-4 offset-md-4'>".$datos[0]." ".$datos[1]." / ".$datos[2]."</p>
                         </div>";
                //Imprimo las opciones del menú.
                echo"<div id='imagenes/imagenes' class='row'> 
                    <img src='imagenes/Iconos/Perfil.png' class='col-md-2 offset-md-1 iconoInfo izquierda'>
                <img src='imagenes/Iconos/profesora.png' class='col-md-2 iconoInfo'><img src='imagenes/Iconos/asignaturas.png' class='col-md-2 iconoInfo'><img src='imagenes/Iconos/estudiante.png' class='col-md-2 iconoInfo'>
                <img src='imagenes/Iconos/informacion.png' class='col-md-2 iconoInfo'>
            </div>
        
        <div id='enlaces' class='row'>
            <button type='button' class='btn-info col-md-2 offset-md-1' ><a href='PerfilPersonal.php'>Perfil</a></button>
            <button type='button' class='btn-info col-md-2'><a>Profesores</a></button><button type='button' class='btn-info col-md-2'><a href='Asignaturas.php'>Asignaturas</a></button>
            <button type='button' class='btn-info col-md-2'><a>Alumnos</a></button><button type='button' class='btn-info col-md-2'><a>Guía de uso</a></button>
            <div>
            <div id='volver' class='row'>
            <button type='button' id='bVolver' class='btn-info col-md-4 offset-md-4'><a>Salir</a></button>
            </div>";
                
                
            }else{
                echo"<div id='infoUsuario' class='row'>
                        <p id='nombreUsuario' class='col-md-4 offset-md-4'>".$datos[0]." ".$datos[1]." / ".$datos[2]."</p></div>
                <div id='imagenes' class='row'> 
                <img src='imagenes/Iconos/Perfil.png' class='col-md-2 offset-md-2 iconoInfo izquierda'>
                <img src='imagenes/Iconos/asignaturas.png' class='col-md-2'><img src='imagenes/Iconos/estudiante.png' class='col-md-2 iconoInfo'>
                <img src='imagenes/Iconos/informacion.png' class='col-md-2 iconoInfo'>
            </div>
        
        <div id='enlaces' class='row'>
            <button type='button' class='btn-info col-md-2 offset-md-2' ><a href='PerfilPersonal.php?'>Perfil</a></button>
            <button type='button' class='btn-info col-md-2'><a href='Asignaturas.php'>Asignaturas</a></button>
            <button type='button' class='btn-info col-md-2'><a>Alumnos</a></button><button type='button' class='btn-info col-md-2'><a>Guía de uso</a></button>
            <div>
            <div id='volver' class='row'>
            <button type='button' id='bVolver' class='btn-info col-md-1 offset-md-5'><a href='MenuDeOpciones.php'>Salir</a></button>
            </div>";
                        
            }
            
        }else{
            header("location:Formulario de entrada.php");
        }
        
        
    include("comunes/pieDePagina.html");
    ?>
       
        
         <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>

