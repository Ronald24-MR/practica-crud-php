<?php
include("menu.php");

$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


include("conectar.php");



switch($accion){

    case "agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen) VALUES (:nombre, :imagen);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);

        $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:crudejemplo.php");
        break;

    case "modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtId);
        $sentenciaSQL->execute();

        if($txtImagen != ""){

            $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            
            
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtId);
            $sentenciaSQL->execute();
            $Libros=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
            if(isset($Libros["imagen"]) &&($Libros["imagen"]!="imagen.jpg") ){
                if(file_exists("../../img/".$Libros["imagen"])){
                    unlink("../../img/".$Libros["imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtId);
            $sentenciaSQL->execute();
        }
        header("Location:crudejemplo.php");
        
        break;

    case "cancelar":
        header("Location:crudejemplo.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtId);
        $sentenciaSQL->execute();
        $Libros=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$Libros['nombre'];
        $txtImagen=$Libros['imagen'];
        // echo "Presionado boton seleccionar";
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtId);
        $sentenciaSQL->execute();
        $Libros=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        if(isset($Libros["imagen"]) &&($Libros["imagen"]!="imagen.jpg") ){
            if(file_exists("../../img/".$Libros["imagen"])){
                unlink("../../img/".$Libros["imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtId);
        $sentenciaSQL->execute();
        header("Location:crudejemplo.php");
        
        break;

}

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>
   
    
<div class="xd">
    <div class="col-md-5">
    
    <div class="card">
        <div class="card-header">
            datos
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="txtId">ID</label>
                <input required readonly type="text" class="form-control" name="txtId" id="txtId" placeholder="ID" value="<?php echo $txtId; ?>">
            </div>
        
            <div class="form-group">
                <label for="txtNombre">NOMBRE</label>
                <input required type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="NOMBRE" value="<?php echo $txtNombre; ?>">
            </div>
        
            <div class="form-group">
                <label for="txtImagen">IMAGEN</label>
                <br>
                <?php  if($txtImagen!="") {?>

                    <img src="../../img/<?php echo $txtImagen; ?>" alt="" style="border-radius: 50%;" width="70" height="70">

                <?php } ?>

                <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="IMAGEN">
            </div>
        
     
        
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" class="btn btn-success" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="agregar">Agregar</button>
                <button type="submit"  class="btn btn-warning" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="modificar">Modificar</button>
                <button type="submit"  class="btn btn-info" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="cancelar">Cancelar</button>
            </div>
    </form>
        </div>
        
    </div>
    
    </div>
    
    <div class="col-md-7">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>IMAGEN</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaLibros as $libro) { ?>
        
                <tr>
                    <td><?php echo $libro['id']; ?></td>
                    <td><?php echo $libro['nombre']; ?></td>
                    <td>

                        <img src="../../img/<?php echo $libro['imagen']; ?>" alt="" style="border-radius: 50%;" width="70" height="70">

                    </td>
                    <td>

                    <form method="post">
                        <input type="hidden" name="txtId" id="txtId" value="<?php echo $libro['id']; ?>">

                        <input type="submit" name="accion"  value="Seleccionar" class="btn btn-primary">

                        <input type="submit" name="accion"  value="Borrar" class="btn btn-danger">

                    </form>

                    </td>
                </tr>
                
                <?php } ?>
            </tbody>
        </table>
    </div> 
    </div> 

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item disabled">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
</div>  


