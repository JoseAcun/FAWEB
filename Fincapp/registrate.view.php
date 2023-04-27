<?php
include 'templates/head.php';
?>
<div class="row">
	<div class="col-4 border p-3 bg-light">

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario form-group" name="login">
			<div class="form-group">
				<input type="text" name="usuario" class="usuario form-control" placeholder="Usuario">
			</div>

			<div>
				<input type="password" name="password" class="password form-control" placeholder="Contraseña">
			</div>

			<div class="form-group">
				<input type="password" name="password2" class="password_btn form-control" placeholder="Confirmar Contraseña"><br><br>
				<button type="button" class="btn btn-outline-success" onclick="login.submit()">Registrate</button>
			</div>


			<!--Mensaje de error -->
			<?php if (!empty($errores)) : ?>
				<div class="p-3 border mt-2 bg-white">
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		</form>
		<div class="border p-3 mt-4">
			<p class="mt-3">
				<i>¿Ya tienes cuenta?</i> <br>
				<a class="link-success" href="login.php">Iniciar Secion</a>
			</p>
		</div>
	</div>
</div>

<?php


include 'templates/foot.php';
?>