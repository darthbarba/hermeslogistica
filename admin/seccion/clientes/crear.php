<?php 
include("../../bd.php");

if($_POST)
{
    // Verifico que los datos necesarios estén presentes y no estén vacíos
    if(isset($_POST["descripcion"]) && !empty($_POST["descripcion"]) && isset($_FILES["imagen"]["name"]) && !empty($_FILES["imagen"]["name"])) {
        $descripcion = $_POST["descripcion"];
        $imagen = $_FILES["imagen"]["name"];

        // Preparola consulta SQL
        $sentencia = $conexion->prepare("INSERT INTO `tlb_clientes` (`ID`, `descripcion`, `imagen`) VALUES (NULL, :descripcion, :imagen);");

        // Mouevo la imagen subida al directorio correspondiente
        $nombre_imagen = date("Y-m-d_H-i-s") . "_" . $imagen;
        $ruta_imagen = "../../../images/clientes/" . $nombre_imagen;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);

        // Asigno valores a los parámetros y ejecuto la consulta
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":imagen", $nombre_imagen);
        $resultado = $sentencia->execute();

        if($resultado) {
            // Redireccion a la página de index si la inserción fue exito

            header("Location: index.php");
            exit();
        } else {
            echo "Error al insertar datos en la base de datos.";
        }
    } else {
        echo "Error: Datos incompletos o vacíos.";
    }
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
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="Descripcion" aria-describedby="helpId" placeholder="Escriba la descripción" />
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Seleccione la imagen" aria-describedby="fileHelpId" />
        </div>  

        <button type="submit" class="btn btn-success">Agregar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
