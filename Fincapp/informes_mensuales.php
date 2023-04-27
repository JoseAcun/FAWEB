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

    $m = "de este mes : $";
    date_default_timezone_set("America/Bogota");

    $f = date('Y-m-d');
    $fechaFormat = strtotime($f);
    $mes = date("m", $fechaFormat);
    $anio = date("Y", $fechaFormat);
    $DiasMes = date('t');

    if (isset($_POST['mes'])) {
        $mes = $_POST['mes'];
        $mesArray = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $m = "del mes de {$mesArray[$mes - 1]} : $";
    }


    $sql = $conexion->query("select * from orden where (select YEAR(orden.fecha)) = '{$anio}' AND (select MONTH(orden.fecha)) = '{$mes}'");

    $ganancia = 0;
    while ($r = mysqli_fetch_array($sql)) {
        $ganancia += $r['total_venta'];
    }

    ?>

    <?php
    $con = $conexion->query("select * from orden where (select YEAR(orden.fecha)) = '{$anio}' AND (select MONTH(orden.fecha)) = '{$mes}'  ORDER BY orden.fecha DESC ");


    ?>





    <div class="p-3">

        <p> Total ganancias <?php echo $m;
                            echo number_format($ganancia); ?> </p>
        <?php
        for ($i = 1; $i < number_format($DiasMes + 1); $i++) {
            $dia = $conexion->query("select * from orden where (select YEAR(orden.fecha)) = '{$anio}' 
                AND (select MONTH(orden.fecha)) = '{$mes}' 
                AND (select DAY(orden.fecha)) = '{$i}'
                ORDER BY orden.fecha asc ");


            $cdias = 0;
            $totalDia = 0;

            $fecha = "{$i}-{$mes}-{$anio}";
            $fechaFormat = "{$anio}-{$mes}-{$i}";
            while ($rdia = mysqli_fetch_array($dia)) {

                $cdias++;
                $totalDia += $rdia['total_venta'];
            }
            if ($cdias != 0) {


        ?>
                <div class="  table-responsive border p-3 table-scrollable ">
                    <table class="table table-responsive border table-striped table-hover ">
                        <tr>
                            <th>Fecha</th>
                            <td><?php echo $fecha; ?></td>
                        </tr>
                        <tr>
                            <th>Cantidad de ordenes vendidas</th>
                            <td><?php echo $cdias; ?></td>
                        </tr>
                        <tr>
                            <th>Total de dinero ganado</th>
                            <td>$<?php echo  number_format($totalDia); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <form action="informes.php" method="post">
                                    <input type="hidden" name="fecha" id="fecha" value="<?php echo $fechaFormat; ?>">
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