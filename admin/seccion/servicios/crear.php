<?php 
include("../../bd.php");

if($_POST)
{
    $titulo=isset( $_POST["titulo"]) ? $_POST["titulo"] : '';
    $descripcion=isset( $_POST["descripcion"]) ? $_POST["descripcion"] : '';
   
    $sentencia=$conexion->prepare("INSERT INTO `tlb_servicios` 
    (`ID`, `titulo`, `descripcion`, `imagen`) 
    VALUES (NULL, :titulo, :descripcion, :imagen);");

    $imagen=isset( $_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : '';

    $fecha_imagen = new DateTime();
    $nombre_imagen = $fecha_imagen->getTimestamp()."_".$imagen;
    $tmp_imagen = $_FILES["imagen"]["tmp_name"];

    if($tmp_imagen!="")
    {
        move_uploaded_file($tmp_imagen, "../../../images/servicios/" . $nombre_imagen);

    }

    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":imagen",$nombre_imagen);
    $sentencia->execute();

    header("Location:index.php");

}

include("../../templates/header.php");
?>

<br></br>
<div class="card">
    <div class="card-header">Servicios</div>
    <div class="card-body">
    </div>
    <div class="card-footer text-muted">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo"
                aria-describedby="helpId" placeholder="Escriba el título" />
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="Descripcion"
                aria-describedby="helpId" placeholder="Escriba la descripción" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen"
                placeholder="Seleccione la imagen" aria-describedby="fileHelpId" />
        </div>  
        <button type="submit" class="btn btn-success">Crear nuevo servicio</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
</div>



<?php include("../../templates/footer.php"); ?>