<?php 
include("../../bd.php");

if(isset($_GET['txtID'])) {
    $txtID = isset($_GET["txtID"]) ? $_GET["txtID"] : '';

    // obtener dfatos de la imagen
    $sentencia_imagen = $conexion->prepare("SELECT imagen FROM tlb_servicios WHERE ID=:id");
    $sentencia_imagen->bindParam(":id", $txtID);
    $sentencia_imagen->execute();
    $registro_imagen = $sentencia_imagen->fetch(PDO::FETCH_ASSOC);

    // verficar existencia
    if(isset($registro_imagen) && is_array($registro_imagen) && isset($registro_imagen['imagen'])) {
        // verfi nombre
        echo $registro_imagen['imagen'];

        // ruta
        echo "../../../images/servicios/" . $registro_imagen['imagen'];

        if(file_exists("../../../images/servicios/" . $registro_imagen['imagen'])) {
            unlink("../../../images/servicios/" . $registro_imagen['imagen']);
        }

        // elimina bd
        $sentencia_eliminar = $conexion->prepare("DELETE FROM tlb_servicios WHERE ID=:id");
        $sentencia_eliminar->bindParam(":id", $txtID);
        $sentencia_eliminar->execute();

        header("Location:index.php");
        exit();
    } else {
        echo "Error: No se encontraron datos de imagen para eliminar.";
    }
}

// lista desp de eliminar
$sentencia = $conexion->prepare("SELECT * FROM `tlb_servicios`");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<br></br>
<div class="card">
    <div class="card-header">
    <a name=""id=""class="btn btn-primary"href="crear.php"role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        
    <div
        class="table-responsive-sm">
        <table
            class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lista_servicios as $key  => $value) { ?>
                <tr class="">
                    <td scope="row"><?php echo $value["ID"]?></td>
                    <td><?php echo($value['titulo'])?></td>
                    <td><?php echo($value['descripcion'])?></td>
                    <td>
                    <img src="../../../images/servicios/<?php echo $value['imagen']?>" width="50" alt=""> 
                    </td>
                    <td>
                        <a name=""id=""class="btn btn-primary" href="editar.php?txtID=<?php echo $value["ID"]?>"role="button">Editar</a>
                        <a name=""id=""class="btn btn-danger" href="index.php?txtID=<?php echo $value["ID"]?>" role="button">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>  
            </tbody>
        </table>
    </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>