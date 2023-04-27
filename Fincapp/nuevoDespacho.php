<?php



//   primero se realiza el formulario con los datos, al completar el despacho se realiza en el siguiente orden:




include 'templates/head.php';
include 'conexion.php';
include 'orden.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} else {
    $NUM_ORDEN = GetIsset('num_orden');


?>
    <div class="row">
        <form action="" method="post" class="form-group">
            <div class="col-12 center">
                <div class=" table table-responsive border border-dark p-3 ">
                    <table class="table table-light table-striped table-hover">
                        <tr>
                            <th>
                                <div class="input-group p-3 mr-4">
                                    <span class="input-group-text" id="basic-addon1">Número de orden</span>
                                    <input type="number" class="form-control " required name="numOrden" id="" aria-describedby="helpId" placeholder="Número de orden" value="<?php echo $NUM_ORDEN; ?>">
                                </div>
                            </th>
                        <tr>
                            <th>
                                <div class="input-group p-3 mr-4">
                                    <span class="input-group-text" id="basic-addon1">nombre del cliente</span>

                                    <div class="input-group"> <input type="text" class="form-control" required name="nombreCliente" id="" aria-describedby="helpId" placeholder="nombre del cliente"> </div>
                                </div>
                            </th>
                        </tr>


                        <tr>
                            <th>
                                <div class="input-group p-3 mr-4">
                                    <span class="input-group-text" id="basic-addon1">Dirección</span>
                                    <div class="input-group"> <input type="text" class="form-control" required name="direccionCliente" id="" aria-describedby="helpId" placeholder="Dirección"> </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="input-group p-3 mr-4">
                                    <span class="input-group-text" id="basic-addon1">telefono</span>
                                    <div class="input-group"> <input type="number" class="form-control" required name="telefonoCliente" id="" aria-describedby="helpId" placeholder="Teléfono"> </div>
                                </div>
                            </th>
                        </tr>

                        <tr>
                            <th>
                                <div class="input-group p-3 mr-4">
                                    <span class="input-group-text" id="basic-addon1">fecha de entrega</span>
                                    <div class="input-group"> <input type="date" class="form-control" required name="fecha" id="" aria-describedby="helpId" placeholder="fecha de entrega"></div>
                                </div>
                            </th>
                        </tr>

                        <tr>
                            <td colspan="12">
                                <button class="btn btn-outline-success mt-4 mb-4" type="submit" name="accionBoton" value="despachar">Completar despacho</button>
                            </td>

                        </tr>

                    </table>
                </div>
            </div>
        </form>
    </div>




<?php
}
include 'templates/foot.php';
?>