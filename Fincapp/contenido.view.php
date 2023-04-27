<?php
include 'templates/head.php';
include 'conexion.php';
include 'orden.php';


?>


<div class="row mt-4">


	<!-- Button trigger modal -->
	<div>
		<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" aria-disabled="true" data-bs-target="#exampleModal">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
				<path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
			</svg> <i> Nuevo producto</i>
		</button>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nuevo producto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="col-12 border border-dark ">
						<form action="nuevoProducto.php" method="post">

							<div class="form-group p-3">

								<input type="number" class="form-control " name="codigoProducto" id="" aria-describedby="helpId" placeholder="codigo producto" required>
								<input type="text" class="form-control" name="nombreProducto" id="" aria-describedby="helpId" placeholder="nombre del producto" required>
								<input type="number" class="form-control" name="precio" id="" aria-describedby="helpId" placeholder="precio" required>
							</div>



							<div class="form-group mt-4 mb-4 p-3">
								<button type="submit" name="boton" value="crear" class="btn btn-outline-success">Crear producto</button>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
					
				</div>
			</div>
		</div>
	</div>


</div>
<div class="responsive">
	<style>
		.table-scrollable {
			overflow-y: scroll;
			min-height: 300px;
			max-height: 500px;
		}
	</style>

	<script type="text/javascript">
		$(Buscar_datos());

		function Buscar_datos(consulta) {
			$.ajax({

					url: 'buscar.php',
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

		$(document).on('keyup', '#caja_busqueda', function() {
			var valor = $(this).val();
			if (valor != "") {
				Buscar_datos(valor);
			} else {
				Buscar_datos();
			}
		});
	</script>

	<div class="mt-4 mb-4 w-50 col-12">
		<div class="input-group ">

			<span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
					<path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z" />
					<path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z" />
				</svg></span>
			<input type="text" placeholder="nombre o código" class="form-control" name="caja_busqueda" id="caja_busqueda"></input>

		</div>
	</div>




</div>

<div id="datos" class="col-sm-12 ">

</div>





<?php
include 'templates/foot.php';
?>