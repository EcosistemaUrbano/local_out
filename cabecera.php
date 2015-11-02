	<?php

	//HEADERS

	if(is_home()) {	
	?>
		<header class="header" id="A" >
			<?php include (TEMPLATEPATH . '/menu.php'); ?>	
				<div class="vidBg">
					<video autoplay loop="loop" poster="<?php echo get_template_directory_uri();?>/images/headerImage.jpg" id="bgvid">
						<!--<source src="<?php echo get_template_directory_uri();?>/images/headerVid.mp4" type="video/mp4">-->
					</video>
				</div>
		</header>
	<?php
	}else {
	?>
		<header class="header" id="B" >
			<?php include (TEMPLATEPATH . '/menu.php'); ?>
			<div class="headImg">
				<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
			</div>
		</header>
	<?php
	}	
	?>
