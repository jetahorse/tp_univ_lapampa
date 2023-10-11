<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
        extract($_REQUEST);
    if (!isset($_SESSION['usuario_logueado']))
        header("location:index.php");
    require("conexion.php");
    $conexion = mysqli_connect($server_db, $usuario_db, $password_db)
            or die("No se puede conectar con el servidor");
    mysqli_select_db($conexion, $base_db)
            or die("No se puede seleccionar la base de datos");
    
    /*$sqlInstruccion = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $sqlInstruccion);
    mysqli_stmt_bind_param($stmt, "s", $id_usuario);
    $ejecucion=mysqli_stmt_execute($stmt);
    if ($ejecucion)
        {

    
        $resultado=mysqli_stmt_get_result($stmt);
        $fila = mysqli_fetch_array($resultado);
        $usuario=$fila['usuario'];
        $password=$fila['password'];
        $nombre=$fila['nombre'];
        $apellido=$fila['apellido'];
    }
    else{
        print("la consulta dió error");
    }*/
    $sqlInstruccion = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sqlInstruccion);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_usuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($resultado) {
            $fila = mysqli_fetch_array($resultado);

            if ($fila) {
                // Los datos del usuario se han recuperado con éxito
                $usuario = $fila['usuario'];
                $password = $fila['password'];
                $nombre = $fila['nombre'];
                $apellido = $fila['apellido'];
        }
        else {
                // No se encontró un usuario con el ID especificado
                echo "No se encontró el usuario.";
        }
        } 
        else {
            // Error en la obtención del resultado
            echo "Error al obtener el resultado de la consulta.";
        }
    } 
    else {
        // Error en la preparación de la consulta
        echo "Error al preparar la consulta.";
    }


require("menu.php");


print('
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../lib/bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
            <script src="../lib/bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>
            <title>Editar Usuario</title>

        </head>
        <body>
            <div class="container-fluid">
                <h1>Editar Usuario</h1>
                <form action="editar_usuario_guardar.php?id_usuario='.$id_usuario.'" method="post">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="'.$usuario.'" placeholder="Usuario" required>
                        <label for="usuario" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="'.$password.'" required disabled>
                        <input type="checkbox" id="password_modificar" name="password_modificar" value="1"">
                        <label for="password_modificar">Modificar Password</label>
                        <script>
                            // Obtén el checkbox y el campo de contraseña por su ID
                            var checkbox = document.getElementById("password_modificar"); // Debes usar comillas
                            var contrasena = document.getElementById("password"); // Debes usar comillas
                        
                            // Agrega un event listener al checkbox para habilitar/deshabilitar el campo de contraseña
                            checkbox.addEventListener("click", function() {
                                contrasena.disabled = checkbox.checked;
                            });
                        </script>
                        <br>
                        <label for="usuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="'.$nombre.'" placeholder="Nombre" required>
                        <label for="usuario" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="'.$apellido.'" placeholder="Apellido" required>
                        <input type="submit" class="form-control btn btn-primary" value="guardar" name="guardar">
                    </div>
                </form>
            </div>
    
        </body>
    </html>
    ');
?>