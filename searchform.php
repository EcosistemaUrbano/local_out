<?php
/*
 * The template for displaying search forms in Shape
 */
?>
	<div class="formContainer">
		<form class="form-inline" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		  <div class="form-group">
		    <input type="text" class="field form-control" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Buscar &hellip;', 'shape' ); ?>" />
		  </div>
		</form>

	</div>
