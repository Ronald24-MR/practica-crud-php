<?php
session_start();
if(($_POST['usuario']=="develoteca") && ($_POST['clave']=="sistema")){
    $_SESSION['usuario']="ok";
    $_SESSION['nombreUsuario']="develoteca";
    header("Location:crudejemplo.php");
}else{
    echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
        <form action="" method="POST">
            <label for="usuario" class="form-label">usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario">
            <label for="">contraseña</label>
            <input type="password" name="password" id="password" class="form-control">
            <input type="submit" value="Entrar" name="enviar" class="btn btn-primary">
        </form>
</body>
</html>