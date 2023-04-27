<?php
include 'templates/head.php';
?>
<div class="row  m-5">

	
	<div class="col-12 border p-3 bg-light ">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class=" form-group" name="login">
			<div class="mb-4">
				<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
			</div>

			<div>

				<input type="password" name="password" class="password_btn form-control" placeholder="Contraseña"><br><br>
				<button type="button" class="btn btn-outline-success" onclick=" login.submit()">Iniciar Sesion</button>
			</div>

			<!--Mensaje de error -->
			<?php if (!empty($errores)) : ?>
				<div>
					<ul>
						<?php echo ("<p ><strong>{$errores}</strong></p>"); ?>
					</ul>
				</div>
			<?php endif; ?>

		</form>
		<div class="border p-3 mt-4">
			<p class="mt-3">
				<i>¿Aun no tienes cuenta?</i> <br>
				<a class="link-success" href="registrate.php">Registrate</a>
			</p>
		</div>


	</div>

</div>

<?php
include 'templates/foot.php';
?>