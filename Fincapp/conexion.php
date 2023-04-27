<?php
function Conectar($user = "root", $pass = "123", $server = "localhost", $baseDatos = "Fincapp")
{

    $conexion = mysqli_connect($server, $user, $pass) or die("Error al conectar. <br>");
    mysqli_select_db($conexion, $baseDatos);


    return $conexion;
}

function get_row($table, $row, $id, $equal)
{

    $query = Conectar()->query("select $row from $table where $id='$equal'");
    $rw = mysqli_fetch_array($query);
    $value = $rw[$row];
    return $value;
}
function GetIsset($e)
{
    if (isset($_POST[$e])) return $_POST[$e];
    else return "";
}
$conexion = Conectar();
