<?php
include("../Modelo/BaseDatos.php");
    
class Profesor{
    private $id;
    private $dni;
    private $nombre;
    private $apellido;
    private $telefono;
    private $fechaNacimiento;
    private $asignatura;
    private $cargo;
    private $direccion;
     private $conexion;
     
    function __construct(){
        $this->conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    
    function getPerfilUsuario($idU){
    $baseDatos=new BaseDatos($this->conexion);
    $datos=$baseDatos->datosUsuario($idU);
    
    //Guardo los datos.
    $usuario=array();
    
    $fila=$datos->fetch(PDO::FETCH_ASSOC);
    $usuario[0]=$fila["nombre"];
    $usuario[1]=$fila["apellido"];
    $usuario[2]=$fila["fechaNacimiento"];
    $usuario[3]=$fila["dni"];
    $usuario[4]=$fila["telefono"];
    $usuario[5]=$fila["direccion"];
    $usuario[6]=$fila["cargo"];
    $usuario[7]=$fila["educacionFisica"];
    $usuario[8]=$fila["matematicas"];
    $usuario[9]=$fila["geografiaHistoria"];
    $usuario[10]=$fila["lengua"];
    $usuario[11]=$fila["ingles"];
    $usuario[12]=$fila["fisica"];
    $usuario[13]=$fila["imagen"];
    $usuario[14]=$fila["ID"];
    return $usuario;
}

function guardarDatosU($nombre,$apellido,$fechaNacimiento,$dni,$telefono,$direccion,$cargo,$asignatura,$id){
    $this->nombre=htmlentities(addslashes($nombre));
    $this->apellido=$apellido;
    $this->fechaNacimiento=htmlentities(addslashes($fechaNacimiento));
    $this->dni=htmlentities(addslashes($dni));
    $this->telefono=htmlentities(addslashes($telefono));
    $this->direccion=htmlentities(addslashes($direccion));
    $this->cargo=htmlentities(addslashes($cargo));
    $this->asignatura=$asignatura;
    $this->id=$id;
    
    $datosProfesor=array();
    $datosProfesor[0]=$this->nombre;
    $datosProfesor[1]=$this->apellido;
    $datosProfesor[2]=$this->fechaNacimiento;
    $datosProfesor[3]=$this->dni;
    $datosProfesor[4]=$this->telefono;
    $datosProfesor[5]=$this->direccion;
    $datosProfesor[6]=$this->cargo;
    $datosProfesor[7]=$this->asignatura;
    $datosProfesor[8]=$this->id;
    
    $basedatos=new BaseDatos($this->conexion);
    $basedatos->guardarDatosProfesor($datosProfesor);
}

function paginacionProfesores(){
    $baseDatos=new BaseDatos($this->conexion);
    $consulta="SELECT COUNT(*) FROM personal;";
    $numeroP=$baseDatos->numeroProfesores($consulta);
    return $numeroP;
}

}
?>
