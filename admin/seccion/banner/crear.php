<?php 
include("../../bd.php");

if($_POST)
{
    $titulo=isset( $_POST["titulo"]) ? $_POST["titulo"] : '';
    $subtitulo=isset( $_POST["subtitulo"]) ? $_POST["subtitulo"] : '';
    $link=isset( $_POST["link"]) ? $_POST["link"] : '';
    
    $sentencia=$conexion->prepare("INSERT INTO `tbl_banners` 
    (`ID`, `titulo`, `subtitulo`, `link`) 
    VALUES (NULL, :titulo, :subtitulo, :link);");

    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":link",$link);
    $sentencia->execute();
    header("Location:index.php");
}

include("../../templates/header.php"); ?>

<br></br>
<div class="card">
    <div class="card-header">Banner</div>
    <div class="card-body">

    <form action="" method="post">
    <div class="mb-3">
        <label for="" class="form-label">Título</label>
        <input
            type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el título"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Subtitulo</label>
        <input
            type="text" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Escriba el subtitulo"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Link</label>
        <input
            type="text" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Escriba el link"/>
    </div>
    <button type="submit" class="btn btn-success">Crear banner</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>