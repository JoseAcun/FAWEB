<?php
include 'templates/head.php';
include 'conexion.php';
?>

<?php


$producto = GetIsset('producto');
$cantidad = GetIsset('cantidad');
$conexion = Conectar();

// insertar en la bd
$contador = 0;
$consultaProducto = $conexion->query("select * from producto where nombre='{$producto}'");
date_default_timezone_set("America/Bogota");
$mifecha = date('Y-m-d');
while ($res = mysqli_fetch_array($consultaProducto)) {
    $contador++;
    if ($contador > 0) {

        for ($i = 0; $i < $cantidad; $i++) {
            $conexion->query("INSERT INTO stock_productos (id_producto,fecha_ingreso) VALUES ({$res['id']},'{$mifecha}')"); // corregir fecha de ingreso [listo]
        }
?>
        <div class="alert alert-success" role="alert">
            Se han ingresado <?php echo ("<strong>{$cantidad}</strong>"); ?> <?php echo ("<strong>{$producto}</strong>"); ?> al inventario.
        </div>
    <?php

    }
}

if ($contador == 0) {
    ?>
    <div class="alert alert-danger" role="alert">
        El producto que intentas ingresar no existe.
    </div>
    <a class="link-dark mb-2" href="nuevoProducto.view.php">click acá para crearlo</a>
<?php
}
include 'templates/foot.php';
?>