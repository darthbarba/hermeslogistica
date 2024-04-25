<?php 

$servidor="localhost";
$baseDatos="hermes";
$usuario="root";
$password="";


try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
if ($conexion) {
    $sentencia = $conexion->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1");
    $sentencia->execute();
    $lista_banners = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "La conexión no se estableció correctamente.";
    // Puedes agregar más acciones aquí en caso de que la conexión no esté disponible
}
?>