<?php 
include("../../bd.php");

if(isset($_GET['txtID']))
{
    $txtID = isset($_GET["txtID"]) ? $_GET["txtID"] : '';
    $sentencia = $conexion->prepare("DELETE FROM tbl_consultas WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location:index.php");
    exit(); 
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_consultas`");
$sentencia->execute();
$lista_consultas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");

?>

</br>

<div class="card">
    <div class="card-header">Consultas</div>
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Mensaje</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_consultas as $value) { ?>
                    <tr>
                        <td scope="row"><?php echo($value['ID'])?></td>
                        <td><?php echo($value['nombre'])?></td>
                        <td><?php echo($value['correo'])?></td>
                        <td><?php echo($value['mensaje'])?></td>
                        <td>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value["ID"]?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>
