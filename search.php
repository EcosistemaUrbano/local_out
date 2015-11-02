<?php
/**
 * RESULTADOS DE BUSQUEDA
 *
 */
 
get_header(); ?>

<main>
     <div class="customContainer">
        <?php if ( have_posts() ) : ?>
 
                <header>
                    &nbsp;
                    <p class="searchTitle"><i class="fa fa-search"></i> <?php printf( __( 'Artículos relacionados a: &#8220;%s&#8221;', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></p>
                </header>
 
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php include "ficha.php";?>
 
                <?php endwhile; ?>
 
            <?php else : ?>
 
                <header>
                    &nbsp;
                    <p class="searchTitle"><i class="fa fa-times"></i> <?php printf( __( 'No se han encontrado artículos con la palabra %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></p>
                </header>      
 
            <?php endif; ?>
    </div>
    <?php include (TEMPLATEPATH . '/localInAside.php'); ?>
</main>

<?php get_footer();?>
