<div class="customContainer fluid" id="logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri();?>/images/logo.svg" alt="LOGO" /></a>
</div>

<nav class="navbar navbar-default" id="topNavi">
		 <div class="container-fluid">
		   <!-- Brand and toggle get grouped for better mobile display -->
		   <div class="navbar-header">
		     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		       <span class="sr-only">Toggle navigation</span>
		       <span class="icon-bar"></span>
		       <span class="icon-bar"></span>
		       <span class="icon-bar"></span>
		     </button>
		     <p class="headTitle">PLAN ENCARNACIÓN&#43; IMAGINANDO UN FUTURO URBANO SUSTENTABLE</p>
		    
		   </div>

		   <!-- Collect the nav links, forms, and other content for toggling -->
		   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      
		     <ul class="nav navbar-nav navbar-right">
		       <li><a href="<?php echo get_permalink( get_page_by_path( 'about' ) ) ?>"><p> <span>Acerca de</span></p></a></li>
		       <li><a href="<?php echo get_permalink( get_page_by_path( 'contact' ) ) ?>"><p> <span>Contáctanos</span></p></a></li>	        
		       <li class="dropdown">
		         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><p><i class="fa navIcon fa-search fa-lg"></i></p></a>
		         <ul class="dropdown-menu">
		           <li>
			            <?php dynamic_sidebar( 'sidebar-1' ); ?> <!--SEARCH BAR-->
		           </li>
		         </ul>
		       </li>
		     </ul>
		   </div><!-- /.navbar-collapse -->
		 </div><!-- /.container-fluid -->
</nav>


<nav class="customContainer fluid bottom">
	<?php wp_nav_menu(
		array(
			'container'=>false,
			'items_wrap'=> '<ul class="mainNavi">%3$s</ul>',
			'theme_location'=>'mainMenu'
		));
	?>
</nav>