<?php
include("../../bd.php");

if(isset($_GET['txtID']))
{
    $txtID = isset($_GET["txtID"]) ? $_GET["txtID"] : '';
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_banners` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $titulo = $registro["titulo"];
    $subtitulo = $registro["subtitulo"];
    $link = $registro["link"];
}

if($_POST)
{
    $titulo=isset( $_POST["titulo"]) ? $_POST["titulo"] : '';
    $subtitulo=isset( $_POST["subtitulo"]) ? $_POST["subtitulo"] : '';
    $link=isset( $_POST["link"]) ? $_POST["link"] : '';
    $txtID=isset( $_POST["txtID"]) ? $_POST["txtID"] : "";
    $sentencia=$conexion->prepare("UPDATE `tbl_banners` 
    SET titulo=:titulo, subtitulo=:subtitulo, link=:link WHERE ID=:id");
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":link",$link);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("Location:index.php");
}

include("../../templates/header.php");
?>

<br></br>
<div class="card">
    <div class="card-header">Banner</div>
    <div class="card-body">
    <form action="" method="post">
    <div class="mb-3">
        <label for="" class="form-label">ID</label>
        <input
            type="text" class="form-control" value="<?php echo $txtID?>"
             name="txtID" id="txtID" aria-describedby="helpId" placeholder="id"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Título</label>
        <input
            type="text" class="form-control" value="<?php echo $titulo?>" 
             name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el título"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Subtitulo</label>
        <input
            type="text" class="form-control" value="<?php echo $subtitulo?>" 
            name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Escriba el subtitulo"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Link</label>
        <input
            type="text" class="form-control" value="<?php echo $link?>" 
             name="link" id="link" aria-describedby="helpId" placeholder="Escriba el link"/>
    </div>
    <button type="submit" class="btn btn-success">Modificar banner</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>
