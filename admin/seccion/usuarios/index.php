<?php

include("../../bd.php");

if(isset($_GET['txtID']))
{
    $txtID = isset($_GET["txtID"]) ? $_GET["txtID"] : '';
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location:index.php");
    exit();
}

$sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios"); 
$sentencia->execute();  
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<br></br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class= "btn btn-primary" href="crear.php" role="button">Añadir usuarios </a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Password</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_usuarios as $registro)
                {
                ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro ["ID"]; ?></td>
                        <td><?php echo $registro ["usuario"]; ?></td>
                        <td>********</td>
                        <td><?php echo $registro ["correo"]; ?></td>
                        <td><a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro["ID"]?>" role="button">Eliminar</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("../../templates/footer.php")
?>