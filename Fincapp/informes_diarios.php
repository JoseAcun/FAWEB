<?php
include 'templates/head.php';
include 'conexion.php';
include 'orden.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} else {
    include './templates/header_informes.php';

?>


<h1>Total ganancias en este mes:</h1>
    <?php
    date_default_timezone_set(timezoneId: "America/Santiago");
    $f = date('Y-m-d');

    $sql = $conexion->query("SELECT * FROM `orden` where orden.fecha = '{$f}'; ");

    $ganancia = 0;
    while ($r = mysqli_fetch_array($sql)) {


        $ganancia += $r['total_venta'];
    }
    echo number_format($ganancia);
    ?>



    <?php
    $con = $conexion->query("SELECT * FROM `orden` where orden.fecha = '{$f}'  ORDER BY orden.fecha DESC ");

    ?>

    <div class="p-3">
        <div class="  table-responsive border p-3 table-scrollable ">
            <table class="table table-responsive border table-striped table-hover ">
                <tr>
                    <th>N° Orden</th>
                    <th>Fecha de emisión</th>
                    <th>TOTAL VENTA</th>
                    <th></th>
                </tr>


                <?php
                while ($res = mysqli_fetch_array($con)) {

                    $fecha = date("d-m-Y", strtotime($res['fecha']));
                ?> <tr>
                        <td><?php echo $res['num_orden']; ?></td>
                        <td><?php echo ($fecha); ?></td>
                        <td><strong><?php echo ('$'); ?></strong><?php echo number_format($res['total_venta']); ?></td>
                        <td>

                            <form action="ventas_detalles.php" method="post">
                                <input type="hidden" name="num_orden" id="num_orden" value="<?php echo $res['num_orden']; ?>">
                                <button class="btn btn-outline-success" type="submit">Ver detalles </button>
                            </form>


                        </td>
                    </tr>

                <?php
                }
                ?>


            </table>
        </div>
    </div>

<?php

}
include 'templates/foot.php';
?>