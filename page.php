<?php
/*
Template Name: -PAGINAS- 
*/	
get_header(); ?>

<main>

	<article class="customContainer">
		<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
			<article class="customContainer" id="parrafo">
				</br>
				<?php the_content();?>
			</article>

			<section class="customContainer">
				</br>
				<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><i class="fa fa-arrow-left"></i> Regresar</a> </p>
				</br>
			</section>				
				
		<?php endwhile; else: ?>
			   <h3>Aun no existen posts</h3>
		<?php endif; ?>
	</article>

</main>

<?php get_footer();?>