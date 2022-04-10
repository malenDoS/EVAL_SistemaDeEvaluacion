<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Asignaturas</title>
         <link rel="stylesheet" href="librerías/bootstrap.min.css">
         <link rel="stylesheet" href="css/estiloAsignatura.css">
    </head>
    <body class="container">
        <?php
        include("comunes/Cabecera.html");
        ?>
        <!--Compruebo si la sesión está iniciada-->
        <?php 
        session_start();
        if(isset($_SESSION["Tipo"])){
            include("../Controlador/Asignatura.php");
            
            //Realizo una consulta para recibir la información de todos los alumnos del centro.
            $asignaturas=new Asignatura();
            $infoAlumnado=$asignaturas->infoAlumno();
            
            //Imprimo los resultados en el contenedor.
            
             //La variable contador controla el número de enlaces por columna.
             $contador=0;
             echo"<div id='alumnos' class='row'>";
            while($fila=$infoAlumnado->fetch(PDO::FETCH_ASSOC)){
                if($contador==0){
                    echo"<div class='row col-md-12'>";
                }
                $contador++;
                echo"<button type='button' class='btn-info col-md-1 bAlumno'><a href='Asignaturas.php?idA=".$fila["id_alumno"]."'>".$fila["nombre"]."<br>".$fila["apellido"]."</a></button>";
                if($contador==12){
                    echo"</div>";
                    $contador==0;
                }
            }
            echo"</div>";
        
            //Si el profesor ha pulsado en el botón de algún alumno, se imprimirá la información referente a sus notas.
            if(isset($_GET["idA"])){
                //Consulto cuales son las notas de dicho alumno y su información.
                $idAlumno=$_GET["idA"];
                $infoEvaluacion=$asignaturas->evaluacionAlumno($idAlumno);
                
                //Imprimo la información de las evaluaciones.
                echo "<div id='notas' class='row container'>";
                echo"<div id='nombreApellido' class='col-md-12 row'>";
                echo"<p class='col-md-12'>".$infoEvaluacion[0]." ".$infoEvaluacion[1]." // Clase:".$infoEvaluacion[2]."</p></div>";
             
               echo"<form>";
                echo"<div id='nombreColumnas' class='col-md-12 row'>";
                echo"<p class='col-md-2 offset-md-2'>1a Eval</p><p class='col-md-2'>2a Eval</p><p class='col-md-2'>3a Eval</p>"
                . "<p class='col-md-2'>Nota Final</p><p class='col-md-2'>Observaciones</p></div>";
                //Un contenedor para cada asignatura.
                echo"<div id='notasEduF' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2'>Educación Física</p><input name='notas' type='text' value='".$infoEvaluacion[3]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[4]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[5]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[6]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[7]."' class='col-md-2 observaciones'></div>";
                
                echo"<div id='notasFis' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2'>Física</p><input name='notas' type='text' value='".$infoEvaluacion[8]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[9]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[10]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[11]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[12]."' class='col-md-2 observaciones'></div>";
                
                echo"<div id='notasIng' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2'>Inglés</p><input name='notas' type='text' value='".$infoEvaluacion[13]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[14]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[15]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[16]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[17]."' class='col-md-2 observaciones'></div>";
                
                echo"<div id='notasLen' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2'>Lengua Castellana</p><input name='notas' type='text' value='".$infoEvaluacion[18]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[19]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[20]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[21]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[22]."' class='col-md-2 observaciones'></div>";
                
                echo"<div id='notasGeo' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2'>Geografía Historia</p><input name='notas' type='text' value='".$infoEvaluacion[23]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[24]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[25]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[26]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[27]."' class='col-md-2 observaciones'></div>";
                
                echo"<div id='notasMat' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2'>Matemáticas</p><input name='notas' type='text' value='".$infoEvaluacion[28]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[29]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[30]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[31]."' class='col-md-2'>"
                        . "<input name='notas' type='text' value='".$infoEvaluacion[32]."' class='col-md-2 observaciones'></div>";
                
                //Dos botones para guardar los cambios o salir.
                echo"<div id='guardarSalir' class='col-md-12 row'>";
                echo"<input value='Guardar Evaluación' name='guardar' type='submit' class='col-md-6'><input value='Volver al menú' type='submit' class='col-md-6'></div>";
                echo"<input id='idAlumno' name='idAlumno' type='text' value='".$idAlumno."'>";
                echo"</form>";
                echo"</div>";
                
                
            }
            
        }else{
            //Redirecciono al usuario al formulario de entrada.
            header("Formulario de entrada.php");
        }
        ?>
        
        <?php
        include("comunes/pieDePagina.html");
        ?>
         <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>
