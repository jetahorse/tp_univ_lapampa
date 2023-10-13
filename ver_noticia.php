<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="lib/bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="lib/bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <?php // require("menu.php"); 
        ?>
        <h1>Noticias</h1>

        <h1>Mi diario</h1>
        <div class="row">
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        

        extract($_REQUEST);
        require("admin/conexion.php");
        $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
            or die("No se puede conectar con el servidor");
        mysqli_select_db($conexion, $base_db)
            or die("No se puede seleccionar la base de datos");
        $instruccion = "select * from noticias join usuarios on noticias.id_usuario=usuarios.id_usuario  where id_noticia=".$id_noticia;

        $consulta = mysqli_query($conexion, $instruccion) or die("no puedo consultar");
        if ($consulta){
            $resultado=mysqli_fetch_array($consulta);
            print(' <div id="titulo">
                        <h1>'.$resultado['titulo'].'</h1>
                    </div>
                    <br>
                    <br>

                    <div id="imagen">
                        <img src="imagenes_subidas/'.$resultado['imagen'].'" width="100%" height="100%">
                    </div>

                    <div id="autor">
                        <h3>Autor: '.$resultado['nombre']." ".$resultado['apellido'].'</h3>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div id="contenido">
                    <p>'.$resultado['cuerpo'].'</p>
                    </div>
                ');        
        /*<div class="col-12">
                <div class="card">
                <img src="imagenes_subidas/'.$resultado['imagen'].'" class="card-img-top" alt="'.$resultado['titulo'].'">
                    <div class="card-body">
                            <h5 class="card-title">'.$resultado['titulo'].'</h5>
                        <p class="card-text">'.substr($resultado['copete'],0,40).'</p>
                        <a href="javascript:history.back()" class="btn btn-primary">Go somewhere</a>
                    </div>
                 </div>
            </div>
            */
        }
        mysqli_close($conexion);
        ?>
        </div>

</body>

</html>