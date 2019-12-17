<?php get_header(); ?>


<div class="container">
	<div class="row">
		<div class="col-md-12 padding-top-lg padding-bottom-lg">
			<h1 id="">
				List
			</h1>
			<hr />
			<?php if(is_user_logged_in()){
			$user = wp_get_current_user();
			$user_id = $user->ID;
			showData($user_id);
			}else{
				echo 'Debes iniciar sesion';
			}
			?>
			
		</div>
	</div>
</div>




<?php get_footer(); ?>
