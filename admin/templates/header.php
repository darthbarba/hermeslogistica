<?php 

session_start();
if (!isset($_SESSION["usuario"]))
{
    header("Location:".$url_base."login.php");
}

$url_base="http://localhost/hermes/admin"
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Administrador</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        
    </head>
    <body>
<header>

<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="<?php echo $url_base;?>/index.php" aria-current="page"
            >Administrador <span class="visually-hidden">(current)</span></a
        >
        <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/banner">Banners</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/servicios">Servicios</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/clientes">Clientes</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/consultas">Consultas</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/usuarios">Usuarios</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>/cerrar.php">Cerar sesión</a>
    </div>
</nav>
</header>
<main>
<section class= "container-fluid">