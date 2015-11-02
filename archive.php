<?php 

get_header(); ?>

	<main>
		<?php include "catMenu.php";?>
		<div class="customContainer">
			
			<?php include "catDescp.php";?>

			<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php include "ficha.php";?>			

			<?php endwhile; else: ?>
				   <h3>En estos momentos no existen articulos</h3>
			<?php endif; ?>
		</div>
		
		
	</main>

<?php get_footer(); ?>

