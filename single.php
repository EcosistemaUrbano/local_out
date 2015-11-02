<?php 
/*
Template Name: -POST-
*/	
get_header(); ?>

<main>

	<article class="customContainer">
		<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			</br>
			<h3><?php the_title();?></h3>
			</br>
			<figure class="postImage">
				<?php the_post_thumbnail();?>
			</figure>
			</br>	
			<article class="customContainer" id="parrafo">
				<?php the_content();?>
			</article>

			<section class="customContainer">
				</br>
				<p><a href="javascript:javascript:history.go(-1)" rel="home"><i class="fa fa-arrow-left"></i> Regresar</a> | <?php the_tags();?> </p>
				</br>
				<div class="customContainer fluid">
					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
					?>
				</div>
			</section>								
					
		<?php endwhile; else: ?>
			   <h3>Aun no existen posts</h3>
		<?php endif; ?>
	</article>

</main>

<?php get_footer();?>