<?php



include 'templates/head.php';
include 'conexion.php';
include 'orden.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} else {

    // realizar backend del despacho [+ -]
    // mostrar todos los despachos, en orden de PENDIENTE a COMPLETADO (un despacho esta completo cuando todos sus productos han sido completados) [PENDIENTE]

    // Algoritmo:
    // Iterar por cada despacho
    // por cada despacho, ver si hay un registro en despacho_producto que esté pendiente
    // [OPCIONAL] mostrar los despachos completados


    // $sentence = $conexion->query("SELECT * FROM `despacho` ORDER BY `despacho`.`fecha_entrega` ASC;");


    $cant = 0;
    $s = $conexion->query("SELECT * FROM `despacho` ORDER BY `despacho`.`fecha_entrega` ASC;");
    $v = $conexion->query("SELECT * FROM `despacho_producto` where estado = 'pendiente';");
    while ($z = mysqli_fetch_array($v)) {
        $cant++;
    }

?> <style>
        .table-scrollable {
            overflow-y: scroll;
            max-height: 300px;
        }
    </style><?php
            if ($cant != 0) {



                $num_despacho = 0;
                $estado = 'pendiente';
                $fecha_entrega;
                $nombre_cliente = '';
                $num_cliente = 0;
                $direccion_cliente = '';
                $id_producto = 0;
            ?>


        <div class="col">



            <div class="table-responsive border border-dark p-3" class="table-scrollable">
                <p><i>Despachos pendientes</i></p>

                <table class="table table-striped table-bordered ">

                    <tr>
                        <th>Nº despacho</th>
                        <th>Estado</th>
                        <th>fecha de entrega</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php

                    while ($r = mysqli_fetch_array($s)) {


                        $sentence2 = $conexion->query("SELECT * FROM `despacho_producto` WHERE despacho_producto.estado = 'pendiente' AND  despacho_producto.num_despacho = {$r['num_despacho']} limit 1");

                        while ($res = mysqli_fetch_array($sentence2)) {
                            $num_despacho = $res['num_despacho'];
                            $estado = $res['estado'];
                            $fecha_entrega = $r['fecha_entrega'];
                            $nombre_cliente = $r['nombre_cliente'];
                            $num_cliente = $r['num_cliente'];
                            $direccion_cliente = $r['direccion_cliente'];




                    ?>

                            <tr>
                                <td><?php echo  $num_despacho;  ?></td>
                                <td>
                                    <p class="text-danger"><?php echo $estado; ?></p>
                                </td>
                                <td><?php echo  $fecha_entrega;  ?></td>
                                <td>


                                    <form action="verDespacho.php" method="post">


                                        <input type="hidden" name="num_despacho" id="num_despacho" value="<?php echo  $num_despacho; ?>">
                                        <input type="hidden" name="estado" id="estado" value="<?php echo $estado;  ?>">
                                        <input type="hidden" name="fecha_entrega" id="fecha_entrega" value="<?php echo $fecha_entrega;  ?>">
                                        <input type="hidden" name="nombre_cliente" id="nombre_cliente" value="<?php echo $nombre_cliente;  ?>">
                                        <input type="hidden" name="num_cliente" id="num_cliente" value="<?php echo $num_cliente;  ?>">
                                        <input type="hidden" name="direccion_cliente" id="direccion_cliente" value="<?php echo $direccion_cliente;  ?>">
                                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto;  ?>">

                                        <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Ver despacho
                                        </button>
                                    </form>

                                </td>
                                <td>
                                    <!--    marcar completado -->
                                    <form action="" method="post">
                                        <input type="hidden" name="num_despacho" id="num_despacho" value="<?php echo  $num_despacho; ?>">
                                        <button class="btn btn-outline-success" type="submit" name="accionBoton" value="marcar_completado">marcar completado</button>
                                    </form>
                                </td>
                            </tr>


                    <?php
                        }
                    }
                    ?>
                </table>
            </div>

        </div>


    <?php
            }
    ?>
    <div class="col mt-4">
        <div class="table-responsive border border-dark p-3 table-scrollable">
            <p><i>Despachos completados</i></p>

            <table class="table table-striped table-bordered ">

                <caption> <i> Despachos completados</i></caption>

                <tr>
                    <th>Nº despacho</th>
                    <th>Estado</th>
                    <th>fecha de entrega</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                $s = $conexion->query("SELECT * FROM `despacho` ORDER BY `despacho`.`fecha_entrega` ASC;");
                while ($r = mysqli_fetch_array($s)) {


                    $sentence2 = $conexion->query("SELECT * FROM `despacho_producto` WHERE despacho_producto.estado = 'completado' AND  despacho_producto.num_despacho = {$r['num_despacho']} limit 1");

                    while ($res = mysqli_fetch_array($sentence2)) {
                        $num_despacho = $res['num_despacho'];
                        $estado = $res['estado'];
                        $fecha_entrega = $r['fecha_entrega'];
                        $nombre_cliente = $r['nombre_cliente'];
                        $num_cliente = $r['num_cliente'];
                        $direccion_cliente = $r['direccion_cliente'];




                ?>

                        <tr>
                            <td><?php echo  $num_despacho;  ?></td>
                            <td>
                                <p class="text-success"><?php echo $estado; ?></p>
                            </td>
                            <td><?php echo  $fecha_entrega; ?></td>
                            <td>


                                <form action="verDespacho.php" method="post">


                                    <input type="hidden" name="num_despacho" id="num_despacho" value="<?php echo  $num_despacho; ?>">
                                    <input type="hidden" name="estado" id="estado" value="<?php echo $estado;  ?>">
                                    <input type="hidden" name="fecha_entrega" id="fecha_entrega" value="<?php echo $fecha_entrega;  ?>">
                                    <input type="hidden" name="nombre_cliente" id="nombre_cliente" value="<?php echo $nombre_cliente;  ?>">
                                    <input type="hidden" name="num_cliente" id="num_cliente" value="<?php echo $num_cliente;  ?>">
                                    <input type="hidden" name="direccion_cliente" id="direccion_cliente" value="<?php echo $direccion_cliente;  ?>">
                                    <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto;  ?>">

                                    <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Ver despacho
                                    </button>
                                </form>

                            </td>
                            <td>
                                <!--    marcar completado -->
                                <form action="" method="post">
                                    <input type="hidden" name="num_despacho" id="num_despacho" value="<?php echo  $num_despacho; ?>">
                                    <button class="btn btn-outline-success" type="submit" name="accionBoton" value="marcar_completado" disabled>
                                        <p><strong>completado</strong> </p>
                                    </button>
                                </form>
                            </td>
                        </tr>


                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <?php

    ?>
    <!-- <a class="btn btn-outline-info mt-4" href="nuevoDespacho.php">Nuevo despacho</a> -->



<?php
}
include 'templates/foot.php';
?>