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

    <?php


    $m = "de hoy : $";
    date_default_timezone_set("America/Bogota");
    $f = date('Y-m-d');
    if (isset($_POST['fecha'])) {
        $f = $_POST['fecha'];
        $fecha = date("d-m-Y", strtotime($f));
        $m = "del día {$fecha} : $";
    }
    $sql = $conexion->query("SELECT * FROM `orden` where orden.fecha = '{$f}'; ");

    $ganancia = 0;
    while ($r = mysqli_fetch_array($sql)) {


        $ganancia += $r['total_venta'];
    }
    ?>
    <?php
    $con = $conexion->query("SELECT * FROM `orden` where orden.fecha = '{$f}'  ORDER BY orden.fecha DESC ");

    ?>

    <div class="p-3">
        <div class="  table-responsive border p-3 table-scrollable ">
            <table class="table table-responsive border table-striped table-hover ">
                <caption> Total ganancias <?php echo $m;
                                            echo number_format($ganancia); ?> </caption>
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