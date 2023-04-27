<?php
include 'templates/head.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} else {



?>


   


<?php
}
include 'templates/foot.php';
?>