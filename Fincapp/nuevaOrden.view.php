<?php
include 'templates/head.php';
include 'conexion.php';
include 'orden.php';
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: login.php');
} else {
	$count = 0;
	$verifi = $conexion->query("select * from factura_producto_temp");
	while ($val = mysqli_fetch_array($verifi)) {
		$count++;
	}

?>




	<style>
		.table-scrollable {
			overflow-y: scroll;
			min-height: 300px;
			max-height: 500px;
		}
	</style>

	<script type="text/javascript">
		$(Buscar_datos_orden());

		function Buscar_datos_orden(consulta) {
			$.ajax({

					url: 'buscar_orden.php',
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

		$(document).on('keyup', '#caja_busqueda_orden', function() {
			var valor = $(this).val();
			if (valor != "") {
				Buscar_datos_orden(valor);
			} else {
				Buscar_datos_orden();
			}
		});
	</script>
	<div class="row w-50">
		<div class=" col-6 input-group mb-2 mt-4">
			<form action="" method="post">

				<button type="submit" name="accionBoton" value="descuento_boton" class="btn btn-outline-primary">Descuento</button>
				<input type="number" name="descuento" id="descuento" placeholder="Descuento" value=0>

			</form>
		</div>

		<div class=" col-6 input-group">
			<span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
				</svg></span>
			<input type="text" placeholder="nombre o código" class="" name="caja_busqueda_orden" id="caja_busqueda_orden"> </input>
		</div>
	</div>


	<div class="row mt-4 mb-4">
		<div id="datos" class="col-12">
		</div>

		<style>
			.table-scrollable {
				overflow-y: scroll;
				max-height: 350px;
			}
		</style>

		<div class="col-12 ">

			<!-- eliminar -->

			<?php

			if ($count > 0) {

			?>
		</div>


		<div class="col-12 mb-3">

			<div class="table-responsive border border-dark p-3  table-scrollable">

				<p>
				<p><i>N° ORDEN:</i> <strong><?php
											$ord = $conexion->query("select * from factura_temp ");
											$rOrd = mysqli_fetch_array($ord);
											echo $rOrd['num_factura'];
											?></strong></p> <i>Descuento actual:</i> <strong>$<?php
																								$des = $conexion->query("SELECT * FROM `factura_temp`;");
																								$rdes = mysqli_fetch_array($des);
																								echo $rdes['descuento'];
																								?></strong></p>
				<p><strong> <i>Productos del pedido</i></strong></p>
				<table class="table table-dark table-striped table-bordered ">

					<tr>
						<th>cod</th>
						<th>nombre</th>
						<th>cantidad</th>
						<th>SUBTOTAL</th>
						<th></th>

					</tr>


					<?php

					$consultaProducto = $conexion->query("select * from producto");

					while ($r = mysqli_fetch_array($consultaProducto)) {

						$cantidad = 0;
						$r_id = $r['id'];
						$consultarCantidad = $conexion->query("select * from factura_producto_temp  where id_producto = {$r_id}");
						while ($s = mysqli_fetch_array($consultarCantidad)) {
							$cantidad++;
						}
					?><tr>
							<form action="" method="post" class="form-group">

								<input type="hidden" name="id" id="id" value="<?php echo $r['id'];  ?>">
								<input type="hidden" name="nombre" id="nombre" value="<?php echo $r['nombre'];  ?>">
								<!-- 	<input type="hidden" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>"> -->
								<input type="hidden" name="precio" id="precio" value="<?php echo  $r['precio']; ?>">

								<?php


								if ($cantidad > 0) {
								?>
									<td><?php echo $r['codigo']; ?></td>
									<td><?php echo $r['nombre']; ?></td>
									<td><?php echo $cantidad;    ?></td>
									<td><?php echo  number_format($r['precio'] * $cantidad); ?></td>
									<td>

										<!-- 	VERIFICAR SI LA CANTIDAD A eliminar NO es menor a 0  -->


										<button class="btn btn-outline-danger" type="submit" name="accionBoton" value="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-x" viewBox="0 0 16 16">
												<path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z" />
												<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
											</svg></button>
									</td>
								<?php
								} else {
								?>




								<?php
								}
								?>


							</form>

						</tr>


					<?php
					}

					?>

				</table>
			<?php } ?>

			</div>


		</div>


		<?php
		if ($count > 0) {
		?>

			<div class="col-6">

				<form action="" method="post">
					<button class="btn btn-outline-danger " type="submit" name="accionBoton" value="clear"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
							<path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z" />
						</svg></button>
				</form>

			</div>
			<div class="col-6">

				<!-- Button trigger modal -->
				<button type="button" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#exampleModal">
					Completar orden
				</button>
				<?php ?>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Resumen de orden N° <strong><?php echo $rOrd['num_factura']; ?></strong> </h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php

								$sentence = $conexion->query("SELECT * FROM `factura_producto_temp`");



								?>
								<div class="table-responsive border border-dark p-3 table-scrollable">
									<table class="table table-striped table-bordered">


										<th>Código</th>
										<th>Nombre</th>
										<th>Precio</th>

										<?php

										$total = 0;
										while ($respuesta = mysqli_fetch_array($sentence)) {

										?>
											<tr>
												<?php
												$consult = $conexion->query("select * from producto where id = {$respuesta['id_producto']}");
												while ($result = mysqli_fetch_array($consult)) {
												?>
													<td> <?php echo $result['codigo']; ?> </td>
													<td> <?php echo $result['nombre']; ?> </td>
													<td> $<?php echo number_format($result['precio']); ?> </td>

												<?php
													$total += $result['precio'];
												}
												?>
											</tr>

										<?php
										}
										?>
										<tr>
											<th colspan="2">SUBTOTAL</th>
											<th>$<?php echo  number_format($total); ?></th>
										</tr>
										<tr>
											<th colspan="2">DESCUENTO</th>
											<th>$<?php
													$des = $conexion->query("SELECT * FROM `factura_temp`;");
													$rdes = mysqli_fetch_array($des);
													echo number_format($rdes['descuento']); ?>
											</th>
										</tr>
										<tr>
											<th colspan="2">TOTAL</th>
											<th>$<?php echo  number_format($total - $rdes['descuento']); ?></th>
										</tr>
									</table>
								</div>
								<?php

								?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
										<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
									</svg></button>


								<form action="nuevoDespacho.php" method="post">
									<?php
									$c = $conexion->query("select * from factura_temp");
									$s = mysqli_fetch_array($c);

									?>
									<input type="hidden" name="num_orden" id="num_orden" value="<?php echo $s['num_factura']; ?>">
									<button class="btn btn-outline-success" type="submit" name="accionBoton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
											<path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
										</svg></button>

								</form>
								<form action="" method="post">
									<button class="btn btn-outline-success" type="submit" name="accionBoton" value="completar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
											<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
										</svg></button>

								</form>
							</div>
						</div>
					</div>
				</div>

			</div>

	</div>


<?php
		}
	}
	include 'templates/foot.php';
?>