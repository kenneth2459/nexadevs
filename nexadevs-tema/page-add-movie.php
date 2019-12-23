<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 padding-top-lg padding-bottom-lg">
			<h1 id="">
				Add movie 
			</h1>
			<hr />
		</div>
		<div class="col-md-12">
			<?php
			$array_nuevo = array(1,3,13,3);
			
			function arreglo($array_nuevo){
				
				if(count($array_nuevo) > count(array_unique($array_nuevo))){
				  $mensaje = "¡Hay repetidos!";
				}else{
				  $mensaje = "No hay repetidos";
				}
				
				echo $mensaje;
			}
			echo arreglo($array_nuevo);
			if(is_user_logged_in()){
			$user = wp_get_current_user();
			//echo $user->ID;
			
			if(isset($_POST['buscar'])) {
				//echo 'entro aquí';
			$buscar = $_POST['buscarNuevo'];
			echo $buscar;
			$json = file_get_contents('http://www.omdbapi.com/?S='.$buscar.'&apikey=5551c279');
			

			$data = json_decode($json,true);
			}else{
				//$str = preg_replace('~[^a-z0-9]+~i', '', '');
				$json = file_get_contents('http://www.omdbapi.com/?S=angel&apikey=5551c279');
			

				$data = json_decode($json,true);
			}//$data = $json;
			
			//var_dump($data);
			?>
			<div class="row">
				<div class="col-md-4">
					<form id="buscar" method="post" class="margin-bottom-md">
						<div class="form-group">
							<input type="text" class="form-control" name="buscarNuevo" />
						</div>
						<button id="buscar" type="buscar" name="buscar" class="btn btn-success">Buscar</button>
					</form>
				</div>
			</div>
			
			<?php
			$movies = $data;
			if(isset($_POST['guardar'])) {
				//echo "entro en el guardar";
				$id_user              = $_POST['user_ID'];
				$id_movie             = $_POST['imdbID'];
				$movie_title       	  = $_POST['title_movie'];
				$movie_year           = $_POST['year_movie'];
				$movie_poster         = $_POST['poster_movie'];
				
				insertarData($id_user, $id_movie, $movie_title, $movie_year, $movie_poster );
			}elseif(isset($_POST['eliminar'])){
				$id_user              = $_POST['user_ID'];
				$id_movie             = $_POST['imdbID'];
				eliminarData($id_user, $id_movie);
			}
			//echo "<pre>";
			//print_r($movies);
			/*foreach($movies as $movie){
				//print_r($movie[0]);
				foreach($movie as $movie_indepent){
					echo $movie_indepent['imdbID'] . '<br>';
					echo $movie_indepent['Title'] . '<br>';
				}
			}*/
			
			//print_r($movies['Title']);
			//print_r($movies['Year']);
			//print_r($movies['Poster']);
			
				?>
			<table class="table table-striped">
				<tr>
					<td>ID</td>
					<td>Título</td>
					<td>Año</td>
					<td>Poster</td>
					<td>Agregar</td>
					<td>Eliminar</td>
				</tr>
				<?php 
				foreach($movies as $movie){ ?>
					<?php 
					if (is_array($movie)) {
					foreach($movie as $movie_indepent){
						echo '<tr>';
						echo '<td>'.$movie_indepent['imdbID'] . '</td>';
						echo '<td>'.$movie_indepent['Title'] . '</td>';
						echo '<td>'.$movie_indepent['Year'] . '</td>';
						echo '<td><img class="img-fluid" src="'.$movie_indepent['Poster'] . '" /></td>';
					?>
					<td>
					<?php
						$user_id_comparation = $user->ID;
						$id_movie_comparation = $movie_indepent['imdbID'];
						//echo $user_id_comparation.' ';
						//echo $id_movie_comparation;
						 $array_data = showButton($user_id_comparation, $id_movie_comparation);
						 if (!empty($array_data)){
						 	echo '';
						 }else{
					?>
						<form id="agregar" method="post" class="margin-bottom-md">
							<input type="hidden" value="<?php echo $user->ID; ?>" name="user_ID" />
							<input type="hidden" value="<?php echo $movie_indepent['imdbID'] ?>" name="imdbID" />
							<input type="hidden" value="<?php echo $movie_indepent['Title'] ?>" name="title_movie" />
							<input type="hidden" value="<?php echo $movie_indepent['Year'] ?>" name="year_movie" />
							<input type="hidden" value="<?php echo $movie_indepent['Poster'] ?>" name="poster_movie" />
							<button id="guardar" type="guardar" name="guardar" class="btn btn-info">Guardar</button>
						</form>
					</td>
					<?php } ?>
					<td>
						<form id="eliminar" method="post" class="margin-bottom-md">
							<input type="hidden" value="<?php echo $user->ID; ?>" name="user_ID" />
							<input type="hidden" value="<?php echo $movie_indepent['imdbID'] ?>" name="imdbID" />
							<input type="hidden" value="<?php echo $movie_indepent['Title'] ?>" name="title_movie" />
							<input type="hidden" value="<?php echo $movie_indepent['Year'] ?>" name="year_movie" />
							<input type="hidden" value="<?php echo $movie_indepent['Poster'] ?>" name="poster_movie" />
							<button id="eliminar" type="eliminar" name="eliminar" class="btn btn-danger">Eliminar</button>
						</form>
					</td>
					</tr>
				<?php }
					}
					}
				?>
				<!--<tr>
					<td><?php echo $movies['imdbID'] ?></td>
					<td><?php echo $movies['Title'] ?></td>
					<td><?php echo $movies['Year'] ?></td>
					<td><img class="img-fluid" src="<?php echo $movies['Poster'] ?>" /></td>
					<td><?php foreach ($movies['Ratings'] as $rating){
						echo $rating['Source'].' '.$rating['Value']. '<br />';
					}?></td>
					
				</tr>-->
			</table>	
			<?php
			
			exit;
			
			}else{
				echo "no puede ver esta página hasta haber inciado sesión";
			}
			?>
		</div>
	</div>
</div>




<?php get_footer(); ?>
