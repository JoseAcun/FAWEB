<?php
include 'conexion.php';

$id_producto = GetIsset('id_producto');

$conexion->query("UPDATE `despacho_producto` SET `estado` = 'completado' WHERE `despacho_producto`.`id` = {$id_producto}; ");
header('Location: despacho.php');
