<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');
 
    if ( post_password_required() ) { ?>
        Este post está protegido por contraseña. Introduzca la contraseña para ver los comentarios.
    <?php
        return;
    }
?>
 
<?php if ( have_comments() ) : ?>
 
    <h4 id="comments"><?php comments_number('No hay Respuestas', 'Respuesta', '% Respuestas' );?></h4>
 
    <div class="navigation">
        <div class="next-posts"><?php previous_comments_link() ?></div>
        <div class="prev-posts"><?php next_comments_link() ?></div>
    </div>
 
    <ol class="commentlist fluid">
        <?php wp_list_comments(); ?>
    </ol>
 
    <div class="navigation">
        <div class="next-posts"><?php previous_comments_link() ?></div>
        <div class="prev-posts"><?php next_comments_link() ?></div>
    </div>
 
 <?php else : // this is displayed if there are no comments so far ?>
 
    <?php if ( comments_open() ) : ?>
        <!-- If comments are open, but there are no comments. -->
 
     <?php else : // comments are closed ?>
        <p>Los comentarios han sido cerrados</p>
 
    <?php endif; ?>
 
<?php endif; ?>
 
<?php if ( comments_open() ) : ?>
 
<div id="respond">
 
    <h4><?php comment_form_title( 'Responder', 'Responder a %s' ); ?></h4>
 
    <div class="cancel-comment-reply">
        <?php cancel_comment_reply_link(); ?>
    </div>
 
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <p>Debe de estar <a href="<?php echo wp_login_url( get_permalink() ); ?>">logueado</a> para comentar.</p>
    <?php else : ?>
 
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
 
        <?php if ( is_user_logged_in() ) : ?>
 
            <p>Logueado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Salir de esta cuenta">Cerrar Sesi&oacute;n »</a></p>
 
        <?php else : ?>
 
            <div class="form-group">
                <label for="author">Nombre <?php if ($req) echo "(requerido)"; ?></label>
                <input class="form-control" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
            </div>
 
            <div class="form-group">
                <label for="email">E-Mail (no ser&aacute; publicado) <?php if ($req) echo "(requerido)"; ?></label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
            </div>
 
            <div class="form-group">
                <label for="url">P&aacute;gina Web</label>
                <input class="form-control" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
                <label for="url"> </label>
            </div>
 
        <?php endif; ?>
 
        <!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->
 
        <div class="form-group">
            <textarea class="form-control" name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
        </div>
 
        <div class="form-group">
            <label for="url"> </label>
            <button name="submit" type="submit" id="submit" tabindex="5" class="btn btn-default">Enviar Comentario</button>
            
            <?php comment_id_fields(); ?>
        </div>
 
        <?php do_action('comment_form', $post->ID); ?>
 
    </form>
 
    <?php endif; // If registration required and not logged in ?>
 
</div>
 
<?php endif; ?>