<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:index.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="../lib/bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="../lib/bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>

<body>
    <div class="container">
        <?php require("menu.php"); ?>
        <h1>Usuario Nuevo</h1>

        <form action="usuarios_nueva_guardar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" onkeyup="comprobar_usuario(this.value)" required>
                <span id="mensaje"></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="GUARDAR">
            </div>


        </form>

        <div id="librerias">
            <script>
                

                function comprobar_usuario(str) {

                    if (str.length == 0) {
                        document.getElementById("mensaje").innerHTML = "";

                        return;
                    } else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {

                                if(this.responseText==1)
                                {
                                    document.getElementById("enviar").disabled = true;
                                    document.getElementById("mensaje").innerHTML = "<p style='color:red'>Usuario No Disponible</p>";
                                }
                                else
                                {
                                    document.getElementById("enviar").disabled = false;
                                document.getElementById("mensaje").innerHTML = "";
                                }
                            }
                        };



                        xmlhttp.open("GET", "ajax_comprobar_usuario.php?usuario=" + str, true);
                        xmlhttp.send();
                    }
                }
            </script>

        </div>

    </div>
</body>

</html>