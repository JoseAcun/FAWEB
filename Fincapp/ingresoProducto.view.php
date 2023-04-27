<?php
include 'templates/head.php';

$nombre = "";
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}

?>
<div class="p-3 bg-white bg-gradient">
    <div class="col border border-dark">
        <form action="ingresoProducto.php" method="post">

            <div class="form-group p-3">

                <p><strong>Ingreso de productos</strong> </p>

                <div class="input-group p-3 mr-4 w-50">
                    <span class="input-group-text" id="basic-addon1">Nombre producto</span>
                    <input type="text" class="form-control" name="producto" id="" aria-describedby="helpId" value="<?php echo $nombre; ?>" placeholder="nombre producto" required>
                </div>
                <div class="input-group p-3 mr-4 w-25">
                    <span class="input-group-text" id="basic-addon1">Cantidad</span>
                    <input type="number" class="form-control" name="cantidad" id="" aria-describedby="helpId" placeholder="cantidad" required>
                </div>

            </div>



            <div class="form-group mt-4 p-3">
                <button type="submit" name="boton" value="crear" class="btn btn-outline-primary">Ingresar producto</button>
            </div>
        </form>
    </div>
</div>




<?php
include 'templates/foot.php';
?>