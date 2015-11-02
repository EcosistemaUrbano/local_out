<?php
/**
 * The main template file
 *
 */
get_header(); ?>

	<?php get_template_part( 'fichasEventos', get_post_format() ); ?>

<?php get_footer(); ?>


