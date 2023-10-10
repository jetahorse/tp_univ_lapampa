<?php
    session_start();
    extract($_REQUEST);
    if (!isset($_SESSION['usuario_logueado']))
        header("location:index.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../lib/bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="../lib/bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>

    <title>Usuarios Registrados</title>
</head>
<body>
   <div class=container-fluid>
        <?php require("menu.php");
            require("conexion.php");
            $conexion_actual=mysqli_connect($server_db,$usuario_db,$password_db,$base_db) 
            or die ("Error en la conexion a la base de datos");
            
            $consulta_usuarios="select * from usuarios";
            $resultado_consulta=mysqli_query($conexion_actual,$consulta_usuarios);
            $nro_filas=mysqli_num_rows($resultado_consulta);
            print('<a class="btn btn-success" href="usuarios_nueva.php">Nuevo Usuario</a>');
    
            $texto_mostrar='
                <table class="table">
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Nombre de Usuario</th>
                  <th>Acción</th>
                </tr>';
                
            for ($i=0; $i<$nro_filas; $i++)
            {
                
                print("<h1> Listado de Usuarios </h1>");
                $arr_usuarios=mysqli_fetch_array($resultado_consulta);
            
                $texto_mostrar.=
                '<tr>
                  <td>'.$arr_usuarios['nombre'].'</td>
                  <td>'.$arr_usuarios['apellido'].'</td>
                  <td>'.$arr_usuarios['usuario'].'</td>
                  <td><a class="btn btn-primary" href="editar_usuario.php?id_usuario='.
                  $arr_usuarios['id_usuario'].'">Editar</a> <a class="btn btn-danger" href="borrar_usuario.php?id_usuario='.
                  $arr_usuarios['id_usuario'].'">Borrar</a></td>
                </tr>';
            }
            //fin del for
            $texto_mostrar.='</table>';
            print($texto_mostrar);
        ?>


    </div>
</body>
</html>