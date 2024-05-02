<?php

include("admin/bd.php");


$sentencia=$conexion->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1");
$sentencia ->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tlb_servicios ORDER BY id DESC");
$sentencia ->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tlb_clientes ORDER BY id DESC");
$sentencia ->execute();
$lista_clientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if($_POST)
{

  $nombre = filter_input(INPUT_POST, 'nombre', 513);
  $correo = filter_input(INPUT_POST, 'correo', 513); 
  $mensaje = filter_input(INPUT_POST, 'mensaje', 513); 

  if($nombre && $correo && $mensaje)
  {
    $sql="INSERT INTO tbl_consultas (nombre, correo, mensaje)
           VALUES (:nombre, :correo, :mensaje)";
    $resultado=$conexion->prepare($sql);
    $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $resultado->bindParam('correo', $correo, PDO::PARAM_STR);
    $resultado->bindParam('mensaje', $mensaje, PDO::PARAM_STR);
    $resultado->execute();

    $mensaje="Consulta enviada correctamente";
  }
  header("Location:index.php");
  exit();
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Hermes Logística Integral</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hadnich:wght@400&display=swap">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">    
  <link rel="stylesheet" href="estilos.css">
</head>

<body>

<!-- navar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/imagen-logopata.jpg" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto text-end">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#inicio">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#servicios">Nuestros servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#clientes">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">Acerca de Hermes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contacto">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Banner -->

<section id="banner" class="container-fluid p-0"> 
    <div class="banner-img" style="position: relative;">
        <div class="banner-text">
        <?php foreach($lista_banners as $banner) { ?>
        <h1 class="banner-text-h1"><?php echo $banner['titulo']; ?></h1>
        <p class="montserrat-regular"><?php echo $banner['subtitulo']; ?></p>
        <a href="<?php echo $banner['link']; ?>" target="_blank" class="btn btn-success btn-lg btn-whatsapp banner-btn">
                <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
        </a>
        <?php } ?>
        </div>
    </div>
</section>

<!-- sEPARADOR -->

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: rotate(180deg) scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>


<!-- servicios -->

<section id="servicios" class="container mt-4">
    <h2 class="text-center">Nuestros servicios</h2>
    <br/><br/>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($lista_servicios as $servicio ) { ?>
            <div class="col d-flex">
                <div class="card">
                    <div class="card-img-wrapper">
                        <img src="images/servicios/<?php echo $servicio["imagen"]; ?>" class="card-img-top" alt="">
                        <div class="img-overlay"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $servicio["titulo"]; ?></h5>
                        <p class="card-text small"><?php echo $servicio["descripcion"]; ?></p>
                    </div> 
                </div>
            </div>
        <?php } ?>
    </div>
</section>


<!-- sEPARADOR -->

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: rotate(180deg) scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>

<!-- Clientes -->

<section id="clientes" class="">
    <div class="container">
        <h2 class="text-center mb-4">Clientes</h2>
        <div class="row">
        <?php foreach($lista_clientes as $clientes ) { ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="images/clientes/<?php echo $clientes ["imagen"]; ?>" class="card-img-top img-cliente" alt="Cliente 1">
                    <div class="card-body">
                        <p class="card-text"> <?php echo $clientes ["descripcion"]; ?> </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>

<!-- sEPARADOR -->

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: rotate(180deg) scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>
<!--ACERCA-->

<div id="about" class="text-center">
    <h3 class="mb-4"> Acerca de Hermes Logística Integral </h3>
    <div>
        <p><strong> Nuestra historia </strong></p>
        <p> Somos líderes en el traslado seguro y eficiente de personas, animales y grandes paquetes a nivel nacional e internacional. </p>
        <p><strong> Servicios especializados </strong></p>
        <p> Ofrecemos servicios especializados que abarcan desde el transporte de personas con necesidades especiales hasta el traslado de animales de compañía y la logística de grandes cargas para empresas. </p>
        <p><strong> Compromiso con la seguridad </strong></p>
        <p> Nuestro compromiso principal es garantizar la seguridad y el bienestar de nuestros pasajeros, los animales que trasladamos y la integridad de cada paquete. Contamos con protocolos rigurosos y profesionales altamente capacitados para lograrlo </p>
        <p><strong> Testimonios de clientes </strong></p>
        <p> Nuestros clientes satisfechos respaldan la calidad de nuestros servicios. Conoce sus testimonios y casos de éxito en nuestros traslados especiales. </p>
        <p><strong> Contáctanos </strong></p>
        <p> Para solicitar nuestros servicios o recibir más información, no dudes en contactarnos a través de nuestro formulario en línea o por teléfono. </p>
    </div>
</div>

<BR></BR>

<!-- sEPARADOR -->

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: rotate(180deg) scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>

<div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #2e4bc7; width: 130%; height: 140px; transform: scaleX(-1);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>

<!-- CONTACTO 7:50 -->

<section id="contacto" class="container mt-4">
    <h2> Pedí tu presupuesto </h2>
    <form  action="" method="post">

    <div class="mb-3">
        <label  for="nombre">Nombre y apellido:</label><br/>
        <input  type="text" class="form-control" name="nombre" placeholder="Escribe tunombre" required /><br/>
    </div>

    <div class="mb-3">
        <label  for="correo">Correo electronico:</label><br/>
        <input  type="correo" class="form-control" name="correo" placeholder="Escriba su correo electronico" required /><br/>
    </div>

    <div class="mb-3">
        <label  for="mensaje">Mensaje:</label><br/>
        <textarea  rows="8" cols="30" class="form-control" placeholder="Escribe tu mensaje" name="mensaje"></textarea><br/>
    </div>

    <input  type="submit" class= "btn btn-primary" value="Enviar mensaje"/>

    </form>
</section>


<br></br>
 
<header>
</header>
<main></main>


<footer class="bg-dark text-light text-center py-3">
    <p> &copy; 2024, Hermés Logística todos los derechos reservados.</p>
</footer>
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
