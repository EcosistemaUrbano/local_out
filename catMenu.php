<?php
		
	$filter_out = "<div class='customContainer' id='categories'>";

	foreach ( get_categories() as $categ ) {
		$cat_id = $categ->term_id; //get cat id EXCLUDE SIN CATEGORIA
		if ($cat_id!=1 & $cat_id!=39) {
			
			$category_link = get_category_link( $cat_id ); //GET CAT URL USING PREVIOUS LINK
			$cat_perma = get_category_link($categ->term_id); //IMAGE OBTENTION
			$cat_meta = get_option( "taxonomy_$cat_id" );
			
			if ( is_array($cat_meta) ) {
				if ( array_key_exists('image',$cat_meta) && $cat_meta['image'] != '' ) {
					$cat_img = $cat_meta['image'];
				}
			}

			$categImg = "<img src='" .$cat_img. "' alt='" .$categ->name. "' />";
			
			$filter_out .= "<a" .$filter_class. " href='" .$category_link. "' title='" .$categ->name. "'>$categImg</a>";
		}
		
		
	}

	$filter_out .= "</div><!-- end class mess-cats -->";
	echo $filter_out;
?>
