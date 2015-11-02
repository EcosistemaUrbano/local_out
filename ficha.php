	<a href="<?php the_permalink();?>">
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );?>
		<section id="tag" style="background: url('<?php echo $thumb['0'];?>'), bottom no-repeat; background-size: cover;-moz-background-size: cover;background-position:right;-o-background-size: cover;-webkit-background-size: cover;">
			<div id="infoTag">
				<h4><?php the_title();?></h4>
				<h5><?php the_meta(); ?></h5>
			</div>
		</section>
	</a>





				