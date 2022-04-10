<?php
    include("../Modelo/BaseDatos.php");
class Asignatura{
    
    private $idAlumno;
    private $primeraE;
    private $segundaE;
    private $terceraE;
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
    
    function asignaturaProfesor($idU){
        $consulta="Select educacionFisica,matematicas,geografiaHistoria,lengua,ingles,fisica FROM personal WHERE ID=".$idU."";
        $baseDatos=new BaseDatos($this->conexion);
        //Realizo la consulta de la sentencia sql.
        $asignatura=$baseDatos->asignatura();
        return$asignatura;
    }
    
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
}
?>
