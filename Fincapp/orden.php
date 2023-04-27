<?php

$MENSAJE = "";

if (isset($_POST['accionBoton'])) {

    $ID =     GetIsset('id');
    $NOMBRE = GetIsset('nombre');

    $CANTIDAD =   1;
    $PRECIO = GetIsset('precio');

    switch ($_POST['accionBoton']) {
        case 'descuento_boton':
            $descuento = GetIsset('descuento');
            $conexion->query("UPDATE `factura_temp` SET `descuento` = '{$descuento}'");

            break;

        case 'clear':

            $conexion->query("TRUNCATE TABLE factura_temp;");
            $conexion->query("TRUNCATE TABLE factura_producto_temp;");

            break;
        case 'Delete':

            $e = $conexion->query("SELECT * FROM factura_producto_temp where factura_producto_temp.id_producto = {$ID};");

            $f = mysqli_fetch_array($e);
            $conexion->query("DELETE FROM `factura_producto_temp` WHERE `factura_producto_temp`.`id_producto` =  {$ID} LIMIT 1;");
            break;

        case 'Add':

            /*ERROR:  al actualizar la pagina, 
             añade un elemento a la base de datos. 
             para corregir, validar si la cantidad de elementos del pedido es menor al stock [CORREGIDO]*/

            $s = $conexion->query("SELECT * FROM `factura_temp`;");
            $c = 0;
            $num_factura = 0;
            $cantidad_ordenes = 0;
            $ultimaOrden = 0;
            // $descuento = GetIsset('descuento');

            // solucion error 
            $cantidadStock = GetIsset('cantidadStock');
            $cantidad_solicitada = GetIsset('cantidad_solicitada');

            $cantAcomparar = 0;

            $dar = 0;

            if (!isset($cantidad_solicitada) || $cantidad_solicitada == "") {
                $cantidad_solicitada = 1;
            }


            $solucion = $conexion->query("SELECT * FROM factura_producto_temp where id_producto = {$ID};");
            while ($rSolucion = mysqli_fetch_array($solucion)) {
                $cantAcomparar++;
            }

            if ($cantidadStock > $cantAcomparar) {
                while ($r = mysqli_fetch_array($s)) {
                    $c++;
                }

                $dar = $cantidadStock - $cantAcomparar;
                if ($cantidad_solicitada > $dar) {
                    $cantidad_solicitada = $dar;
                }
                if ($c < 1) {
                    // sabemos que no se ha creado una factura temporal, por lo tanto debemos hacer dos cosas
                    // ver si hay ordenes antiguas =>obtener la última factura que se creó en caso que haya
                    // crear la factura temporal con el numero de orden 0


                    $m = $conexion->query("SELECT * FROM orden ORDER BY num_orden DESC;");
                    while ($e = mysqli_fetch_array($m)) {
                        $cantidad_ordenes++;
                        if ($e['num_orden'] > $ultimaOrden) {
                            $ultimaOrden = $e['num_orden'];
                        }
                    }

                    if ($cantidad_ordenes == 0) { // EN CASO DE QUE NO HAYAN ORDENES
                        $conexion->query("insert into factura_temp(num_factura)values(0);");

                        for ($i = 0; $i < $cantidad_solicitada; $i++) {
                            $conexion->query("insert into factura_producto_temp(id_producto,num_factura)values({$ID},0);");
                        }
                    } else { // EN CASO DE QUE HAYA UNA ORDEN
                        $o = $ultimaOrden + 1;
                        $conexion->query("insert into factura_temp(num_factura)values({$o});");
                        for ($i = 0; $i < $cantidad_solicitada; $i++) {
                            $conexion->query("insert into factura_producto_temp(id_producto,num_factura)values({$ID},0);");
                        }
                    }
                } else { // EN CASO DE QUE HAYA UNA FACTURA TEMPORAL

                    $m = $conexion->query("SELECT * FROM orden ORDER BY num_orden DESC;");
                    while ($e = mysqli_fetch_array($m)) {
                        $cantidad_ordenes++;
                        if ($e['num_orden'] > $ultimaOrden) {
                            $ultimaOrden = $e['num_orden'];
                        }
                    }
                    $o = $ultimaOrden + 1;
                    for ($i = 0; $i < $cantidad_solicitada; $i++) {
                        $conexion->query("insert into factura_producto_temp(id_producto,num_factura)values({$ID},0);");
                    }
                }
            }

            break;

        case 'completar':

            $MENSAJE = "La compra se ha completado exitosamente.";

            // ERROR:  SI LA ORDEN ESTÁ VACÍA, NO COMPLETAR!! [CORREGIDO]
            $contador = 0;
            $total = 0;

            $sql = $conexion->query("SELECT * FROM `factura_producto_temp`;");

            while ($resultSql = mysqli_fetch_array($sql)) {
                $contador++;
            }
            if ($contador > 0) {



                //insertar la orden
                date_default_timezone_set('America/Bogota');
                $mifecha = date('Y-m-d');

                $s = $conexion->query("SELECT * FROM `factura_temp`;");
                $r = mysqli_fetch_array($s);


                //insertar productos 
                $p = $conexion->query("SELECT * FROM `factura_producto_temp`;");


                while ($producto = mysqli_fetch_array($p)) {
                    $pr = $conexion->query("SELECT * FROM `producto` where id = {$producto['id_producto']};");
                    $res = mysqli_fetch_array($pr);
                    $total += $res['precio'];

                    $conexion->query("insert into factura_producto(id_producto,num_factura,precio_venta)values({$producto['id_producto']},{$r['num_factura']},{$res['precio']});");

                    // Descontar los productos insertados en la orden[COMPLETADO]
                    $conexion->query("DELETE FROM `stock_productos` WHERE `id_producto` = {$producto['id_producto']} limit 1");
                }
                $total -= $r['descuento'];

                $conexion->query("insert into orden(num_orden,fecha,total_venta)values({$r['num_factura']},'{$mifecha}',{$total});");

                // limpiar orden 
                $conexion->query("TRUNCATE TABLE factura_temp;");
                $conexion->query("TRUNCATE TABLE factura_producto_temp;");

                // redirigir a impresión de comprobante [NO ES NECESARIO]
?>
                <div class="alert alert-success" role="alert">
                    <?php echo $MENSAJE; ?>
                </div>
            <?php


            }
            break;

        case 'despachar':

            // POR REALIZAR:
            // se completa la orden [listo]
            // se crea el despacho [listo]
            // se ingresan los productos de factura_producto_temp a despacho_producto y se marcan como pendientes [listo]
            // se limpian los registros temporales [listo]

            // En caso de crear un nuevo despacho, estar pendiente de validar si el numero de despacho existe 
            // CORREGIR :  SI LA ORDEN ESTÁ VACÍA, NO COMPLETAR!! [CORREGIDO]

            $num_despacho = GetIsset('numOrden');
            $nombre_cliente = GetIsset('nombreCliente');
            $num_cliente = GetIsset('telefonoCliente');
            $direccion_cliente = GetIsset('direccionCliente');
            $fecha = GetIsset('fecha');

            $total = 0;

            // completa la orden
            $s = $conexion->query("SELECT * FROM `factura_temp`;");
            $r = mysqli_fetch_array($s);
            date_default_timezone_set("America/Bogota");
            $mifecha = date('Y-m-d');


            $contador = 0;

            $sql = $conexion->query("SELECT * FROM `factura_producto_temp`;");

            $s2 = $conexion->query("SELECT * FROM `factura_temp`;");
            $r2 = mysqli_fetch_array($s2);

            while ($resultSql = mysqli_fetch_array($sql)) {
                $contador++;
            }
            if ($contador > 0) {


                //insertar productos 
                $p = $conexion->query("SELECT * FROM `factura_producto_temp`;");
                while ($producto = mysqli_fetch_array($p)) {
                    $pr = $conexion->query("SELECT * FROM `producto` where id = {$producto['id_producto']};");
                    $res = mysqli_fetch_array($pr);
                    $conexion->query("insert into factura_producto(id_producto,num_factura,precio_venta)values({$producto['id_producto']},{$r2['num_factura']},{$res['precio']});");
                    $total += $res['precio'];
                    $conexion->query("DELETE FROM `stock_productos` WHERE `id_producto` = {$producto['id_producto']} limit 1");
                }
                $total -= $r['descuento'];
                $conexion->query("insert into orden(num_orden,fecha,total_venta)values({$r2['num_factura']},'{$mifecha}',{$total});");
                // Se crea el despacho           
                $conexion->query(
                    "insert into despacho(
                num_despacho,
                nombre_cliente,
                num_cliente,
                direccion_cliente,
                fecha_entrega
                )values(
                {$num_despacho},
                '{$nombre_cliente}',
                {$num_cliente},
                '{$direccion_cliente}',
                '{$fecha}'
            );"
                );

                //insertar productos a despacho_productos
                $p = $conexion->query("SELECT * FROM `factura_producto_temp`;");

                while ($producto = mysqli_fetch_array($p)) {
                    $conexion->query(
                        "insert into despacho_producto(
                    num_despacho,
                    id_producto,
                    estado
                    
                    )values(
                    {$num_despacho},
                    {$producto['id_producto']},
                    'pendiente');"
                    );
                }



                // limpiar orden 
                $conexion->query("TRUNCATE TABLE factura_temp;");
                $conexion->query("TRUNCATE TABLE factura_producto_temp;");

                header('Location: despacho.php');

                // redirigir a impresión de comprobante [NO ES NECESARIO]
                $MENSAJE = "La orden de despacho se ha creado correctamente.";
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $MENSAJE; ?>
                </div>
            <?php
            }

            break;

        case 'marcar_completado':

            // tomar los registros de despacho_producto  y marcarlos todos como completados [COMPLETADO]
            $num_despacho = GetIsset('num_despacho');
            $conexion->query("UPDATE `despacho_producto` SET `estado` = 'completado' WHERE `despacho_producto`.`num_despacho` = {$num_despacho}; ");

            break;

        case 'modificar_producto':
            $id = GetIsset('id');

           /*  $codigo = GetIsset('codigo');
            $n = GetIsset('nombre');
            $c = GetIsset('cantidad');
            $p = GetIsset('precio'); */

            $nuevoCodigo = GetIsset('nuevoCodigo');
            $nuevoNombre = GetIsset('nuevoNombre');
            $nuevaCantidad = GetIsset('nuevaCantidad');
            $nuevoPrecio = GetIsset('nuevoPrecio');
            date_default_timezone_set("America/Bogota");
            $mifecha = date('Y-m-d');
           
           

           
                $i= 0;
                $consul =   $conexion->query(" SELECT * FROM `producto` WHERE producto.nombre = '{$nuevoNombre}'"); 
                while ($rco = mysqli_fetch_array($consul)) {
                    $i++;
                }
                if($i == 0){
                    // se establece el nuevo nombre
                   $conexion->query("   UPDATE `producto` SET `nombre` = '{$nuevoNombre}' WHERE `producto`.`id` = {$id}");
               }
            

            
                $i = 0;
                $consul =  $conexion->query(" SELECT * FROM `producto` WHERE producto.codigo = '{$nuevoCodigo}'"); 
                while ($rco = mysqli_fetch_array($consul)) {
                    $i++;
                }
                if($i == 0){
                    // se establece el nuevo nombre
                   $conexion->query("   UPDATE `producto` SET `codigo` = '{$nuevoCodigo}' WHERE `producto`.`id` = {$id}");
               }
            

                // se establece el nuevo precio
                $conexion->query(" UPDATE `producto` SET `precio` = {$nuevoPrecio} WHERE `producto`.`id` = {$id}");


                // para establecer la cantidad a 0
                $conexion->query(" DELETE FROM `stock_productos` WHERE stock_productos.id_producto = {$id}");

                // se inserta la nueva cantidad
                for ($i = 0; $i < $nuevaCantidad; $i++) {
                    $conexion->query(
                        "insert into stock_productos(
                        id_producto,
                        fecha_ingreso
                    
                        )values(
                        {$id},
                        {$mifecha}
                        );"
                    );
                }

                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo 'Exito al modificar el producto'; ?>
                </div>
            <?php


        break;
    }
}
