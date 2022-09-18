<?php
// session_start();
// if(!isset($_SESSION['usuario'])){
//     header("Location:index.php");
// }else{
//     if($_SESSION['usuario']=="ok"){
//         $nombreUsuario=$_SESSION["nombreUsuario"];
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="inicio.php">inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="web.php">web</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crudejemplo.php">crud</a>
                </li>
        </div>
    </nav>
</body>
</html>