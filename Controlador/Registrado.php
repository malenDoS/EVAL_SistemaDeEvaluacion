<?php
include_once("../Modelo/BaseDatos.php");
class Registrado{
    
    private $email;
    private $contrasegna;
    private $conexion;
    
    function __construct(){
        //Establezco la conexión PDO.
        $this->conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

//Función para comprobar si el usuario está registrado.
function comprobarRegistro($emailU,$contrasegnaU){
    $this->email=$emailU;
    $this->contrasegna=$contrasegnaU;
 //Creo una instancia de la clase Base de datos.
$db=new BaseDatos($this->conexion);
//Ejecuto el método para comprobar los datos de entrada.
$db->loginInicial($this->email,$this->contrasegna);
}

//Función para buscar los datos del usuario según su id.
function usuarioMenu($id){
    //Creo una instancia de la clase Base de datos.
    $db=new BaseDatos($this->conexion);
    $dUsuario=$db->datosUsuario($id);
    //Creo un array para enviar los datos del usuario.
    $datos= array();
    
    $fila=$dUsuario->fetch(PDO::FETCH_ASSOC);
    $datos[0]=$fila["nombre"];
    $datos[1]=$fila["apellido"];
    $datos[2]=$fila["cargo"];
    return $datos;
    
}
}
?>
