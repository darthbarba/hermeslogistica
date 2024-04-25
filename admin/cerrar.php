<?php
session_start();
session_destroy();

ob_clean();

header("Location: http://localhost/hermes/admin/login.php");

exit(); 
?>
