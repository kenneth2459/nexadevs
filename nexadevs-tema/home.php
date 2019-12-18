<?php get_header(); ?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 padding-top-lg">
				<h1 id="">
					Registrate al app
				</h1>
				<hr />
				<?php

			if(isset($_POST['registrar'])) {
				$nombre               = $_POST['nombre'];
				$username             = $_POST['usuario'];
				$email                = $_POST['correo'];
				$password             = $_POST['password'];				

				if (username_exists($username)){
						$html = '<div class="alert alert-danger margin-top-md" role="alert">';
						$html .='<h3>Error de usuario</h3>';
						$html .= '<hr>';
						$html .='<p>¡El usuario ingresado ya existe!, por favor intente con otro nombre de usuario</p>';
						$html .= '</div>';
						echo $html;
					}elseif ( email_exists( $email )){
						$html = '<div class="alert alert-danger margin-top-md" role="alert">';
						$html .='<h3>Error de Correo</h3>';
						$html .= '<hr>';
						$html .='<p>¡El correo electrónico ingresado ya existe!, por favor intente con otro correo electrónico</p>';
						$html .= '</div>';
						echo $html;
				   }else{				
					nueva_suscripcion_kr( $nombre, $username, $password, $email);
				   	$ocultar='style="display:none;"';
				   } 
				}
			?>
			<div class="formulario" <?php echo (isset($ocultar))? $ocultar:''; ?> >
				<div class="text-center">¿Ya se ha suscrito? Inicie sesión <a href="http://localhost/nexa-devs-wp/wp-admin">aquí</a></div>
				<hr/>
				<form id="suscribe" method="post" class="margin-bottom-md">
					<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="form-group">
							<label for="nombre">Usuario:</label>
							<input type="text" name="usuario" class="form-control" id="usuario" required >
						</div>
						<div class="form-group">
							<label for="nombre">Nombre completo:</label>
							<input type="text" name="nombre" class="form-control" id="nombre" required >
						</div>
						<div class="form-group margin-top-md">
							<label for="correo">Correo electrónico:</label>
							<input type="email" name="correo" class="form-control" id="correo" required >
						</div>
						
						<div class="form-group margin-top-md">
							<label for="contrasena">Contraseña:</label>
							<input type="password" name="password" class="form-control" id="contrasena" required />
							<span id="helpBlock" class="help-block"> <small>Por favor ingrese una contraseña que sea de 6 o más caracteres.</small></span>
						</div>												
				
					<button id="registrar" type="registrar" name="registrar" class="btn btn-success">Registrar</button>

					</div>
					
					</div>
				</form>
			</div>
		</div>
	</div>
</section>






<?php get_footer(); ?>
