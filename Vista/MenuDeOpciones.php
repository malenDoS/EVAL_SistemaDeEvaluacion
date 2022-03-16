<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../librerías/bootstrap.min.css">
        <title>Menú de opciones</title>
    </head>
    <body>
        
        <?php
        //Verifico si la sesión está iniciada.
        session_start();
        if(isset($_SESSION["Tipo"])){
            echo($_SESSION["Tipo"]);
        }else{
            header("location:Formulario de entrada.html");
        }
        ?>
        
         <script type="text/javascript" src="../librerías/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../librerías/bootstrap.min.js"></script>
    </body>
</html>

