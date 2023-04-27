<?php
include 'conexion.php';

$sql = $conexion->query("select * from producto");


if (isset($_POST['consulta'])) {

    $sql = $conexion->query("select * from producto where producto.nombre LIKE LOWER('%" . $_POST['consulta'] . "%') or producto.codigo LIKE LOWER('%" . $_POST['consulta'] . "%')");
}
?>

<div class="  table-responsive border p-3 table-scrollable">
    <table class="table table-responsive border  table-hover ">
        <tr>
            <th>cod</th>
            <th>nombre</th>
            <th>precio</th>
            <th>Añadir</th>
            <th>Stock</th>

        </tr>
        <?php
        while ($r = mysqli_fetch_array($sql)) {

            $cantidad = 0;
            $r_id = $r['id'];
            $consultarCantidad = $conexion->query("select * from stock_productos where id_producto = {$r_id}");
            while ($s = mysqli_fetch_array($consultarCantidad)) {
                $cantidad++;
            }
        ?><tr>
                <td><?php echo $r['codigo']; ?></td>
                <td><?php echo $r['nombre']; ?></td>
                <td><?php echo $r['precio']; ?></td>



                <td>
                    <form action="" method="post">
                        <!-- 
                        <input type="number" style="background-color:#98FB98;" name="descuento" id="descuento" class="w-25 m-2" placeholder="Descuento" value=0> -->
                        <input type="hidden" name="id" id="id" value="<?php echo $r['id'];  ?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo $r['nombre'];  ?>">
                        <!-- 	<input type="hidden" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>"> -->
                        <input type="hidden" name="precio" id="precio" class="active" value="<?php echo  $r['precio']; ?>">
                        <!-- 	VERIFICAR SI LA CANTIDAD A AÑADIR NO SUPERA EL STOCK  -->


                        <?php
                        $cantidadPedida = 0;
                        $sen = $conexion->query("select * from factura_producto_temp where id_producto = {$r_id}");
                        while ($resultado = mysqli_fetch_array($sen)) {
                            $cantidadPedida++;
                        }

                        if ($cantidad > $cantidadPedida) {
                        ?>

                            <input type="hidden" name="cantidadStock" id="cantidadStock" value="<?php echo $cantidad; ?>">
                            <button class="btn btn-outline-success" type="submit" name="accionBoton" value="Add"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg></button>
                            <input type="number" name="cantidad_solicitada" class="w-25" id="cantidad_solicitada" placeholder="Añadir cantidad" value="">
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-danger disabled" type="submit" name="accionBoton" value="Add">Sin stock</button>
                        <?php
                        }
                        ?>

                    </form>
                </td>

                <td><?php echo $cantidad; ?></td>


            </tr>
        <?php
        }

        ?>

    </table>
</div>
<?php
?>