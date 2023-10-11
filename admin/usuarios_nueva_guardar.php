<?php
    session_start();
        extract($_REQUEST);
    if (!isset($_SESSION['usuario_logueado']))
        header("location:index.php");

    require("conexion.php");
    $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
        or die("No se puede conectar con el servidor");
    mysqli_select_db($conexion, $base_db)
        or die("No se puede seleccionar la base de datos");
    $fecha=date("Y-m-d");
    $id_usuario=$_SESSION['id_usuario'];
    //metodo 1
    $usuario=mysqli_real_escape_string($conexion,$usuario);
    $password=mysqli_real_escape_string($conexion,$password);
    $nombre=mysqli_real_escape_string($conexion,$nombre);
    $apellido=mysqli_real_escape_string($conexion,$apellido);
   

    //encriptar password

    $salt = substr ($usuario, 0, 2);
    print($salt);
    /* crypt es una funci�n que encripta un string dado ($usuario) a partir de un substring
    ($salt) que lo toma como semilla de encriptaci�n en este caso son dos caracteres*/
    $clave_crypt = crypt ($password, $salt);
    $instruccion="insert into usuarios (nombre,apellido,usuario,password,tipo_usuario) values ('$nombre','$apellido','$usuario','$clave_crypt','')";
    print($instruccion);
    $consulta=mysqli_query($conexion,$instruccion) 
            or die("no pudo insertar");
    
    
    //metodo 2
    /*$stmt=mysqli_prepare($conexion,"insert into noticias (titulo,copete,cuerpo,imagen,categoria,id_usuario,fecha) values (?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,'sssssds', $titulo,$copete,$cuerpo,$imagen,$categoria,$id_usuario,$fecha);
   mysqli_stmt_execute($stmt);*/
    mysqli_close($conexion);
   header("location:usuarios.php?mensaje=Guardo");
?>  