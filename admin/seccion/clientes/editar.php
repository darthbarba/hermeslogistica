<?php
include("../../bd.php");

if($_POST)
{
    $txtID = isset($_POST["txtID"]) ? $_POST["txtID"] : '';
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] :"";

    $sentencia=$conexion->prepare("UPDATE tlb_clientes
    SET 
    descripcion=:descripcion
    WHERE ID=:id");

    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $imagen=isset( $_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : '';
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    $imagen="imagenes/".$imagen;

    if($imagen!="")
    {
        $fecha_imagen= new DateTime();
        $nombre_imagen=$fecha_imagen->getTimestamp()."_".$imagen;
        move_uploaded_file($tmp_imagen,"../../../images/clientes/".$nombre_imagen);

        $sentencia_imagen = $conexion->prepare("SELECT imagen FROM tlb_clientes WHERE ID=:id");
        $sentencia_imagen->bindParam(":id", $txtID);
        $sentencia_imagen->execute();
        $registro_imagen = $sentencia_imagen->fetch(PDO::FETCH_ASSOC);
        if(isset($registro_imagen) && is_array($registro_imagen) && isset($registro_imagen['imagen']))
         {
            if(file_exists("../../../images/clientes/" . $registro_imagen['imagen'])) 
            {
                unlink("../../../images/clientes/" . $registro_imagen['imagen']);
            }
        }

        // Corrección: Eliminé las comillas simples alrededor del nombre de la tabla y el punto y coma (;) después de :imagen
        $sentencia=$conexion->prepare("UPDATE tlb_clientes
        SET 
        imagen=:imagen
        WHERE ID=:id");

        $sentencia->bindParam(":imagen",$nombre_imagen);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
    }

    header("Location:index.php");

}

if(isset($_GET['txtID']))
{
    $txtID = isset($_GET["txtID"]) ? $_GET["txtID"] : '';

    $sentencia = $conexion->prepare("SELECT * FROM `tlb_clientes` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
//recuperar 
    $descripcion = $registro["descripcion"];
    $imagen = $registro["imagen"];

}

include("../../templates/header.php");
?>

<br></br>
<div class="card">
    <div class="card-header">Clientes</div>
    <div class="card-body">   
    </div>
    <div class="card-footer text-muted">
    <form action="" method="post" enctype="multipart/form-data">
         <div class="mb-3">
            <label for="" class="form-label">ID</label>
             <input
            type="text" class="form-control" value="<?php echo $txtID?>"
             name="txtID" id="txtID" aria-describedby="helpId" placeholder="id"/>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text"
            value="<?php echo $descripcion;?>" 
            class="form-control" name="descripcion" id="descripcion"
            aria-describedby="helpId" placeholder="Escriba la descripción" />
        </div>
        <div class="mb-3">
            <img width="50" src="../../../images/clientes/<?php echo $imagen;?>" />
            <label for="" class="form-label">Imagen</label></br>
            <input type="file" class="form-control" name="imagen" id="imagen"
                placeholder="Seleccione la imagen" aria-describedby="fileHelpId" />
        </div>  
        <button type="submit" class="btn btn-success">Modificar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        
    </form>
    </div>
</div>