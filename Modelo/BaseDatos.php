<?php

class BaseDatos{
    
    private $conexion;
    
    function __construct($conexion){
        $this->conexion=$conexion;
    }
    
    function loginInicial($correo,$password){
        //Guardo en una variable la consulta con marcadores.
        $consulta="SELECT Admin FROM registrados WHERE Email=:correo AND contrasegna=:contra";
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
            }
            
            //Establezco la sesión.
            session_start();
            
            if($tipoUsuario=="si"){
            $_SESSION["Tipo"]="Admin";
            }else{
                $_SESSION["Tipo"]="Profesor";
            }
            //Redirecciono al usuario.
            header("location:../Vista/MenuDeOpciones.php");
            
        }else{
            header("location:../Vista/Formulario de entrada.php?datos=no");
        }
    }
}


?>

