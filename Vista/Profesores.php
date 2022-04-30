<html>
    <head>
         <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profesores</title>
        <link rel="stylesheet" href="librerías/bootstrap.min.css">
         <link rel="stylesheet" href="css/estiloProfesores.css">
         
    </head>
    <body class='container'>
        <?php
            include("../Controlador/Profesor.php");
            include("comunes/Cabecera.html");
            
             //Compruebo si ha entrado un usuario con permisos de administrador.
            session_start();
            if(isset($_SESSION["Tipo"])=="Admin"){
                
            if($_SESSION["Tipo"]=="Admin"){
            //Compruebo si se ha pulsado el botón de guardar datos en el formulario.
            if(isset($_POST["GuardarDatos"])){
                //Guardo los datos en variables.
                $nombreProf=$_POST["nombre"];
                $apellidoProf=$_POST["apellidos"];
                
                $direccionProf=$_POST["direccion"];
                $cargoProf=$_POST["cargo"];
                $asignaturaProf=$_POST["asignaturas"];
                $telefonoProf=$_POST["telefono"];
             
                 $dniProf=$_POST["dni"];
                 $fechaProf=$_POST["fechaNacimiento"];
                 $nombreImagen=$_FILES["imagen"]["name"];
                 $tipoImagen=$_FILES["imagen"]["type"];
                 $tamagnoImagen=$_FILES["imagen"]["size"];
                 $carpetaTemporal=$_FILES["imagen"]["tmp_name"];
                 $emailProf=$_POST["email"];
                 $contrasegnaProf=$_POST["contrasegna"];
                 $tipoUsuario=$_POST["tipoUsu"];
                 
                 //Guardo los datos en la tabla de usuarios registrados.
                 $nuevoProfesor=new Profesor();
                 $resultado1=$nuevoProfesor->registrarProfesor($emailProf,$contrasegnaProf,$tipoUsuario);
                 
                 //Guardo los datos en la tabla de personal.
                 $resultado2=$nuevoProfesor->registrarPersonal($nombreProf,$apellidoProf,$direccionProf,$cargoProf,$asignaturaProf,$telefonoProf,$dniProf,$fechaProf,$nombreImagen,$tamagnoImagen,$tipoImagen,$carpetaTemporal);
                 $mensajeRegistro;
                 if($resultado1=="ok"&&$resultado2=="ok"){
                     $mensajeRegistro="Se han guardado los datos satisfactoriamente";
                 }else if($resultado2=="Imagen"){
                     $mensajeRegistro="Revise el tamaño de la imagen y el tipo de archivo";
                 }else{
                     $mensajeRegistro="No se han podido guardar los datos";
                 }
                  echo"<div class='row'><p class='col-md-6 offset-md-3' id='fraseIns'>".$mensajeRegistro."</p></div>";
                  
            }
            if(isset($_GET["idP"])){
                $BorrarProfesor=new Profesor();
                $mensaje=$BorrarProfesor->borrarProfe($_GET["idP"]);
                if($mensaje=="Si"){
                    $mensaje="Datos borrados satisfactoriamente";
                }else{
                    $mensaje="No se han podido guardar los datos";
                }
                echo"<div class='row'><p class='col-md-6 offset-md-3' id='fraseIns'>".$mensaje."</p></div>";
            }
            
           
          echo"<div id='botones' class='row container'>";
          echo"<button type='button' class='derecha boton btn-info col-md-3 offset-md-3' ><a href='Profesores.php?anadir=si'>Añadir</a></button>";
          echo"<button type='button' class='izquierda boton btn-info col-md-3' ><a href='Profesores.php?Borrar=si'>Borrar</a></button>";
          echo"</div>";
          echo"<div class='row informacionP container'>";
          //Imprimo la información según la opción que ha elegido el usuario.
          if(isset($_GET["Borrar"])){
              
              echo"<div class='row fraseIns'><p id='instruccion' class='col-md-6 offset-md-4'>Pulsa para borrar</p></div>";
              //Imprimo los datos de los profesores de la base de datos.
              $infoProfesores=new Profesor();
              $datos=$infoProfesores->todosLosProfesores();
              
              $contador=0;
              while($fila=$datos->fetch(PDO::FETCH_ASSOC)){
                if($contador==0){
                    echo"<div class='row col-md-12 filaB'>";
                }
                $contador++;
                echo"<button type='button' class='btn-info col-md-1 bProfesor'><a href='Profesores.php?idP=".$fila["ID"]."'>".$fila["nombre"]."<br>".$fila["apellido"]."<br><br>".$fila["cargo"]."</a></button>";
                if($contador==12){
                    echo"</div>";
                    $contador==0;
                }
            }
                  
              
              
          }else if(isset($_GET["anadir"])){
              echo"<form action='".$_SERVER["PHP_SELF"]."' method='POST' enctype='multipart/form-data'>";
              echo"<div class='row columnaInput'>";
              echo"<label for='nombre' class='offset-md-3 col-md-3 etiqueta'>Nombre:</label><input class='col-md-3 inputProfesor' type='text' name='nombre'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='apellidos' class='offset-md-3 col-md-3 etiqueta'>Apellido:</label><input class='col-md-3 inputProfesor' type='text' name='apellidos'>";
              echo"</div>";
              echo"<div class='row columnaInput'>";
              echo"<label for='direccion' class='offset-md-3 col-md-3 etiqueta'>Dirección:</label><input class='col-md-3 inputProfesor' type='text' name='direccion'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='cargo' class='offset-md-3 col-md-3 etiqueta'>Cargo:</label><input class='col-md-3 inputProfesor' type='text' name='cargo'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='asignatura' class='offset-md-3 col-md-3 etiqueta'>Asignatura:</label><select class='col-md-3 inputProfesor' id='asignaturas' name='asignaturas'>"
               . "<option value='educacionFisica'>Educación física</option><option value='matematicas'>Matemáticas</option><option value='geografiaHistoria'>Geografía Historia</option><option value='ingles'>Inglés</option><option value='lenguaCastellana'>Lengua castellana</option><option value='fisica'>Física</option></select>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='telefono' class='offset-md-3 col-md-3 etiqueta'>Teléfono:</label><input class='col-md-3 inputProfesor' type='number' name='telefono'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='dni' class='offset-md-3 col-md-3 etiqueta'>DNI:</label><input class='col-md-3 inputProfesor' type='text' name='dni'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='FechaNacimiento' class='offset-md-3 col-md-3 etiqueta'>Fecha Nacimiento:</label><input class='col-md-3 inputProfesor' type='text' name='fechaNacimiento'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='imagenPerfil' class='offset-md-3 col-md-3 etiqueta'>Imagen:</label><input  name='imagen' class='col-md-3 inputProfesor' type='file' id='imagen'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='email' class='offset-md-3 col-md-3 etiqueta'>Email:</label><input class='col-md-3 inputProfesor' type='text' name='email'>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label for='contrasegna' class='offset-md-3 col-md-3 etiqueta'>Contraseña:</label><input class='col-md-3 inputProfesor' type='password' name='contrasegna'>";
              echo"</div>";
              echo"<div class='row columnaInput'>";
              echo"<label for='Tipo usuario' class='offset-md-3 col-md-3 etiqueta'>Tipo usuario:</label><select class='col-md-3 inputProfesor' id='tipoU' name='tipoUsu'>"
               . "<option value='Administrador'>Administrador</option><option value='Usuario normal'>Usuario normal</option></select>";
              echo"</div>";
               echo"<div class='row columnaInput'>";
              echo"<label class='col-md-4'></label><input class='offset-md-3 col-md-4 inputProfesor botonGuardar' type='Submit' name='GuardarDatos' value='Guardar datos'>";
              echo"</div>";
              echo"</form>";
          }
          echo"</div>";
          echo"</div>";
            }else{
                header("Formulario de entrada.php");
            }
            }else{
                header("Formulario de entrada.php");
            }
         ?>
       
         <?php
         echo"<button type='button' class='offset-md-5 btn-info col-md-2 bot'><a href='MenuDeOpciones.php'>Salir</a></button>";
          include("comunes/pieDePagina.html");
         ?>
        
        <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>