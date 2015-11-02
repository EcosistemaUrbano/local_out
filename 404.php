<?php 
/*
Template Name: Fichas Principales
*/	
get_header(); ?>
	<main>
		<?php query_posts('cat=-1'); ?>
		
		<div class="customContainer">
			<div class="container-fluid">
			&nbsp;
				<div class="row">
					<div class="col-lg-4">
						<img src="<?php echo get_template_directory_uri();?>/images/404.png" alt="404"/>
					</div>
					<div class="col-lg-8">
						<h2>¡PARECE QUE BUSCAS ALGO QUE NO EXISTE EN ESTA PÁGINA!</h2>
					</div>
				</div>
				<div class="row">				
					<div class="col-lg-8">
						<p>Puedes intentar conseguir lo que buscas haciendo hacer uso de la caja de búsqueda.</p>
					</div>
					<div class="col-lg-4">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				</div>
			</div>			
		</div>

		<?php include (TEMPLATEPATH . '/localInAside.php'); ?>

	</main>
<?php get_footer(); ?>