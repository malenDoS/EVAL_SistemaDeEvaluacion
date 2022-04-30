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
        include("../Controlador/Asignatura.php");
        include("../Controlador/Alumnos.php");
       
        ?>
        <div id="botonesElegir" class="row">
            <button type='button' class='btn-info botonAlumno col-md-2 <?php if($_SESSION["Tipo"]=="Profesor"){echo"offset-md-5";}else{echo"offset-md-1";} ?>'><a href="AlumnosCentro.php?accion=modificar">Modificar Alumno</a></button>
            <?php
            if($_SESSION["Tipo"]=="Admin"){
            echo"<button type='button' class='btn-info col-md-2 offset-md-2 botonAlumno'><a href='AlumnosCentro.php?accion=borrar'>Borrar Alumno</a></button>";
            echo"<button type='button' class='btn-info col-md-2 offset-md-2 botonAlumno'><a href='AlumnosCentro.php?accion=anadir'>Añadir alumno</a></button>";
            }
            ?>
        </div>
        <div id="contenido" class="row"><?php
        //Compruebo si ha pulsado en el enlace de borrar al alumno.
        if(isset($_GET["alumnoB"])){
            $alumnoABorrar=$_GET["alumnoB"];
            $alumno3=new Alumnos();
            $mensaje3=$alumno3->borrarAlumno($alumnoABorrar);
            if($mensaje3=="Si"){
                echo"<div class='row'><p class='col-md-3 offset-md-4 mensajeI'>Se han borrado los datos correctamente</p></div>";
            }else{
                echo"<div class='row'><p class='col-md-3 offset-md-4 mensajeI'>No se han borrado los datos correctamente</p></div>";
            }
            
        }
        
        //Compruebo si se ha pulsado la opción de añadir alumno en el formulario.
        if(isset($_POST["anadirA"])){
            
            //Guardo los datos del formulario.
            $nombreA=$_POST["Anombre"];
            $apellidoA=$_POST["Aapellido"];
            $claseA=$_POST["Aclase"];
            $Acontacto=$_POST["Acontacto"];
            $Adireccion=$_POST["Adireccion"];
            $Atutor=$_POST["Atutor"];
            
             $alumno4=new Alumnos();
             $mensaje4=$alumno4->anadirAlumno($nombreA,$apellidoA,$claseA,$Acontacto,$Adireccion,$Atutor);
              if($mensaje4=="si"){
                echo"<div class='row'><p class='col-md-3 offset-md-4 mensajeI'>Se ha añadido correctamente al nuevo alumno</p></div>";
            }else{
                echo"<div class='row'><p class='col-md-3 offset-md-4 mensajeI'>No se ha podido añadir correctamente al nuevo alumno</p></div>";
            }
            
                    
        }
        //Compruebo si se ha pulsado la opción de guardar en formulario de modificar.
        if(isset($_POST["guardarD"])){
            $nombreAl=$_POST["nombreA"];
            $apellidoAl=$_POST["apellidoA"];
            $claseAl=$_POST["claseA"];
            $contactoAl=$_POST["contactoP"];
            $direccionAl=$_POST["direccionA"];
            $tutorAl=$_POST["tutorA"];
            $idAl=$_POST["idAl"];
            
            //Guardo los datos.
            $alumno2=new Alumnos();
            $mensaje=$alumno2->guardarModificaciones($nombreAl,$apellidoAl,$claseAl,$contactoAl,$direccionAl,$tutorAl,$idAl);
            if($mensaje=="si"){
                echo"<div class='row'><p class='col-md-3 offset-md-4 mensajeI'>Se han guardado las modificaciones correctamente</p></div>";
            }else{
                echo"<div class='row'><p class='col-md-3 offset-md-4 mensajeI'>No se han guardado las modificaciones correctamente</p></div>";
            }
        }
        
        //Compruebo si se ha pulsado la opción de modificar un alumno.
        if(isset($_GET["alumnoF"])){
            
            //Consulto todos los datos del alumno.
            $idFormulario=$_GET["idA"];
            $alumno=new Alumnos();
            $formulario=$alumno->getFormulario($idFormulario);
            //Consulto los datos de los posibles tutores.
            $tutores=$alumno->tutor();
            //Consulto los datos de las posibles clases.
            $clases=$alumno->getClases();
            
            //Imprimo el formulario.
            echo"<form class='row' action='".$_SERVER["PHP_SELF"]."' method='POST'>";
            echo"<div class='row col-md-12 contenedorA'><label for='nombre' class='offset-md-4 col-md-1 labelA'>Nombre: </label><input type='text' class='col-md-2 aInput' id='nombreA' name='nombreA' value='$formulario[0]'></div>";
             echo"<div class='row col-md-12 contenedorA'><label for='apellido' class='offset-md-4 col-md-1 labelA'>Apellidos: </label><input type='text' class='col-md-2 aInput' id='apellidoA' name='apellidoA' value='$formulario[1]'></div>";
              echo"<div class='row col-md-12 contenedorA'><label for='clase' class='offset-md-4 col-md-1 labelA'>Clase: </label><select class='col-md-2 aInput' id='claseA' name='claseA'><option>Selecciona una opción</option>";for($i=0;$i<count($clases);$i++){echo"<option value='$clases[$i]'>".$clases[$i]."</option>";}echo"</select></div>";
               echo"<div class='row col-md-12 contenedorA'><label for='ContactoP' class='offset-md-4 col-md-1 labelA'>Contacto Padre: </label><input type='text' class='col-md-2 aInput' id='contactoP' name='contactoP' value='$formulario[3]'></div>";
                echo"<div class='row col-md-12 contenedorA'><label for='Dirección' class='offset-md-4 col-md-1 labelA'>Dirección: </label><input type='text' class='col-md-2 aInput' id='direccionA' name='direccionA' value='$formulario[4]'></div>";
                 echo"<div class='row col-md-12 contenedorA'><label for='tutor' class='offset-md-4 col-md-1 labelA'>tutor: </label><select class='col-md-2 aInput' id='tutorA' name='tutorA'><option>Selecciona una opción</option>";while($fila=$tutores->fetch(PDO::FETCH_ASSOC)){echo"<option value='".$fila["nombre"]." ".$fila["apellido"]."'>";echo$fila["nombre"]." ".$fila["apellido"]."</option>";}echo"</select></div>";
                 echo"<div class='oculto'><input type='text' class='col-md-2 aInput' id='idAlumno' name='idAl' value='$formulario[5]'></div>";
                 echo"<div class='row col-md-12'><input type='submit' value='Guardar datos' class='offset-md-4 col-md-4 aInput btn-info' id='guardarD' name='guardarD'></div>";
            echo"</form>";
        }
            //Compruebo si se ha pulsado uno de los enlaces.
        if(isset($_GET["accion"])){
            
            //Según la opción seleccionada, realizo una acción.
            if($_GET["accion"]=="modificar"){
                //Creo la consulta para recibir la información sobre los alumnos.
                $alumno=new Asignatura();
                $infoAlumno=$alumno->infoAlumno();
                //Creo un input de tipo select para elegir el alumno.
                echo"<div class='row' id='selector'>";
                 $contador=0;
                   while($fila=$infoAlumno->fetch(PDO::FETCH_ASSOC)){
                        if($contador==0){
                    echo"<div class='row col-md-12 enlaceA'>";
                }
                $contador++;
                       echo"<a class='col-md-1 opciones' href='AlumnosCentro.php?alumnoF=formulario&idA=".$fila['id_alumno']."'>".$fila["nombre"]." ".$fila["apellido"]."</a>";
                       if($contador==12){
                    echo"</div>";
                    $contador==0;
                }
                   }
               
                echo"</div>";
                
                
               
                
            }else if($_GET["accion"]=="borrar"&&$_SESSION["Tipo"]=="Admin"){
                
                //Imprimo la información de los alumnos.
                $alumno3=new Asignatura();
                $infoAlumno2=$alumno3->infoAlumno();
                $contador2=0;
                while($fila=$infoAlumno2->fetch(PDO::FETCH_ASSOC)){
                        if($contador2==0){
                    echo"<div class='row col-md-12 enlaceA'>";
                }
                $contador2++;
                       echo"<a class='col-md-1 opciones' href='AlumnosCentro.php?alumnoB=".$fila['id_alumno']."'>".$fila["nombre"]." ".$fila["apellido"]."</a>";
                       if($contador2==12){
                    echo"</div>";
                    $contador2==0;
                }
                   }
               
                echo"</div>";
                
                
            }else if($_GET["accion"]=="anadir"&&$_SESSION["Tipo"]=="Admin"){
             
                $alumno4=new Alumnos();
                //Consulto los datos de los posibles tutores.
                $tutores2=$alumno4->tutor();
                //Consulto los datos de las posibles clases.
                $clases2=$alumno4->getClases();
                
                //Imprimo el formulario para añadir un alumno.
                 echo"<form class='row' action='".$_SERVER["PHP_SELF"]."' method='POST'>";
            echo"<div class='row col-md-12 contenedorA'><label for='nombre' class='offset-md-4 col-md-1 labelA'>Nombre: </label><input type='text' class='col-md-2 aInput' id='Anombre' name='Anombre'></div>";
             echo"<div class='row col-md-12 contenedorA'><label for='apellido' class='offset-md-4 col-md-1 labelA'>Apellidos: </label><input type='text' class='col-md-2 aInput' id='Aapellido' name='Aapellido'></div>";
              echo"<div class='row col-md-12 contenedorA'><label for='clase' class='offset-md-4 col-md-1 labelA'>Clase: </label><select class='col-md-2 aInput' id='Aclase' name='Aclase'><option>Selecciona una opción</option>";for($i=0;$i<count($clases2);$i++){echo"<option value='$clases2[$i]'>".$clases2[$i]."</option>";}echo"</select></div>";
               echo"<div class='row col-md-12 contenedorA'><label for='ContactoP' class='offset-md-4 col-md-1 labelA'>Contacto Padre: </label><input type='text' class='col-md-2 aInput' id='Acontacto' name='Acontacto'></div>";
                echo"<div class='row col-md-12 contenedorA'><label for='Dirección' class='offset-md-4 col-md-1 labelA'>Dirección: </label><input type='text' class='col-md-2 aInput' id='Adireccion' name='Adireccion'></div>";
                 echo"<div class='row col-md-12 contenedorA'><label for='tutor' class='offset-md-4 col-md-1 labelA'>tutor: </label><select class='col-md-2 aInput' id='Atutor' name='Atutor'><option>Selecciona una opción</option>";while($fila=$tutores2->fetch(PDO::FETCH_ASSOC)){echo"<option value='".$fila["nombre"]." ".$fila["apellido"]."'>";echo$fila["nombre"]." ".$fila["apellido"]."</option>";}echo"</select></div>";
                 echo"<div class='row col-md-12'><input type='submit' value='Añadir alumno' class='offset-md-4 col-md-4 aInput btn-info' id='anadirA' name='anadirA'></div>";
            echo"</form>";
                
                
            }
        }
        ?>
        </div>
        <?php
        echo"<button type='button' class='offset-md-5 btn-info col-md-2 bot'><a href='MenuDeOpciones.php'>Salir</a></button>";
        include("comunes/pieDePagina.html");
        }else{
            header("location:Formulario de entrada.php");
        }
        ?>}
        <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>