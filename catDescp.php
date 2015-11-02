<div class="catDesc">
	<div class="catBox" id="catImg">
		<?php
			$t_id = get_queried_object()->term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$imgURL = $term_meta['image'];
									
			$categImg = "<img src='" .$imgURL. "' alt='" .$categ->name. "' />";
			echo $categImg;
		?>
	</div>
	<div class="catBox" id="desc">
		<?php echo category_description(); ?>
	</div>
</div>