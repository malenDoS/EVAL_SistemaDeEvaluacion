<?php
include_once("../Modelo/BaseDatos.php");
class RecopilarDatos{
    
    private $conexion;
    
    function __construct(){
        $this->conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    //Comprueba los datos del formulario de la entrada.
function comprobarDatosFormulario($correo,$contra){
//Guardo la información del usuario en las variables.
$correoE=htmlentities(addslashes($correo));
$contrasegna=htmlentities(addslashes($contra));


//Creo una instancia de la clase Base de datos.
$db=new BaseDatos($this->conexion);
//Ejecuto el método para comprobar los datos de entrada.
$db->loginInicial($correoE,$contrasegna);
}

//Comprueba los datos del usuario del menú.
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

//Datos para rellenar el formulario del perfil del usuario.
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
    return $usuario;
}
}
?>