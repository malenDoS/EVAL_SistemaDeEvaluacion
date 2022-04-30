<?php

class Alumnos{
    
    private $conexion;
    private $nombre;
    private $apellido;
    private $clase;
    private $direccion;
    private $id;
    private $contactoPadre;
    private $tutor;
            
    function __construct(){
        $this->conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    
    
     function getAlumno(){
        $consulta="SELECT nombre,apellido,id_alumno FROM alumnos";
        //Creo una instancia de la clase base de datos.
        $baseDatos=new BaseDatos($this->conexion);
        //Realizo la consuta enviando la sentencia sql.
        $alumnado=$baseDatos->getInfoAlumnado($consulta);
        return $alumnado;
    }
    
    function getFormulario($idA){
        $consulta="SELECT * FROM alumnos WHERE id_alumno=".$idA;
        //Creo una instancia de la clase base de datos.
        $baseDatos=new BaseDatos($this->conexion);
        $formulario=$baseDatos->getInfoAlumnado($consulta);
        $datosFormulario=array();
        $fila=$formulario->fetch(PDO::FETCH_ASSOC);
        $datosFormulario[0]=$fila["nombre"];
        $datosFormulario[1]=$fila["apellido"];
        $datosFormulario[2]=$fila["clase"];
        $datosFormulario[3]=$fila["contactoPadre"];
        $datosFormulario[4]=$fila["direccion"];
        $datosFormulario[5]=$fila["id_alumno"];
        return $datosFormulario;
    }
    
    function tutor(){
       
    $consulta="SELECT nombre,apellido FROM personal";
    $baseDatos=new BaseDatos($this->conexion);
    $datos=$baseDatos->infoProfesores($consulta);
    return $datos;

    }
    
    function getClases(){
        $consulta="SELECT DISTINCT clase FROM alumnos";
        $baseDatos=new BaseDatos($this->conexion);
        $clases=$baseDatos->getInfoAlumnado($consulta);
        $datosClase=array();
        $contador=0;
        while($fila=$clases->fetch(PDO::FETCH_ASSOC)){
            $datosClase[$contador]=$fila["clase"];
            $contador++;
        }
        return $datosClase;
    }
    
    function guardarModificaciones($nombre,$apellido,$clase,$contactoPadre,$direccion,$tutor,$idA){
        $this->nombre=htmlentities(addslashes($nombre));
        $this->apellido=htmlentities(addslashes($apellido));
        $this->clase=$clase;
        $this->contactoPadre=htmlentities(addslashes($contactoPadre));
        $this->direccion=htmlentities(addslashes($direccion));
        $this->tutor=$tutor;
        $this->id=$idA;
        $consulta="UPDATE alumnos SET nombre=:nom, apellido=:ape, clase=:cla,contactoPadre=:conP,direccion=:dir, tutor=:tut WHERE id_alumno=".$this->id.";";
        $datosFormulario=array();
        $datosFormulario[0]=$consulta;
        $datosFormulario[1]=$this->nombre;
        $datosFormulario[2]=$this->apellido;
        $datosFormulario[3]=$this->clase;
        $datosFormulario[4]=$this->contactoPadre;
        $datosFormulario[5]=$this->direccion;
        $datosFormulario[6]=$this->tutor;
   
        
        //Realizo el update.
        $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->modificarAlumno($datosFormulario);
        return $mensaje;
    }
    
    
    function borrarAlumno($idB){
        $this->id=$idB;
         $baseDatos=new BaseDatos($this->conexion);
        $mensaje=$baseDatos->eliminarAl($this->id);
        return $mensaje;
    }
    
    function anadirAlumno($nombre,$apellido,$clase,$contacto,$direccion,$tutor){
        $this->nombre=htmlentities(addslashes($nombre));
        $this->apellido=htmlentities(addslashes($apellido));
        $this->clase=$clase;
        $this->contactoPadre=htmlentities(addslashes($contacto));
        $this->direccion=htmlentities(addslashes($direccion));
        $this->tutor=$tutor;
        
        $consultaSQL="INSERT INTO alumnos(nombre,apellido,clase,contactoPadre,direccion,tutor) VALUES(:nom,:ape,:clas,:conP,:dir,:tut);";
        $consultaEduFi="INSERT INTO educacionfisica(alumno,clase,primeraEval,segundaEval,terceraEval,notaFinal,observaciones) VALUES(:id,:clas,0,0,0,0,'');";
        $consultaFi="INSERT INTO fisica(alumno,clase,primeraEval,segundaEval,terceraEval,notaFinal,observaciones) VALUES(:id,:clas,0,0,0,0,'');";
        $consultaIn="INSERT INTO lenguacastellana(alumno,clase,primeraEval,segundaEval,terceraEval,notaFinal,observaciones) VALUES(:id,:clas,0,0,0,0,'');";
        $consultaLen="INSERT INTO geografiahistoria(alumno,clase,primeraEval,segundaEval,terceraEval,notaFinal,observaciones) VALUES(:id,:clas,0,0,0,0,'');";
        $consultaGeo="INSERT INTO ingles(alumno,clase,primeraEval,segundaEval,terceraEval,notaFinal,observaciones) VALUES(:id,:clas,0,0,0,0,'');";
        $consultaMa="INSERT INTO matematicas(alumno,clase,primeraEval,segundaEval,terceraEval,notaFinal,observaciones) VALUES(:id,:clas,0,0,0,0,'');";
        
        
        $datosAlumno=array();
        $datosAlumno[0]=$this->nombre;
        $datosAlumno[1]=$this->apellido;
        $datosAlumno[2]=$this->clase;
        $datosAlumno[3]=$this->contactoPadre;
        $datosAlumno[4]=$this->direccion;
        $datosAlumno[5]=$this->tutor;
        $datosAlumno[6]=$consultaSQL;
        
        //Inserto en la tabla alumnos.
         $baseDatos=new BaseDatos($this->conexion);
         $mensaje1=$baseDatos->nuevoAlumno($datosAlumno);
         
         if($mensaje1=="si"){
         //Consulta el id del nuevo alumno.
         $consultaId="SELECT id_alumno FROM alumnos WHERE apellido='".$datosAlumno[1]."'";
         $nuevoId=$baseDatos->idAlumno($consultaId);
         if($nuevoId=="no"){
             return "no";
         }else{
         $columna=$nuevoId->fetch(PDO::FETCH_ASSOC);
         $idAlumno=$columna["id_alumno"];
         $consultasAsignatura=array();
         $consultasAsignatura[0]=$consultaEduFi;
         $consultasAsignatura[1]=$consultaFi;
         $consultasAsignatura[2]=$consultaIn;
         $consultasAsignatura[3]=$consultaLen;
         $consultasAsignatura[4]=$consultaGeo;
         $consultasAsignatura[5]=$consultaMa;
         $consultasAsignatura[6]=$idAlumno;
         $consultasAsignatura[7]=$this->clase;
         
         //Inserto en las tablas de las asignaturas al nuevo alumno.
         $mensaje2=$baseDatos->insertarAlumno($consultasAsignatura);
         if($mensaje2=="si"){
             return "si";
         }else{
             return "no";
         }
         
         }
         
        
        
         }else
             return"no";
    }
}

?>
