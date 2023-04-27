<?php
include 'templates/head.php';
include 'conexion.php';
include 'orden.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} else {

    $sql = $conexion->query("SELECT * FROM `orden` ORDER BY `orden`.`fecha` DESC ");
?>


    <div class="row">


        <script type="text/javascript">
            $(Buscar_ventas());

            function Buscar_ventas(consulta) {
                Buscar_ventas();
                // alert(consulta.val());
                $.ajax({

                        url: 'buscar_venta.php',
                        type: 'POST',
                        dataType: 'html',
                        data: {
                            consulta: consulta
                        }

                    })
                    .done(function(r) {
                        $("#datos").html(r);
                    })
                    .fail(function() {
                        console.log("error");
                    })


            }
        </script>



        <form action="buscar_venta.php" class="form-group" method="post">
            <div class="w-50">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar4" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                        </svg> Desde</span>
                    <input type="date" placeholder="fecha" class="mb-4 input-group" name="desde" id="desde"></input>
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar4-range" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                            <path d="M9 7.5a.5.5 0 0 1 .5-.5H15v2H9.5a.5.5 0 0 1-.5-.5v-1zm-2 3v1a.5.5 0 0 1-.5.5H1v-2h5.5a.5.5 0 0 1 .5.5z" />
                        </svg> Hasta</span>
                    <input type="date" placeholder="fecha" class="mb-4 input-group" name="hasta" id="hasta"></input>
                </div>

            </div>




            <button id="busca_fecha" class="mb-3 btn btn-outline-dark" type="submit"><span class="input-group-text" id="basic-addon1"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></span></button>

        </form>






    </div>
    <!-- 
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
    </div> -->


    <?php
    ?>

    </div>

<?php
}
include 'templates/foot.php';
?>