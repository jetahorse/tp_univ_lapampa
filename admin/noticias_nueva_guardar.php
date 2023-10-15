<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
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
    $titulo=mysqli_real_escape_string($conexion,$titulo);
    $copete=mysqli_real_escape_string($conexion,$copete);
    $cuerpo=mysqli_real_escape_string($conexion,$cuerpo);
    //subir imagen
    $copiarArchivo=false;
    if(is_uploaded_file($_FILES['imagen']['tmp_name']))
    {
        //$nombreDirectorio="/Applications/Xampp/xamppfiles/htdocs/CLASE4/imagenes_subidas/";
        $nombreDirectorio="imagenes_subidas/";
        $idUnico=time();
        $nombrefichero=$idUnico. "-" .$_FILES['imagen']['name'];
        $copiarArchivo=true;
    }
        else 
         $nombrefichero="";
   
    if($copiarArchivo){

       if(move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio.$nombrefichero)){
        echo "<p>Archivo guardado con éxito</p>";
        $archivoGuardado=true;
       }
       else
        {
            echo "<p>No se pudo guardar el archivo<p>";
            $archivoGuardado=false;
        }
    }
    if ($archivoGuardado){
        $instruccion="insert into noticias (titulo,copete,cuerpo,imagen,categoria,id_usuario,fecha,autor) values ('$titulo','$copete','$cuerpo','$nombrefichero','$categoria','$id_usuario','$fecha','". $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ."')";
        $consulta=mysqli_query($conexion,$instruccion) 
            or die("no pudo insertar");
        mysqli_close($conexion);
        header("location:noticias.php?mensaje=Guardo");
    }
    else header("location:noticias.php?mensaje=No Guardo");


?>        