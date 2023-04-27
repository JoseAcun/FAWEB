<?php
include 'templates/head.php';
?>

<?php session_start();
if (isset($_SESSION['usuario'])) {
	header('Location: contenido.php');
} else {
	header('Location: login.php');
}
?>

<?php
include 'templates/foot.php';
?>