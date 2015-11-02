<?php 
/*
Template Name: Fichas Principales
*/	
get_header(); ?>
	<main>

		<?php include "catMenu.php";?>

		<?php query_posts('cat=-1,-39'); ?>
		
		<div class="customContainer">
			<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php include "ficha.php";?>			

			<?php endwhile; else: ?>
				   <h3>En estos momentos no existen articulos</h3>
			<?php endif; ?>
		</div>

		<?php include (TEMPLATEPATH . '/localInAside.php'); ?>

	</main>
<?php get_footer(); ?>