<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="librerías/bootstrap.min.css">
        <link rel="stylesheet" href="css/estiloPerfil.css">
        <title>Perfil Personal</title>
    </head>
    <body class="container">
        <?php
        include("comunes/Cabecera.html");
        
        //Evalúo el tipo de usuario que ha iniciado la sesión.
        session_start();
        if(isset($_SESSION["Tipo"])){
            include("../Controlador/Profesor.php");
            
            
            //Compruebo si se ha pulsado el botón de enviar del formulario.
            if(isset($_POST["guardar"])){
                //Guardo la información de los inputs en variables.
                $nombreU=$_POST["nombre"];
                $apellidoU=$_POST["apellido"];
                $nacimientoU=$_POST["nacimiento"];
                $dniU=$_POST["dni"];
                $telefonoU=$_POST["telefono"];
                $direccionU=$_POST["direccion"];
                $cargoU=$_POST["cargo"];
                $asignaturaU=$_POST["asignaturas"];
                $idUs=$_POST["idUsuario"];
                $profe=new Profesor();
                $profe->guardarDatosU($nombreU,$apellidoU,$nacimientoU,$dniU,$telefonoU,$direccionU,$cargoU,$asignaturaU,$idUs);
            }
            
            if($_SESSION["Tipo"]=="Admin"){
                 /*Guardo el id del usuario y realizo la consulta para rellenar
                sus datos en el formulario*/
                
                if(isset($_GET["us"])){
                    //Consulto los ids.
                    $profesores=new Profesor();
                    $idProfesores=$profesores->idsProfesor();
                    $contador=1;
                    while($fila=$idProfesores->fetch(PDO::FETCH_ASSOC)){
                        if($contador==$_GET["us"]){
                            $usuarioF=$fila["ID"];
                        }
                        $contador++;
                    }
                  $idU=$_GET["us"];
                }else{
                $idU=$_SESSION["id"];
                }
                $datos=new Profesor();
                if(isset($_GET["us"])){
                    $usuario=$datos->getPerfilUsuario($usuarioF);
                }else{
                $usuario=$datos->getPerfilUsuario($idU);
                }
                //Guardo en una variable la cantidad la cantidad de profesores que hay en la base de datos.
                $numeroProfesores=$datos->paginacionProfesores();
            }else{
                /*Guardo el id del usuario y realizo la consulta para rellenar
                sus datos en el formulario*/
                
                $idU=$_SESSION["id"];
                $datos=new Profesor();
                $usuario=$datos->getPerfilUsuario($idU);
            }
            
            //Imprimo el formulario con los datos según el tipo de usuario.
            echo "<div id='informacionP'>
        <div class='row colImagen'>
            <img class='col-md-2' id='imagenP' src='imagenes/fotosPerfil/".$usuario[13]."'>
        </div>
        <form action='".$_SERVER["PHP_SELF"]."' method='post' id='formulario'>
            <div class='row columna'>
                <label for='Nombre' class='titulo col-md-2  offset-md-3'>Nombre:</label><input name='nombre' id='nombreP' type='text' value='".$usuario[0]."' class='col-md-3 infoP'>
            </div>
            <div class='row columna'>
                 <label for='Apellido' class='titulo col-md-2 offset-md-3'>Apellido:</label><input name='apellido' id='apellidoP' type='text' value='".$usuario[1]."' class='col-md-3 infoP'>
            </div>
            <div class='row columna'>
                 <label for='Fecha' class='titulo col-md-2 offset-md-3'>Fecha Nacimiento:</label><input name='nacimiento' id='nacimientoP' type='text' value='".$usuario[2]."' class='col-md-3 infoP'>
            </div>
            <div class='row columna'>
                 ";if($_SESSION["Tipo"]=="Admin"){echo"<a ";if($idU==1){echo "href='PerfilPersonal.php?us=".($idU+1)."'";}else{echo "href='PerfilPersonal.php?us=".($idU-1)."'";}   echo" class='col-md-1'><img style='width:50px; height:50px' src=";if($idU==1){echo"'imagenes/Iconos/flechaDerecha.png'></a>";}else{ echo"'imagenes/Iconos/flechaIzquierda.png'></a>";}} echo"<label for='DNI' class='titulo ";if($_SESSION["Tipo"]=="Admin"){echo "offset-md-2";}else{echo "offset-md-3";}echo " col-md-2'>DNI:</label><input name='dni' id='dniP' type='text' value='".$usuario[3]."' class='col-md-3 infoP'>";if($_SESSION["Tipo"]=="Admin"){echo"<a ";if($idU!=$numeroProfesores){echo "href='PerfilPersonal.php?us=".($idU+1)."'";}else{echo "href='PerfilPersonal.php?us=".($idU-1)."'";}echo" class='derecha offset-md-3 col-md-1'><img style='width:50px; height:50px' src=";if($idU==$numeroProfesores){echo"'imagenes/Iconos/flechaIzquierda.png'></a>";}
                 else{ echo"'imagenes/Iconos/flechaDerecha.png'></a>";}}
                 echo "</div>
            <div class='row columna'>
                 <label for='Telefono' class='titulo col-md-2 offset-md-3'>Teléfono:</label><input name='telefono' id='telefonoP' type='number' value='".$usuario[4]."' class='col-md-3 infoP'>
            </div>
             </div>
             <div class='row columna'>
                 <label for='Direccion' class='titulo col-md-2 offset-md-3'>Dirección:</label><input type='text' id='direccionP' name='direccion' value='".$usuario[5]."' class='col-md-3 infoP'>
             </div>
             <div class='row columna'>
                <label for='Cargo' class='titulo col-md-2 offset-md-3'>Cargo:</label>"; if($_SESSION["Tipo"]=="Profesor"){echo "<input name='cargo' type='text' id='cargo' class='col-md-3 sinEscritura' readonly value='".$usuario[6]."'></input>";}else if($_SESSION["Tipo"]=="Admin"){echo "<input name='cargo' id='cargo' type='text' class='col-md-3 infoP' value='".$usuario[6]."'></input>";}
            echo"</div>
             </div>
             <div class='columna'>
                 <div class='row'>
                 <div class='col-md-4 offset-md-6'>
                     <label for='asignaturas' class='titulo'>Asignatura:</label>
                 </div>
                 </div>
                 
                 <div class='row botones'>
                 <div class='col-md-8 offset-md-3'>
                     <label for='asignaturas'>Educación física:</label>
                     <input type='radio' name='asignaturas'";if($usuario[7]==1){echo "checked";} echo " class='bRadio' value='Educacion Fisica'><label for='asignaturas'>Matemáticas:</label>
                     <input type='radio' name='asignaturas'"; if($usuario[8]==1){echo "checked";} echo " class='bRadio' value='Matematicas'><label for='asignaturas'>Geografía/Historia:</label>
                     <input type='radio' name='asignaturas'"; if($usuario[9]==1){echo "checked";} echo " class='bRadio' value='Geografia/Historia'><label for='asignaturas'>Lengua Castellana:</label>
                     <input type='radio' name='asignaturas'"; if($usuario[10]==1){echo "checked";} echo " class='bRadio' value='Lengua Castellana'><label for='asignaturas'>Inglés:</label>
                     <input type='radio' name='asignaturas'"; if($usuario[11]==1){echo "checked";} echo " class='bRadio' value='Ingles'><label for='asignaturas'>Fisica:</label>
                     <input type='radio' name='asignaturas'"; if($usuario[12]==1){echo "checked";} echo " class='bRadio' value='Fisica'>
                 </div>
                 </div>
            </div>
            <div class='row columna'>
            <input class='id' name='idUsuario' type='text' value='".$usuario[14]."'>
                <input value='Guardar todos los cambios' name='guardar' type='submit' class='bot offset-md-4 col-md-2' id='botonGuardar'><button type='button' class='btn-info col-md-2 bot'><a href='MenuDeOpciones.php'>Salir</a></button><div class='col-md-2'><span class='fraseValidacion' id='fraseV'></span></div>
        </div></form";
                    
            
        }else{
            header('location:Formulario de entrada.php');
        }
         
        ?>
        
        
        <?php
        include("comunes/PieDePagina.html");
        if(isset($_GET["me"])){
                    $mensaje=$_GET["me"];
                    if($mensaje=="Si"){
                    echo"<p class='fraseValidacion'>Información guardada satisfactoriamente. </p>";
                    }else{
                        echo"<p class='fraseValidacion'>No se ha podido guardar la información.</p>";
                    }
                }
        ?>
        <script type="text/javascript" src="javascript/validaPerfil.js"></script>
         <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>

