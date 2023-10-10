
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
extract($_REQUEST);
//var_dump($_REQUEST);
require("conexion.php");
$conexion = mysqli_connect($server_db, $usuario_db,$password_db)
    or die ("No se puede conectar con el servidor");


mysqli_select_db($conexion,$base_db)
  or die ("No se puede seleccionar la base de datos");




  $salt = substr ($usuario, 0, 2);

/* crypt es una funci�n que encripta un string dado ($usuario) a partir de un substring
($salt) que lo toma como semilla de encriptaci�n en este caso son dos caracteres*/
$usuario=mysqli_real_escape_string($conexion,$usuario);
$clave_crypt = crypt ($password, $salt);

$instruccion = "select * from usuarios where usuario = '$usuario'" .
" and password = '$clave_crypt'";
$consulta = mysqli_query ($conexion,$instruccion)
or die ("Fallo en la consulta");
$nfilas = mysqli_num_rows ($consulta);

if($nfilas>0)
{
    $resultado=mysqli_fetch_array($consulta);
    $_SESSION['nombre']=$resultado['nombre'];
    $_SESSION['apellido']=$resultado['apellido'];
    $_SESSION['id_usuario']=$resultado['id_usuario'];
    $_SESSION['usuario_logueado']="SI";
    header("location:home.php");

}
else
{
    $_SESSION['mensaje']="Usuario y contraseña incorrecto";
    header("location:index.php");
}

?>

