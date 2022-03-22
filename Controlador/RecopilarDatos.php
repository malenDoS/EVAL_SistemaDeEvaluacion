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
    $dUsuario=$db->datosMenu($id);
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