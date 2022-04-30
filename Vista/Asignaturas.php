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
            
            if(isset($_GET["mensaje"])){
                if($_GET["mensaje"]=="si"){
                    echo"<div id='mensaje' class='row'><p class='col-md-12'>Se han guardado los datos satisfactoriamente</p></div>";
                }else{
                    echo"<div id='mensaje' class='row'><p class='col-md-12'>No se han podido guarrdar los datos</p></div>";
                }
            }
            
             $asignaturas=new Asignatura();
             //Guardo en una variable, la asignatura que imparte el usuario que usa la web.
            $asignaturaProfe=$asignaturas->asignaturaProfesor($_SESSION["id"]);
            //Compruebo si se ha pulsado el botón de envío del formulario.
            if(isset($_POST["guardar"])){
                
                //Guardo toda la información en variables según el usuario.
                if($_SESSION["Tipo"]=="Admin"||$asignaturaProfe=="educacion Fisica"){
                    $evaluacion1=$_POST["primEF"];
                    $evaluacion2=$_POST["segEF"];
                    $evaluacion3=$_POST["terEF"];
                    $evaluacionFinal=$_POST["nfEF"];
                    $observaciones=$_POST["obsEF"];
                    $idA=$_POST["idAlumno"];
                    //Guardo la información.
                    if($_POST["tipoAlumnoEduFi"]=="noEval"){
                        $mensaje=$asignaturas->insertarEvaluacion($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones,"educacionfisica");
                         if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    
                    }else{
                    $mensaje=$asignaturas->guardarEduF($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones);
                    if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    }
                    
                }if($_SESSION["Tipo"]=="Admin"||$asignaturaProfe=="fisica"){
                    $evaluacion1=$_POST["primF"];
                    $evaluacion2=$_POST["segF"];
                    $evaluacion3=$_POST["terF"];
                    $evaluacionFinal=$_POST["nfF"];
                    $observaciones=$_POST["obsF"];
                    $idA=$_POST["idAlumno"];
                    //Guardo la información.
                    if($_POST["tipoAlumnoFi"]=="noEval"){
                        $mensaje=$asignaturas->insertarEvaluacion($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones,"fisica");
                         if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    
                    }else{
                    $asignaturas->guardarFisica($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones);
                    }
                    
                }if($_SESSION["Tipo"]=="Admin"||$asignaturaProfe=="ingles"){
                    $evaluacion1=$_POST["primI"];
                    $evaluacion2=$_POST["segI"];
                    $evaluacion3=$_POST["terI"];
                    $evaluacionFinal=$_POST["nfI"];
                    $observaciones=$_POST["obsI"];
                    $idA=$_POST["idAlumno"];
                    //Guardo la información.
                    if($_POST["tipoAlumnoIn"]=="noEval"){
                        $mensaje=$asignaturas->insertarEvaluacion($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones,"ingles");
                         if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    
                    }else{
                    $asignaturas->guardarIngles($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones);
                    }
                    
                }if($_SESSION["Tipo"]=="Admin"||$asignaturaProfe=="lengua"){
                    $evaluacion1=$_POST["primL"];
                    $evaluacion2=$_POST["segL"];
                    $evaluacion3=$_POST["terL"];
                    $evaluacionFinal=$_POST["nfL"];
                    $observaciones=$_POST["obsL"];
                    $idA=$_POST["idAlumno"];
                    //Guardo la información.
                    if($_POST["tipoAlumnoLen"]=="noEval"){
                        $mensaje=$asignaturas->insertarEvaluacion($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones,"lenguacastellana");
                         if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    
                    }else{
                    $asignaturas->guardarLengua($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones);
                    }
                    
                }if($_SESSION["Tipo"]=="Admin"||$asignaturaProfe=="geografia historia"){
                    $evaluacion1=$_POST["primG"];
                    $evaluacion2=$_POST["segG"];
                    $evaluacion3=$_POST["terG"];
                    $evaluacionFinal=$_POST["nfG"];
                    $observaciones=$_POST["obsG"];
                    $idA=$_POST["idAlumno"];
                    //Guardo la información.
                    if($_POST["tipoAlumnoGeo"]=="noEval"){
                        $mensaje=$asignaturas->insertarEvaluacion($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones,"geografiahistoria");
                         if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    
                    }else{
                    $asignaturas->guardarGeografia($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones);
                    }
                    
                }if($_SESSION["Tipo"]=="Admin"||$asignaturaProfe=="matematicas"){
                    $evaluacion1=$_POST["primM"];
                    $evaluacion2=$_POST["segM"];
                    $evaluacion3=$_POST["terM"];
                    $evaluacionFinal=$_POST["nfM"];
                    $observaciones=$_POST["obsM"];
                    $idA=$_POST["idAlumno"];
                    //Guardo la información.
                    if($_POST["tipoAlumnoMa"]=="noEval"){
                        $mensaje=$asignaturas->insertarEvaluacion($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones,"matematicas");
                         if($_SESSION["Tipo"]=="Admin"){
                        echo$mensaje;
                    }
                    
                    }else{
                    $asignaturas->guardarMatematicas($idA,$evaluacion1,$evaluacion2,$evaluacion3,$evaluacionFinal,$observaciones);
                    }
                    
                }
           
                
                
                }
            
            //Realizo una consulta para recibir la información de todos los alumnos del centro.
            $infoAlumnado=$asignaturas->infoAlumno();
            //Guardo en una variable, la asignatura que imparte el usuario que usa la web.
          
            
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
             
               echo"<form action='".$_SERVER["PHP_SELF"]."' method='POST'>";
                echo"<div id='nombreColumnas' class='col-md-12 row'>";
                echo"<p class='col-md-2 offset-md-2'>1a Eval</p><p class='col-md-2'>2a Eval</p><p class='col-md-2'>3a Eval</p>"
                . "<p class='col-md-2'>Nota Final</p><p class='col-md-2'>Observaciones</p></div>";
                //Un contenedor para cada asignatura.
                echo"<div id='notasEduF' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="educacion Fisica"){echo"noProfe'";}else{echo"'";}echo">Educación Física</p><input name='primEF' type='text' value='".$infoEvaluacion[3]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="educacion Fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='segEF' type='text' value='".$infoEvaluacion[4]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="educacion Fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='terEF' type='text' value='".$infoEvaluacion[5]."' class='col-md-2  ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="educacion Fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='nfEF' type='text' value='".$infoEvaluacion[6]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="educacion Fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='obsEF' type='text' value='".$infoEvaluacion[7]."' class='col-md-2 observaciones ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="educacion Fisica"){echo"noProfe' readonly";}else{echo"'";}echo"></div>";
                
                echo"<div id='notasFis' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="fisica"){echo"noProfe'";}else{echo"'";}echo">Física</p><input name='primF' type='text' value='".$infoEvaluacion[8]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='segF' type='text' value='".$infoEvaluacion[9]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='terF' type='text' value='".$infoEvaluacion[10]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='nfF' type='text' value='".$infoEvaluacion[11]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="fisica"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='obsF' type='text' value='".$infoEvaluacion[12]."' class='col-md-2 observaciones ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="fisica"){echo"noProfe' readonly";}else{echo"'";}echo"></div>";
                
                echo"<div id='notasIng' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="ingles"){echo"noProfe'";}else{echo"'";}echo">Inglés</p><input name='primI' type='text' value='".$infoEvaluacion[13]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="ingles"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='segI' type='text' value='".$infoEvaluacion[14]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="ingles"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='terI' type='text' value='".$infoEvaluacion[15]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="ingles"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='nfI' type='text' value='".$infoEvaluacion[16]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="ingles"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='obsI' type='text' value='".$infoEvaluacion[17]."' class='col-md-2 observaciones ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="ingles"){echo"noProfe' readonly";}else{echo"'";}echo"></div>";
                
                echo"<div id='notasLen' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="lengua"){echo"noProfe'";}else{echo"'";}echo">Lengua Castellana</p><input name='primL' type='text' value='".$infoEvaluacion[18]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="lengua"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='segL' type='text' value='".$infoEvaluacion[19]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="lengua"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='terL' type='text' value='".$infoEvaluacion[20]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="lengua"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='nfL' type='text' value='".$infoEvaluacion[21]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="lengua"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='obsL' type='text' value='".$infoEvaluacion[22]."' class='col-md-2 observaciones ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="lengua"){echo"noProfe' readonly";}else{echo"'";}echo"></div>";
                
                echo"<div id='notasGeo' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="geografia historia"){echo"noProfe'";}else{echo"'";}echo">Geografía Historia</p><input name='primG' type='text' value='".$infoEvaluacion[23]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="geografia historia"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='segG' type='text' value='".$infoEvaluacion[24]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="geografia historia"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='terG' type='text' value='".$infoEvaluacion[25]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="geografia historia"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='nfG' type='text' value='".$infoEvaluacion[26]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="geografia historia"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='obsG' type='text' value='".$infoEvaluacion[27]."' class='col-md-2 observaciones ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="geografia historia"){echo"noProfe' readonly";}else{echo"'";}echo"></div>";
                
                echo"<div id='notasMat' class='col-md-12 row filaNotas'>";
                echo"<p class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="matematicas"){echo"noProfe'";}else{echo"'";}echo">Matemáticas</p><input name='primM' type='text' value='".$infoEvaluacion[28]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="matematicas"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='segM' type='text' value='".$infoEvaluacion[29]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="matematicas"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='terM' type='text' value='".$infoEvaluacion[30]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="matematicas"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='nfM' type='text' value='".$infoEvaluacion[31]."' class='col-md-2 ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="matematicas"){echo"noProfe' readonly";}else{echo"'";}echo">"
                        . "<input name='obsM' type='text' value='".$infoEvaluacion[32]."' class='col-md-2 observaciones ";if($_SESSION["Tipo"]!="Admin"&&$asignaturaProfe!="matematicas"){echo"noProfe' readonly";}else{echo"'";}echo"></div>";
                
                //Dos botones para guardar los cambios o salir.
                echo"<div id='guardarSalir' class='col-md-12 row'>";
                echo"<input value='Guardar Evaluación' name='guardar' type='submit' class='col-md-6'><button type='button' class='btn-info col-md-6 bot'><a href='Asignaturas.php'>Volver</a></button></div>";
                echo"<input id='idAlumno' name='idAlumno' type='text' value='".$idAlumno."'>";
                $tipoAlumnoEduFi="Evaluado";
                $tipoAlumnoFi="Evaluado";
                $tipoAlumnoIn="Evaluado";
                $tipoAlumnoLen="Evaluado";
                $tipoAlumnoGeo="Evaluado";
                $tipoAlumnoMa="Evaluado";
                if($infoEvaluacion[3]==null&&$infoEvaluacion[4]==null&&$infoEvaluacion[5]==null&&$infoEvaluacion[6]==null&&$infoEvaluacion[7]==null){
                    $tipoAlumnoEduFi="noEval";
                }
                 if($infoEvaluacion[8]==null&&$infoEvaluacion[9]==null&&$infoEvaluacion[10]==null&&$infoEvaluacion[11]==null&&$infoEvaluacion[12]==null){
                    $tipoAlumnoFi="noEval";
                }
                 if($infoEvaluacion[13]==null&&$infoEvaluacion[14]==null&&$infoEvaluacion[15]==null&&$infoEvaluacion[16]==null&&$infoEvaluacion[17]==null){
                    $tipoAlumnoIn="noEval";
                }
                 if($infoEvaluacion[18]==null&&$infoEvaluacion[19]==null&&$infoEvaluacion[20]==null&&$infoEvaluacion[21]==null&&$infoEvaluacion[22]==null){
                    $tipoAlumnoLen="noEval";
                }
                 if($infoEvaluacion[23]==null&&$infoEvaluacion[24]==null&&$infoEvaluacion[25]==null&&$infoEvaluacion[26]==null&&$infoEvaluacion[27]==null){
                    $tipoAlumnoGeo="noEval";
                }
                 if($infoEvaluacion[28]==null&&$infoEvaluacion[29]==null&&$infoEvaluacion[30]==null&&$infoEvaluacion[31]==null&&$infoEvaluacion[32]==null){
                    $tipoAlumnoMa="noEval";
                }
                
                echo"<input id='tipoAlumnoEduFi' class='oculto' name='tipoAlumnoEduFi' type='text' value='".$tipoAlumnoEduFi."'>";
                echo"<input id='tipoAlumnoFi' class='oculto' name='tipoAlumnoFi' type='text' value='".$tipoAlumnoFi."'>";
                echo"<input id='tipoAlumnoIn' class='oculto' name='tipoAlumnoIn' type='text' value='".$tipoAlumnoIn."'>";
                echo"<input id='tipoAlumnoMa' class='oculto' name='tipoAlumnoMa' type='text' value='".$tipoAlumnoMa."'>";
                echo"<input id='tipoAlumnoGeo' class='oculto' name='tipoAlumnoGeo' type='text' value='".$tipoAlumnoGeo."'>";
                echo"<input id='tipoAlumnoLen' class='oculto' name='tipoAlumnoLen' type='text' value='".$tipoAlumnoLen."'>";
                echo"</form>";
                echo"</div>";
                
                
            }
            
        }else{
            //Redirecciono al usuario al formulario de entrada.
            header("Formulario de entrada.php");
        }
        ?>
        
        <?php
        echo"<button type='button' class='offset-md-5 btn-info col-md-2 bot sal'><a href='MenuDeOpciones.php'>Salir</a></button>";
        include("comunes/pieDePagina.html");
        ?>
         <script type="text/javascript" src="librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="librerías/bootstrap.min.js"></script>
    </body>
</html>
