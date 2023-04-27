<?php
include './templates/head.php';
include 'conexion.php';

$sql = $conexion->query("SELECT * FROM `orden` ORDER BY orden.fecha DESC ");

if (isset($_POST['desde']) && isset($_POST['hasta'])) {

    $d = $_POST['desde'];
    $ha = $_POST['hasta'];
    $sql = $conexion->query("SELECT * FROM `orden` where orden.fecha BETWEEN '{$d}' AND '{$ha}'  ORDER BY orden.fecha DESC ");
}

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
            while ($r = mysqli_fetch_array($sql)) {

                $fecha = date("d-m-Y", strtotime($r['fecha']));
            ?> <tr>
                    <td><?php echo $r['num_orden']; ?></td>
                    <td><?php echo ($fecha); ?></td>
                    <td><strong><?php echo ('$'); ?></strong><?php echo number_format($r['total_venta']); ?></td>
                    <td>

                        <form action="ventas_detalles.php" method="post">
                            <input type="hidden" name="num_orden" id="num_orden" value="<?php echo $r['num_orden']; ?>">
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
?>