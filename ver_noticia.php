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
        extract($_REQUEST);
        require("admin/conexion.php");
        $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
            or die("No se puede conectar con el servidor");
        mysqli_select_db($conexion, $base_db)
            or die("No se puede seleccionar la base de datos");
        $instruccion = "select * from noticias  where id_noticia=".$id_noticia;

        $consulta = mysqli_query($conexion, $instruccion) or die("no puedo consultar");

        $nfilas = mysqli_num_rows($consulta);
        
    
        for ($i = 0; $i < $nfilas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            print('
            <div class="col-12">
                <div class="card">
                <img src="imagenes_subidas/'.$resultado['imagen'].'" class="card-img-top" alt="'.$resultado['titulo'].'">
                    <div class="card-body">
                            <h5 class="card-title">'.$resultado['titulo'].'</h5>
                        <p class="card-text">'.substr($resultado['copete'],0,40).'</p>
                        <a href="javascript:history.back()" class="btn btn-primary">Go somewhere</a>
                    </div>
                 </div>
            </div>');
        }
      
        mysqli_close($conexion);
        ?>
        </div>

</body>

</html>