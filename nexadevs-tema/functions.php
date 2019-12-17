<?php

//Define constants
define('HOMELINK', site_url('/'));
define('PATH', get_template_directory_uri());
define('IMAGES', get_template_directory_uri()."/img" );
define('SITENAME', get_bloginfo('name') );


/*-----------------------------------------------------------------------------------------------*/
function verify_subscribe_user_kr($username, $email){
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
	}

}
/*
====================== SUSCRIPCIÓN NUEVA ========================= 
*/ 
function nueva_suscripcion_kr($nombre, $username, $password, $email ){
	
	$user_id = wp_create_user( $username, $password, $email );
	update_user_meta($user_id, 'first_name', $nombre );
	
	$html = '<div class="alert alert-success margin-top-md" role="alert">';
	$html .='<h3>Registro exitoso</h3>';
	$html .= '<hr>';
	$html .='<p>Gracias por registrarte ya puedes comenzar agregar tus peliculas favoritas.</p>';
	$html .='<p>Inicia sesión <a href="http://localhost/nexa-devs-wp/wp-admin">aquí</a>.</p>';
	$html .= '</div>';
	  	
	echo $html;
}

/*
====================== INSERTA DATA DE REGISTRO EN DB ========================= 
*/ 
function insertarData($id_user, $movie_title, $movie_year, $movie_poster ){
	global $wpdb;
	
	 $data = array(
      "id_user"         		=> $id_user,
      "titulo_movie"         	=> $movie_title,
      "an_movie"       			=> $movie_year,
      "movie_poster"       		=> $movie_poster,
    );
	$table = "webmedia_user_movies";
	
  $query_exist = $wpdb->get_results(" SELECT * 
	        FROM webmedia_user_movies WHERE titulo_movie = '$movie_title'");
	if ($query_exist){
		$html = '<div class="alert alert-danger margin-top-md" role="alert">';
		$html .='<h3>Error</h3>';
		$html .= '<hr>';
		$html .='<p>Esta película ya existe entre tus favoritas.</p>';
		$html .= '</div>';
		  	
		echo $html;
	}else{
		$wpdb->insert($table, $data);
	  	$html = '<div class="alert alert-success margin-top-md" role="alert">';
		$html .='<h3>Agregado exitosamente</h3>';
		$html .= '<hr>';
		$html .='<p>Se ha agregado su pelicula exitosamente.</p>';
		$html .= '</div>';
		  	
		echo $html;
	}

}
function eliminarData($id_user){
	global $wpdb;
	
	 $data = array(
      "id_user"         		=> $id_user,
    );
	$table = "webmedia_user_movies";
	
  
  $wpdb->delete( $table, $data);
  $html = '<div class="alert alert-success margin-top-md" role="alert">';
	$html .='<h3>Eliminado</h3>';
	$html .= '<hr>';
	$html .='<p>Se ha eliminado su película de sus favoritos.</p>';
	$html .= '</div>';
	  	
	echo $html;

}


?>