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
    date_default_timezone_set("America/Bogota");
    $f = date('Y-m-d');
    $fechaFormat = strtotime($f);
    // $mes = date("m", $fechaFormat);
    $anio = date("Y", $fechaFormat);

    $sql = $conexion->query("select * from orden where (select YEAR(orden.fecha)) = '{$anio}'");

    $ganancia = 0;
    while ($r = mysqli_fetch_array($sql)) {


        $ganancia += $r['total_venta'];
    }

    ?>



    <?php
    $con = $conexion->query("select * from orden where (select YEAR(orden.fecha)) = '{$anio}' ORDER BY orden.fecha DESC ");

    ?>



    <div class="p-3">

        <p>Total ganancias en este año: $<?php echo number_format($ganancia); ?></p>
        <?php
        for ($i = 1; $i < 13; $i++) {

            $mes = $conexion->query("select * from orden where (select YEAR(orden.fecha)) = '{$anio}' 
                AND (select MONTH(orden.fecha)) = '{$i}' 
                ORDER BY orden.fecha asc ");


            $cmes = 0;
            $totalMes = 0;

            $mesArray = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            // $fechaFormat = "{$anio}-{$mes}-{$i}";
            while ($rMes = mysqli_fetch_array($mes)) {

                $cmes++;
                $totalMes += $rMes['total_venta'];
            }
            if ($cmes != 0) {


        ?>
                <div class="  table-responsive border p-3 table-scrollable ">
                    <table class="table table-responsive border table-striped table-hover ">
                        <tr>
                            <th>Mes</th>
                            <td><?php echo $mesArray[$i - 1]; ?></td>
                        </tr>
                        <tr>
                            <th>Cantidad de ordenes vendidas</th>
                            <td><?php echo $cmes; ?></td>
                        </tr>
                        <tr>
                            <th>Total de dinero ganado</th>
                            <td>$<?php echo  number_format($totalMes); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <form action="informes_mensuales.php" method="post">
                                    <input type="hidden" name="mes" id="mes" value="<?php echo $i; ?>">
                                    <button type="submit" class="btn btn-outline-success">Ver detalles</button>
                                </form>
                            </td>
                        </tr>

                    </table>
                </div>

        <?php
            }
        }

        ?>




    </div>


<?php
}
include 'templates/foot.php';
?>