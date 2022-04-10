<?php

class BaseDatos{
    
    private $conexion;
    
    function __construct($conexion){
        $this->conexion=$conexion;
    }
    
    //Evalúa si el usuario está registrado.
    function loginInicial($correo,$password){
        //Guardo en una variable la consulta con marcadores.
        $consulta="SELECT Admin,ID FROM registrados WHERE Email=:correo AND contrasegna=:contra";
        //Preparo la consulta.
        $resultado=$this->conexion->prepare($consulta);
        //Vinculo los marcadores.
        $resultado->bindValue(":correo",$correo);
        $resultado->bindValue(":contra",$password);
        
        //Ejecuto la consulta.
        $resultado->execute();
        //Compruebo los resultados.
        if($resultado->rowCount()>0){
            //Compruebo el tipo de usuario que accede.
            $tipoUsuario;
            while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
                $tipoUsuario=$fila["Admin"];
                $idUsuario=$fila["ID"];
            }
            
            //Establezco la sesión.
            session_start();
            
            if($tipoUsuario=="si"){
            $_SESSION["Tipo"]="Admin";
            $_SESSION["id"]=$idUsuario;
            }else{
                $_SESSION["Tipo"]="Profesor";
                $_SESSION["id"]=$idUsuario;
            }
            //Redirecciono al usuario.
            header("location:../Vista/MenuDeOpciones.php?");
            
        }else{
            header("location:../Vista/Formulario de entrada.php?datos=no");
        }
    }
    
    function datosUsuario($idUsuario){
        $consulta="SELECT ID, nombre,apellido,direccion,cargo,educacionFisica,matematicas,geografiaHistoria,lengua,ingles,fisica,telefono,dni,fechaNacimiento,imagen FROM personal WHERE ID=:id";
        $resultado=$this->conexion->prepare($consulta);
        //Vinculo el marcador.
        $resultado->bindValue(":id",$idUsuario);
        $resultado->execute();
        return $resultado;
        
    }
    
    function guardarDatosProfesor($datos){
        $consulta="UPDATE `personal` SET `nombre`=:nombre, `apellido`=:apellido, `direccion`=:direccion, `cargo`=:cargo, `educacionFisica`=:eduFi, `matematicas`=:matematicas, `geografiaHistoria`=:geografiaHistoria, `lengua`=:lengua, `ingles`=:ingles, `fisica`=:fisica, `telefono`=:telefono, `dni`=:dni, `fechaNacimiento`=:fechaNacimiento   WHERE `ID`=:idU";
        $resultado=$this->conexion->prepare($consulta);
        //Guardo el resultado de los botones de tipo radio del formulario.
        $educacionFisica=0;
        $matematicas=0;
        $geografiaHistoria=0;
        $lengua=0;
        $ingles=0;
        $fisica=0;
        
        if($datos[7]=="Educacion Fisica"){
            $educacionFisica=1;
        }else if($datos[7]=="Matematicas"){
            $matematicas=1;
        }else if($datos[7]=="Ingles"){
            $ingles=1;
        }else if($datos[7]=="Fisica"){
            $fisica=1;
        }else if($datos[7]=="Geografia/Historia"){
            $geografiaHistoria=1;
        }else if($datos[7]=="Lengua Castellana"){
            $lengua=1;
        }
  
        $resultado->execute(array(":idU"=>(int)$datos[8],":nombre"=>$datos[0],":apellido"=>$datos[1],":direccion"=>$datos[5],":cargo"=>$datos[6],":eduFi"=>$educacionFisica,
            ":matematicas"=>$matematicas,":geografiaHistoria"=>$geografiaHistoria,":lengua"=>$lengua,":ingles"=>$ingles,":fisica"=>$fisica,":telefono"=>(int)$datos[4],":dni"=>$datos[3],
            ":fechaNacimiento"=>$datos[2]));
        $cuenta=$resultado->rowCount();
        if($cuenta>0){
            $mensaje="Si";
        }
        else{
           $mensaje="No";
        }
        
        if($_SESSION["Tipo"]=="Admin"){
        header("location:../Vista/PerfilPersonal.php?us=".$datos[4]."&me=".$mensaje."");
        }else{
            header("location:../Vista/PerfilPersonal.php?me=".$mensaje."");
        }
    }
    
    
    
    function numeroProfesores($consulta){
        $resultado=$this->conexion->query($consulta);
        $numeroProfes;
         while($fila=$resultado->fetch(PDO::FETCH_NUM)){
             $numeroProfes=$fila[0];
         }
        return $numeroProfes;
    }
    
    function getInfoAlumnado($consulta){
        $alumnado=$this->conexion->query($consulta);
        if($alumnado->rowCount()>0){
            return $alumnado;
            
        }else{
            return "No se han encontrado datos";
        }
    }
    
    function asignatura(){
        $asignatura;
        $info=$this->conexion->query($consulta);
        //Averiguo, que asginatura imparte el profesor.
        while($fila=$info->fetch(PDO::FETCH_ASSOC)){
            if($fila["educacionFisica"]==1){
                $asignatura="educacion Fisica";
            }else if($fila["matematicas"]==1){
                $asignatura="matematicas";
            }else if($fila["geografiaHistoria"]==1){
                $asignatura="geografia historia";
            }else if($fila["fisica"]==1){
                $asignatura="fisica";
            }else if($fila["lengua"]==1){
                $asignatura="lengua";
            }else if($fila["ingles"]==1){
                $asignatura="ingles";
            }
        }
        //Devuelvo la asignatura que imparte el profesor.
        return $asignatura;
        
    }
    
    
    //funciones referentes a la evaluación de notas de cada alumno.
    function credencialesAlumno($consulta){
        $alumno=$this->conexion->query($consulta);
        return $alumno;
    }
    
    function nEducacionFisica($consulta){
        $notaEduFisica=$this->conexion->query($consulta);
        return $notaEduFisica;
    }
    
    function nFisica($consulta){
        $notaFisica=$this->conexion->query($consulta);
        return $notaFisica;
    }
    function nIngles($consulta){
        $notaIngles=$this->conexion->query($consulta);
        return $notaIngles;
    }
    function nLenguacastellana($consulta){
        $notaLengua=$this->conexion->query($consulta);
        return $notaLengua;
    }
    function nGeografiaH($consulta){
        $notaGeografia=$this->conexion->query($consulta);
        return $notaGeografia;
    }
    function nMatematicas($consulta){
        $notaMatematicas=$this->conexion->query($consulta);
        return $notaMatematicas;
    }
}


?>

