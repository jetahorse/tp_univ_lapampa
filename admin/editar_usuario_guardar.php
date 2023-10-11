<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    extract($_REQUEST);
    print($id_usuario);
    if (!isset($_SESSION['usuario_logueado']))
        header("location:index.php");

    require("conexion.php");
    require('home.php');
    $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
        or die("No se puede conectar con el servidor");
    mysqli_select_db($conexion, $base_db)
        or die("No se puede seleccionar la base de datos");
        
        
    $salt = substr ($usuario, 0, 2);
    $clave_crypt = crypt ($password, $salt);
    
    $sql_instruccion="UPDATE usuarios SET nombre='$nombre', apellido='$apellido', usuario='$usuario', password='$clave_crypt', tipo_usuario='' WHERE id_usuario='$id_usuario'";
    $sql_resultado=mysqli_query($conexion, $sql_instruccion);
    if ($sql_resultado){
        echo "Se ha modificado el usuario";
    }
    else{
        echo "No se ha modificado el usuario";
    }
    mysqli_close($conexion);
?>