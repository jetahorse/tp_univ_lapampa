<?php
    session_start();
        extract($_REQUEST);
    if (!isset($_SESSION['usuario_logueado']))
        header("location:index.php");

    $id_usuario_aborrar=$_REQUEST['id_usuario'];
    //print("$id_usuario_aborrar");
    require("conexion.php");
    $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
        or die("No se puede conectar con el servidor");
    mysqli_select_db($conexion, $base_db)
        or die("No se puede seleccionar la base de datos");
    $inst_sql="delete from usuarios 
                where id_usuario='$id_usuario_aborrar'";
    //print("$inst_sql");
    $consulta=mysqli_query($conexion, $inst_sql);
    $_SESSION['actualizo']='SI';
    header("location:usuarios.php");
    mysqli_close($conexion);
 ?>