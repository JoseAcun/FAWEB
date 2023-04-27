<?php
include 'conexion.php';

$sql = $conexion->query("select * from producto");

if (isset($_POST['consulta'])) {

    $sql = $conexion->query("select * from producto where producto.nombre LIKE LOWER('%" . $_POST['consulta'] . "%') or producto.codigo LIKE LOWER('%" . $_POST['consulta'] . "%')");
}
?>

<div class="table-responsive border ">
    <table class="table table-responsive border table-striped table-hover ">
        <tr>
            <th>cod</th>
            <th>nombre</th>
            <th>cantidad</th>
            <th><span class="glyphicon glyphicon-usd"></span></th>
            <th></th>
            <th></th>

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
                <td><?php echo $cantidad; ?></td>
                <td><?php echo  $r['precio']; ?></td>
                <td>

                    <form action="modificarProducto.php" method="post">

                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $r['codigo'];  ?>">
                        <input type="hidden" name="id" id="id" value="<?php echo $r['id'];  ?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo $r['nombre'];  ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $r['precio'];  ?>">


                        <button class="btn btn-outline-success" type="submit" name="accionBoton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                            </svg></span></button>


                    </form>

                </td>
                <td>
                    <form action="ingresoProducto.view.php" method="post">

                        <input type="hidden" name="nombre" id="nombre" value="<?php echo $r['nombre'];  ?>">

                        <button class="btn btn-outline-dark" type="submit" name="accionBoton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z" />
                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                            </svg>
                        </button>

                    </form>
                </td>
            </tr>
        <?php
        }

        ?>

    </table>
</div>


<?php
?>