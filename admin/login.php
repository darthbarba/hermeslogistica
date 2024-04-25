<?php
session_start();
include("bd.php");


if ($_POST) 
{
    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
    $password = isset($_POST["password"]) ? md5($_POST["password"]) : '';

    echo "consulta";

    // consulta para buscar al usuario por usuario y password
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario=:usuario AND password=:password");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();

    // fethc
    $usuarioEncontrado = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($usuarioEncontrado) 
    {
        echo "Inicio de sesión exitoso " . $usuarioEncontrado['usuario'];
        $_SESSION["usuario"]= $usuarioEncontrado;  // gurda variable sesion del usuario logeado
        $_SESSION["loggedUser"] = $usuarioEncontrado; 
        $_SESSION["loggedUser"] = $usuarioEncontrado;
        header("Location: index.php");
        exit(); 
    } else {
        echo "Usuario y/o password incorrectos.<br>";
    }
} ?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />
</head>


<style>
    .card {
       margin-top: 30px;
        width: 300px;
        height: 300px;
    }
</style>

<body>

<main>

<div class="container d-flex justify-content-center align-items-center" >
    <div  class="row">
        <div class="col"></div>
            <br></br>
                <div class="card text-center">
                    <div class="card-header"> Login </div>
                        <div class="card-body">
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Usuario:</label>
                            <input
                            type="text" class="form-control" name="usuario"
                            id="usuario" aria-describedby="helpId" placeholder=" Escriba su nombre de usuario"/>
                         </div>
                         <div class="mb-3">
                            <label for="" class="form-label">Contraseña</label>
                            <input
                            type="password"class="form-control"name="password"id="password"placeholder="Escriba su contraseña"/>
                        </div>
                        <button
                            type="submit" class="btn btn-primary">Iniciar sesión</button> 
                    </form>             
                    </div>   
                </div>
        </div>
    </div>
</div>

</main>

        <!-- Bootstrap JavaScript Libraries -->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
     crossorigin="anonymous">
</script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous">
</script>
</body>
</html>