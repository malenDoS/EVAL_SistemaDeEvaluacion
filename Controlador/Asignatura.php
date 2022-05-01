<?php
    include("../Modelo/BaseDatos.php");
class Asignatura{
    
    private $idAlumno;
    private $primeraE;
    private $segundaE;
    private $terceraE;
    private $notaFinal;
    private $observaciones;
    private $conexion;
    
    function __construct(){
        //Creo la conexión PDO.
        $this->conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
     
    //Función para enviar la información de todo el alumnado.
    function infoAlumno(){
        $consulta="SELECT nombre,apellido,id_alumno FROM alumnos";
        //Creo una instancia de la clase base de datos.
        $baseDatos=new BaseDatos($this->conexion);
        //Realizo la consuta enviando la sentencia sql.
        $alumnado=$baseDatos->getInfoAlumnado($consulta);
        return $alumnado;
        
    }
    
    //Función para buscar la asignatura que imparte el profesor según su id.
    function asignaturaProfesor($idU){
        $consulta="Select educacionFisica,matematicas,geografiaHistoria,lengua,ingles,fisica FROM personal WHERE ID=".$idU."";
        $baseDatos=new BaseDatos($this->conexion);
        //Realizo la consulta de la sentencia sql.
        $asignatura=$baseDatos->asignatura($consulta);
        return$asignatura;
    }
    
    //Función que consulta las notas y las observaciones de cada una de las asignaturas según el id del alumno.
    function evaluacionAlumno($idAlumno){
        $consulta="Select nombre, apellido,clase FROM alumnos WHERE id_alumno=".$idAlumno."";
        $consulta2="SELECT primeraEval,segundaEval,terceraEval,notaFinal,observaciones FROM educacionfisica WHERE alumno=".$idAlumno."";
        $consulta3="SELECT primeraEval,segundaEval,terceraEval,notaFinal,observaciones FROM fisica WHERE alumno=".$idAlumno."";
        $consulta4="SELECT primeraEval,segundaEval,terceraEval,notaFinal,observaciones FROM ingles WHERE alumno=".$idAlumno."";
        $consulta5="SELECT primeraEval,segundaEval,terceraEval,notaFinal,observaciones FROM lenguacastellana WHERE alumno=".$idAlumno."";
        $consulta6="SELECT primeraEval,segundaEval,terceraEval,notaFinal,observaciones FROM geografiahistoria WHERE alumno=".$idAlumno."";
        $consulta7="SELECT primeraEval,segundaEval,terceraEval,notaFinal,observaciones FROM matematicas WHERE alumno=".$idAlumno."";
        
        //Realizo las consultas.
        $baseDatos=new BaseDatos($this->conexion);
        $alumno=$baseDatos->credencialesAlumno($consulta);
        $educacionFisica=$baseDatos->nEducacionFisica($consulta2);
        $fisica=$baseDatos->nFisica($consulta3);
        $ingles=$baseDatos->nIngles($consulta4);
        $lenguacastellana=$baseDatos->nLenguacastellana($consulta5);
        $geografiaHistoria=$baseDatos->nGeografiaH($consulta6);
        $matematicas=$baseDatos->nMatematicas($consulta7);
        
        //Creo un array para gestionar toda la información.
        $evaluacion=array();
        //Recorro los diferentes resultados.
        $info=$alumno->fetch(PDO::FETCH_ASSOC);
        $evaluacion[0]=$info["nombre"];
        $evaluacion[1]=$info["apellido"];
        $evaluacion[2]=$info["clase"];
        
        $evalEduFi=$educacionFisica->fetch(PDO::FETCH_ASSOC);
        $evaluacion[3]=$evalEduFi["primeraEval"];
        $evaluacion[4]=$evalEduFi["segundaEval"];
        $evaluacion[5]=$evalEduFi["terceraEval"];
        $evaluacion[6]=$evalEduFi["notaFinal"];
        $evaluacion[7]=$evalEduFi["observaciones"];
        
        $evalFisica=$fisica->fetch(PDO::FETCH_ASSOC);
        $evaluacion[8]=$evalFisica["primeraEval"];
        $evaluacion[9]=$evalFisica["segundaEval"];
        $evaluacion[10]=$evalFisica["terceraEval"];
        $evaluacion[11]=$evalFisica["notaFinal"];
        $evaluacion[12]=$evalFisica["observaciones"];
        
        $evalIngles=$ingles->fetch(PDO::FETCH_ASSOC);
        $evaluacion[13]=$evalIngles["primeraEval"];
        $evaluacion[14]=$evalIngles["segundaEval"];
        $evaluacion[15]=$evalIngles["terceraEval"];
        $evaluacion[16]=$evalIngles["notaFinal"];
        $evaluacion[17]=$evalIngles["observaciones"];
        
        $evalLengua=$lenguacastellana->fetch(PDO::FETCH_ASSOC);
        $evaluacion[18]=$evalLengua["primeraEval"];
        $evaluacion[19]=$evalLengua["segundaEval"];
        $evaluacion[20]=$evalLengua["terceraEval"];
        $evaluacion[21]=$evalLengua["notaFinal"];
        $evaluacion[22]=$evalLengua["observaciones"];
        
        $evalGeografia=$geografiaHistoria->fetch(PDO::FETCH_ASSOC);
        $evaluacion[23]=$evalGeografia["primeraEval"];
        $evaluacion[24]=$evalGeografia["segundaEval"];
        $evaluacion[25]=$evalGeografia["terceraEval"];
        $evaluacion[26]=$evalGeografia["notaFinal"];
        $evaluacion[27]=$evalGeografia["observaciones"];
        
        $evalMatematicas=$matematicas->fetch(PDO::FETCH_ASSOC);
        $evaluacion[28]=$evalMatematicas["primeraEval"];
        $evaluacion[29]=$evalMatematicas["segundaEval"];
        $evaluacion[30]=$evalMatematicas["terceraEval"];
        $evaluacion[31]=$evalMatematicas["notaFinal"];
        $evaluacion[32]=$evalMatematicas["observaciones"];
        
        //Devuelvo toda la información de la evaluación.
        return $evaluacion;
    }
    
    //Guarda la nota de la asignatura, educación física.
    function guardarEduF($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones){
        $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consulta="UPDATE educacionfisica SET primeraEval=:prim, segundaEval=:seg, terceraEval=:ter,notaFinal=:notF,observaciones=:obs WHERE alumno=:idA;";
        $datos=array();
        $datos[0]=$consulta;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
       
        //Mando la consulta.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->guardarNotas($datos);
        if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
    //Guarda la nota de la asignatura, inglés.
     function guardarIngles($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones){
        $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consulta="UPDATE ingles SET primeraEval=:prim, segundaEval=:seg, terceraEval=:ter, notaFinal=:notF, observaciones=:obs WHERE alumno=:idA;";
        $datos=array();
        $datos[0]=$consulta;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
        
        //Mando la consulta.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->guardarNotas($datos);
        if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
    //Guarda las notas de la asignatura, fisica.
     function guardarFisica($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones){
    $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consulta="UPDATE fisica SET primeraEval=:prim, segundaEval=:seg, terceraEval=:ter,notaFinal=:notF,observaciones=:obs WHERE alumno=:idA;";
        $datos=array();
        $datos[0]=$consulta;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
        
        //Mando la consulta.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->guardarNotas($datos);
        if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
    //Función que guarda la asignatura, matemáticas.
     function guardarMatematicas($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones){
        $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consulta="UPDATE matematicas SET primeraEval=:prim, segundaEval=:seg, terceraEval=:ter,notaFinal=:notF,observaciones=:obs WHERE alumno=:idA;";
        $datos=array();
        $datos[0]=$consulta;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
        
        //Mando la consulta.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->guardarNotas($datos);
        if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
    //Guarda las notas de la asignatura, lengua castellana.
     function guardarLengua($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones){
        $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consulta="UPDATE lenguacastellana SET primeraEval=:prim, segundaEval=:seg, terceraEval=:ter,notaFinal=:notF,observaciones=:obs WHERE alumno=:idA;";
        $datos=array();
        $datos[0]=$consulta;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
        
        //Mando la consulta.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->guardarNotas($datos);
        if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
    //Guarda las notas de la asignatura, geografiaHistoria.
     function guardarGeografia($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones){
         
        $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consulta="UPDATE geografiahistoria SET primeraEval=:prim, segundaEval=:seg, terceraEval=:ter,notaFinal=:notF,observaciones=:obs WHERE alumno=:idA;";
        $datos=array();
        $datos[0]=$consulta;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
        
        
        //Mando la consulta.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->guardarNotas($datos);
        if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
    //Función que introduce las notas de los alumnos que han sido evaluados por primera vez.
    function insertarEvaluacion($idAlumno,$primeraE,$segundaE,$terceraE,$notaF,$observaciones,$asignatura){
        $this->primeraE=htmlentities(addslashes($primeraE));
        $this->segundaE=htmlentities(addslashes($segundaE));
        $this->terceraE=htmlentities(addslashes($terceraE));
        $this->notaFinal=htmlentities(addslashes($notaF));
        $this->idAlumno=$idAlumno;
        $this->observaciones=$observaciones;
        $consultaSQL="INSERT INTO $asignatura(primeraEval,segundaEval,terceraEval,notaFinal,observaciones,alumno,clase) VALUES(:prim,:seg,:ter,:notF,:obs,:idA,:clas)";
   
        
         $consulta="SELECT clase FROM alumnos WHERE id_alumno=".$this->idAlumno.";";
        
        $baseDatos=new BaseDatos($this->conexion);
        $consultaClase=$baseDatos->clase($consulta);
        while($fila=$consultaClase->fetch(PDO::FETCH_ASSOC)){
            $clase=$fila["clase"];
        }
        
             $datos=array();
        $datos[0]=$consultaSQL;
        $datos[1]=$this->primeraE;
        $datos[2]=$this->segundaE;
        $datos[3]=$this->terceraE;
        $datos[4]=$this->notaFinal;
        $datos[5]=$this->observaciones;
        $datos[6]=$this->idAlumno;
        $datos[7]=$clase;
        
     
      
        
        $mensaje=$baseDatos->insertar($datos);
         if($mensaje=="si"){
            return"Se han guardado los datos satisfactoriamente";
        }else{
            return"No se han podido guardar los datos";
        }
    }
    
}
?>
