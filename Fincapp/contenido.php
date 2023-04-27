<?php session_start();
if (isset($_SESSION['usuario'])) {
	require 'contenido.view.php';
} else {
	header('Location: login.php');
}
?>