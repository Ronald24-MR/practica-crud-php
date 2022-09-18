<?php
include("menu.php");

include("conectar.php");

$sql=$conexion->prepare("SELECT * FROM libros");
$sql->execute();
$listar=$sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listar as $lista){ ?>

<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="../../img/<?php echo $lista['imagen']; ?>" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $lista['nombre']; ?></h4>
            <a href="" class="btn btn-primary">ver mas</a>
        </div>
    </div>
</div>
<?php } ?>