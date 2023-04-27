<?php
include 'conexion.php';
include 'templates/head.php';
include 'orden.php';

$codigo = GetIsset('codigo');
$id = GetIsset('id');
$nombre = GetIsset('nombre');
$cantidad = GetIsset('cantidad');
$precio = GetIsset('precio');

?>
<div class="col border border-dark p-3">
    <form action="" method="post">
        <table class="table">
            <tr>
                <th>
                    Modificar producto:
                </th>
            </tr>
        </table>

  <!--       <input type="hidden" name="codigo" id="codigo" value="">
        <input type="hidden" name="nombre" id="nombre" value="">
        <input type="hidden" name="cantidad" id="cantidad" value="">
        <input type="hidden" name="precio" id="precio" value="">
 -->
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

        <div class="input-group p-3 mr-4 w-25">
            <span class="input-group-text" id="basic-addon1">Código</span>
            <input type="number" class="form-control" name="nuevoCodigo" id="" value="<?php echo $codigo; ?>" aria-describedby="helpId" placeholder="Nuevo código" required>

        </div>

        <div class="input-group p-3 mr-4 w-50">
            <span class="input-group-text" id="basic-addon1">Nombre producto</span>
            <input type="text" class="form-control" name="nuevoNombre" id="nuevoNombre" value="<?php echo $nombre; ?>" aria-describedby="helpId" placeholder="Nombre producto" required>
        </div>

        <div class="input-group p-3 mr-4 w-25">
            <span class="input-group-text" id="basic-addon1">Cantidad</span>
            <input type="number" class="form-control" name="nuevaCantidad" id="" value="<?php echo $cantidad; ?>" aria-describedby="helpId" placeholder="Cantidad" required>
        </div>

        <div class="input-group p-3 mr-4 w-25">
            <span class="input-group-text" id="basic-addon1">Precio</span>
            <input type="number" class="form-control" name="nuevoPrecio" id="" value="<?php echo $precio; ?>" aria-describedby="helpId" placeholder="Precio" required>
        </div>

        <button class="btn btn-outline-dark mt-4" type="submit" name="accionBoton" value="modificar_producto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
            </svg></button>
    </form>
</div>


<?php



?>