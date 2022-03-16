<?php
include_once("../Modelo/BaseDatos.php");
//Guardo la información del usuario en las variables.
$correoE=htmlentities(addslashes($_POST["correo"]));
$contrasegna=htmlentities(addslashes($_POST["contrasegna"]));

//Creo una conexión con la base de datos.
$conexion=new PDO("mysql:host=localhost; dbname=eval","root","nloeig31416");
$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Creo una instancia de la clase Base de datos.
$db=new BaseDatos($conexion);
//Ejecuto el método para comprobar los datos de entrada.
$db->loginInicial($correoE,$contrasegna);
?>