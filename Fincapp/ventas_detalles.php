<?php
include 'templates/head.php';
include 'conexion.php';
include 'orden.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} else {
    $total = 0;
    $num_orden = GetIsset('num_orden');
    $sql = $conexion->query("SELECT * FROM `factura_producto` WHERE factura_producto.num_factura = {$num_orden} ");

?>
    <div class="  table-responsive border p-3 table-scrollable">
        <table class="table table-responsive border table-striped table-hover ">

            <tr>
                <th>Nombre producto</th>
                <th>Precio</th>

            </tr>


            <?php

            while ($r = mysqli_fetch_array($sql)) {

                $fac_produc = $conexion->query("SELECT * FROM `producto` WHERE producto.id = {$r['id_producto']}; ");
                while ($producto = mysqli_fetch_array($fac_produc)) {

                    $total += $r['precio_venta'];
            ?> <tr>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo ('$');
                            echo number_format($r['precio_venta']); ?></td>

                    </tr>
            <?php
                }
            }
            ?>
            <tr class="bg bg-dark text-white">
                <td><strong>SUBTOTAL</strong> </td>
                <td><strong><?php echo (number_format($total)); ?></strong> </td>
                
            </tr>
            <tr class="bg bg-dark text-white">
                <td><strong>DESCUENTO</strong> </td>
                <td><strong><?php
                            $totalVenta = 0;
                            $d = $conexion->query("SELECT * FROM `orden` WHERE num_orden = {$num_orden}; ");
                            $rd = mysqli_fetch_array($d);



                            $totalVenta = $total - $rd['total_venta'];
                            echo $totalVenta;


                            ?></strong> </td>


            </tr>
            <tr class="bg bg-dark text-white">
                <td><strong>TOTAL</strong> </td>
                <td><strong><?php echo ('$');
                            $totalVenta = 0;
                            $d = $conexion->query("SELECT * FROM `orden` WHERE num_orden = {$num_orden}; ");
                            $rd = mysqli_fetch_array($d);



                            $totalVenta = $total - $rd['total_venta'];

                            echo (number_format($total - $totalVenta)); ?></strong></td>
            </tr>


        </table>

        <?php
        $despacho = $conexion->query("SELECT * FROM `despacho` WHERE num_despacho = {$num_orden} ");
        $contadorDespachos = 0;
        while ($rDespacho = mysqli_fetch_array($despacho)) {
            $contadorDespachos++;
        }

        if ($contadorDespachos == 0) {


        ?>
            <form action="nuevoDespacho.php" method="post">
                <input type="hidden" name="num_orden" id="num_orden" value="<?php echo $num_orden; ?>">
                <button class="btn btn-outline-success" type="submit"> Despachar orden </button>
            </form>

        <?php
        } else {
        ?><button class="btn btn-outline-info" disabled> Esta orden ya ha sido despachada </button><?php
                                                                                                }
                                                                                            }
                                                                                            include 'templates/foot.php';
