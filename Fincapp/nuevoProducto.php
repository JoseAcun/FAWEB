<?php
include 'templates/head.php';
include 'conexion.php';


$conexion = Conectar();
$codigoProducto = GetIsset('codigoProducto');
$nombreProducto = GetIsset('nombreProducto');
$precio = GetIsset('precio');

$contador = 0;
$consultaProducto = $conexion->query("select * from producto where codigo='{$codigoProducto}'");
while ($res = mysqli_fetch_array($consultaProducto)) {
    $contador++;
}

$consultaProducto2 = $conexion->query("select * from producto where nombre='{$nombreProducto}'");
while ($res1 = mysqli_fetch_array($consultaProducto2)) {
    $contador++;
}
if ($contador == 0) {

    $conexion->query("INSERT INTO producto(codigo, nombre,precio) VALUES ({$codigoProducto},'{$nombreProducto}',{$precio})");

?>
    <div class="alert alert-success" role="alert">
        Se ha creado el producto correctamente. <br>
        <br>
        código producto: <?php echo ("<strong>{$codigoProducto}</strong>"); ?> <br>
        nombre producto: <?php echo ("<strong>{$nombreProducto}</strong>"); ?> <br>
        <?php $precioFormateado = number_format($precio); ?>
        precio producto: <?php echo ("<strong>$</strong><strong>{$precioFormateado}</strong>"); ?> <br>
    </div>

<?php
} else {
?>
    <div class="alert alert-danger" role="alert">
        El producto que intentas crear ya existe.
    </div>

    <a class="link-dark" href="ingresoProducto.view.php">click acá para ingresar stock del producto</a>
<?php
}
include 'templates/foot.php';
?>