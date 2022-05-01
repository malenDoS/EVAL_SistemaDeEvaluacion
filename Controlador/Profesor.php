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
        //Establezco la conexión PDO.
        $this->conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    
    //Busco los datos del profesor según el id especificado.
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

//Guardo los datos del profesor.
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

//Esta función da como resultado el número de profesores.
function paginacionProfesores(){
    $baseDatos=new BaseDatos($this->conexion);
    $consulta="SELECT COUNT(*) FROM personal;";
    $numeroP=$baseDatos->numeroProfesores($consulta);
    return $numeroP;
}

//La función informa del nombre, apellido, id y cargo de los profesores.
function todosLosProfesores(){
    $consulta="SELECT nombre,apellido,ID,cargo FROM personal";
    $baseDatos=new BaseDatos($this->conexion);
    $datos=$baseDatos->infoProfesores($consulta);
    return $datos;
}

//Función para borrar al profesor de la tabla de personal y registrados.
function borrarProfe($idProfesor){
    $consulta="DELETE FROM personal WHERE ID=$idProfesor";
    $consulta2="DELETE FROM registrados WHERE ID=$idProfesor";
    $datosBorrar=array();
    $datosBorrar[0]=$consulta;
    $datosBorrar[1]=$consulta2;
    $baseDatos=new BaseDatos($this->conexion);
    $profesorBorrado=$baseDatos->deleteProfesor($datosBorrar);
    
    return $profesorBorrado;
}

//Función para guardar la información de un profesor en la tabla de registrados.
function registrarProfesor($email,$contrasegna,$tipoUsuario){
    $emailProfesor=htmlentities(addslashes($email));
    $contrasegnaPro=htmlentities(addslashes($contrasegna));
    $tipoU=$tipoUsuario;
    $consulta="INSERT INTO registrados(Email,contrasegna,Admin) VALUES(:em,:con,:tip)";
    //Guardo la información en un array.
    $datos=array();
    $datos[0]=$emailProfesor;
    $datos[1]=$contrasegnaPro;
    $datos[2]=$tipoU;
    $datos[3]=$consulta;
    $baseDatos=new BaseDatos($this->conexion);
    $registrado=$baseDatos->registro($datos);
    return $registrado;
}

//Función que guarda los datos del formulario de nuevo profesor en la tabla personal.
function registrarPersonal($nombre,$apellido,$direccion,$cargo,$asignatura,$telefono,$dni,$fechaNacimiento,$nombrei,$tamagnoi,$tipoArchivoI,$carpetaTemporal){
    //Compruebo la imagen que ha enviado el usuario.
    
        $carpetaDestino=$_SERVER["DOCUMENT_ROOT"]."/EVAL_sistema_de_evaluación/Vista/imagenes/fotosPerfil/";
        move_uploaded_file($carpetaTemporal,$carpetaDestino.$nombrei);
        $consultaSQL="INSERT INTO personal(nombre,apellido,direccion,cargo,educacionFisica,matematicas,geografiaHistoria,lengua,ingles,fisica,telefono,dni,fechaNacimiento,imagen) VALUES(:nom,:ape,:dir,:car,:eduF,:mat,:geo,:len,:ing,:fis,:tel,:dni,:fecN,:ima);";
        $baseDatos=new BaseDatos($this->conexion);
        
        $this->nombre=htmlentities(addslashes($nombre));
        $this->apellido=htmlentities(addslashes($apellido));
        $this->direccion=htmlentities(addslashes($direccion));
        $this->cargo=htmlentities(addslashes($cargo));
        $this->asignatura=$asignatura;
        $this->telefono=$telefono;
        $this->dni=htmlentities(addslashes($dni));
        $this->fechaNacimiento=htmlentities(addslashes($fechaNacimiento));
        //Guardo los datos para realizar el registro.
        $datos=array();
        $datos[0]=$this->nombre;
        $datos[1]=$this->apellido;
        $datos[2]=$this->direccion;
        $datos[3]=$this->cargo;
        $datos[4]=$this->asignatura;
        $datos[5]=$this->telefono;
        $datos[6]=$this->dni;
        $datos[7]=$this->fechaNacimiento;
        $datos[8]=$nombrei;
        $datos[9]=$consultaSQL;
        
        $registroPersonal=$baseDatos->regPersonal($datos);
        return $registroPersonal;
    }
       
    //Función que da como resultado los id de los profesores en la tabla personal.
    function idsProfesor(){
        $consultaSQL="SELECT ID FROM personal";
        $baseDatos=new BaseDatos($this->conexion);
        $resultado=$baseDatos->getIds($consultaSQL);
        return $resultado;
    }
    
}

?>
