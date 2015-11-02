<?php 
		// theme setup main function
		add_action( 'after_setup_theme', 'abierto_setup' );
		function abierto_setup() {
			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
			) );
			// Setup the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
				'default-color'      => $default_color,
				'default-attachment' => 'fixed',
			) ) );
			//load_theme_textdomain( 'abierto', get_template_directory() . '/languages' );// languages
			add_action( 'wp_enqueue_scripts', 'abierto_scripts' );//scripts load
			add_theme_support( 'post-thumbnails', array( 'post','page') );// adds thumbnail support
			set_post_thumbnail_size( 850, 400 );
			add_theme_support( 'automatic-feed-links' ); // RSS and Feed
			add_filter( 'show_admin_bar', '__return_false' ); // do not show admin bar
			add_action( 'init', 'abierto_register_menus' );// menus registering
			add_theme_support( 'custom-header', $header );// custom WP header
			// Save category extra field callback function
			add_action( 'edited_category', 'abierto_save_category_extra_field', 10, 2 );  
			add_action( 'create_category', 'abierto_save_category_extra_field', 10, 2 );
			// Add extra field to edit category form
			add_action( 'category_edit_form_fields', 'abierto_edit_category_extra_field', 10, 2 );
			// Add extra field to add category form
			add_action( 'category_add_form_fields', 'abierto_new_category_extra_field', 10, 2 );
			// add image column to admin categories list
			add_filter("manage_edit-category_columns", 'abierto_category_columns');
			// populate image column in admin categories list
			add_filter("manage_category_custom_column", 'abierto_fill_category_columns', 10, 3);
			// create theme custom content
			add_action( 'load-themes.php', 'abierto_create_custom_content' );					
		}// END OF THEME SETUP
		//Script Loader
				function abierto_scripts() {
				    wp_enqueue_style( 'style', get_stylesheet_uri() );
				    wp_enqueue_script('jquery');				       
				}
				
		//ALLOWS WP TO ACCEPT SVG IMAGE FORMAT
			add_filter('upload_mimes', 'my_upload_mimes');
			function my_upload_mimes($mimes = array()) {
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
			}
		/**
		 * Add custom taxonomies
		 *
		 * Additional custom taxonomies can be defined here
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		function create_my_cat () {
		    if (file_exists (ABSPATH.'/wp-admin/includes/taxonomy.php')) {
		        require_once (ABSPATH.'/wp-admin/includes/taxonomy.php'); 
		        if ( ! get_cat_ID( 'Actividades' ) || ! get_cat_ID( 'Documentacion' ) ) {
		            wp_create_category( 'Actividades' );
		            wp_create_category( 'Documentacion' );
		        }
		    }
		}
		add_action ( 'after_setup_theme', 'create_my_cat' );
		/**
		 * Add taxonomies IMAGE Field
		 *
		 * Additional custom taxonomies can be defined here
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
			//CATEGORIES IMAGE CUSTOM FIELD
				// new fileds for categories
				$category_new_fields = array(
					array(
						'slug' => 'image',
						'field-tit' => __('Imagen de Categoria','abierto'),
						'field-desc' => __( 'Carga la imagen en la galeria de medios y agrega la URL completa en este campo.','abierto' ),
						'col-tit' => __('Image','abierto'),
					)	
				);
				// Add extra fields to add category form
				function abierto_new_category_extra_field() {
					global $category_new_fields;
					// this will add the custom meta field to the add new term page
					foreach ( $category_new_fields as $field ) { ?>
						<div class="form-field">
							<label for="term_meta[<?php echo $field['slug'] ?>]"><?php echo $field['field-tit'] ?></label>
							<input type="text" name="term_meta[<?php echo $field['slug'] ?>]" id="term_meta[<?php echo $field['slug'] ?>]" value="">
							<p class="description"><?php echo $field['field-desc'] ?></p>
						</div>
				<?php	}
				}
				// Add extra fields to edit category form
				function abierto_edit_category_extra_field($term) {
					global $category_new_fields;
					// put the term ID into a variable
					$t_id = $term->term_id;
					// retrieve the existing value(s) for this meta field. This returns an array
					$term_meta = get_option( "taxonomy_$t_id" );
					foreach ( $category_new_fields as $field ) {
						if ( array_key_exists($field['slug'], $term_meta) ) { $term_value = $term_meta[$field['slug']]; }
						else { $term_value = ""; } ?>
						<tr class="form-field">
							<th scope="row" valign="top"><label for="term_meta[<?php echo $field['slug'] ?>]"><?php echo $field['field-tit'] ?></label></th>
							<td>
								<input type="text" name="term_meta[<?php echo $field['slug'] ?>]" id="term_meta[<?php echo $field['slug'] ?>]" value="<?php echo esc_attr( $term_value ) ? esc_attr( $term_value ) : ''; ?>">
								<p class="description"><?php echo $field['field-desc'] ?></p>
							</td>
						</tr>
				<?php	}
				}
				// Save category extra fields callback function
				function abierto_save_category_extra_field( $term_id ) {
					if ( isset( $_POST['term_meta'] ) ) {
						$t_id = $term_id;
						$term_meta = get_option( "taxonomy_$t_id" );
						$cat_keys = array_keys( $_POST['term_meta'] );
						foreach ( $cat_keys as $key ) {
							if ( isset ( $_POST['term_meta'][$key] ) ) {
								$term_meta[$key] = $_POST['term_meta'][$key];
							}
						}
						// Save the option array
						update_option( "taxonomy_$t_id", $term_meta );
					}
				}  
				// add extra columns to admin categories list
				function abierto_category_columns($columns) {
					global $category_new_fields;
					foreach ( $category_new_fields as $field ) {
						$columns[$field['slug']] = $field['col-tit'];
					}
					return $columns;
				}
				// populate extra columns in admin categories list
				function abierto_fill_category_columns($out, $column_name, $cat_id) {
					global $category_new_fields;
					$cat = get_term($cat_id, 'category');
					foreach ( $category_new_fields as $field ) {
						if ($column_name == $field['slug'] ) {
							// get image from options table
							$term_meta = get_option("taxonomy_$cat_id");
							if ( is_array($term_meta) ) {
								if ( array_key_exists($field['slug'],$term_meta) && $term_meta[$field['slug']] != '' ) {
									$cat_img = $term_meta[$field['slug']];
									$out .= "<img src='" .$cat_img. "' height='40' />";
								}
							}
				   		}
				   	}
					return $out;
				}
		    //CATEGORIES
		//functions & media
			//menus
				function abierto_register_menus() {
					  register_nav_menus(
					    array(
					      'mainMenu' => __( 'Menu' )
					    )
					  );
					  $Menu_nav_menu_id = wp_create_nav_menu('Menu');
					  wp_update_nav_menu_item($primary_nav_menu_id, 0, array(
						    'menu-item-title' =>  __('Home'),
						    'menu-item-classes' => 'home',
						    'menu-item-url' => home_url( '/' ), 
						    'menu-item-status' => 'publish'
						));
					    $locations = get_theme_mod( 'nav_menu_locations' );
						$locations['Menu'] = $primary_nav_menu_id;
						set_theme_mod ( 'nav_menu_locations', $locations );
				}
			//menu setup
			//Excerpt length
				function exptLenght($length) {
					return 15;
				}
				add_filter('excerpt_length', 'exptLenght');
			// Home Page menu Link
				function hPageMenu( $mLink ) {
					$mLink['show_home'] = true;
					return $mLink;
				}
				add_filter( 'wp_page_menu_args', 'hPageMenu' );
			// Home Page menu Link
			//Custom header variable
				$header = array(
					'flex-width'    => true,
					'width'         => 1587,
					'flex-height'    => true,
					'height'        => 890,
					'default-image' => get_template_directory_uri() . '/images/headerImage.jpg',
				);
			//Widgets Area registering
				function abierto_widgets_init() {
					register_sidebar( array(
						'name'          => __( 'Search Bar', 'abierto' ),
						'id'            => 'sidebar-1',
						'description'   => __( 'Add search box widget', 'abierto' ),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					) );
					register_sidebar( array(
						'name'          => __( 'LocalIn Banner', 'abierto' ),
						'id'            => 'sidebar-2',
						'description'   => __( 'Add a text widget and write up the information for the localIn part of the project.', 'abierto' ),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					) );
				}
				add_action( 'widgets_init', 'abierto_widgets_init' );
				add_filter('widget_text', 'do_shortcode');
		//functions & media
/*** CUSTOM CONTENT FOR SETUP PAGES ***/
		// DEFINE PAGES PARAMETERS AND TEMPLATES
		function abierto_create_custom_content() {
			global $pagenow;
			$custom_contents = array(
				array(
					'title' => 'Acerca de',
					'slug' => 'about',
					'template' => 'page.php',
					'parent_slug' => '',
					'image' => ''
				),
				array(
					'title' => 'Contactanos',
					'slug' => 'contact',
					'template' => 'contact.php',
					'parent_slug' => '',
					'image' => ''
				),
				array(
					'title' => 'Documentacion',
					'slug' => 'documentacion',
					'template' => 'page.php',
					'parent_slug' => '',
					'image' => ''
				),
				array(
					'title' => 'Participa',
					'slug' => 'participa',
					'template' => 'page.php',
					'parent_slug' => '',
					'image' => ''
				)
			);
			// CREATE PAGES ONCE THEME IS ACTIVE
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){ // Test if theme is activate
				// Theme is activate
				foreach ( $custom_contents as $cc ) {
					if ($cc['parent_slug'] != '' ) { $parent_slug = trailingslashit($cc['parent_slug']); }
					else { $parent_slug = ''; }
					$page_exists = get_page_by_path($parent_slug.$cc['slug'],'ARRAY_N');
					if ( !is_array($page_exists) ) {
						$parent = get_page_by_path($cc['parent_slug'],'ARRAY_A');
						// insert post
						$page_id = wp_insert_post(array(
							'post_type' => 'page',
							'post_status' => 'publish',
							'post_author' => 1,
							'post_title' => $cc['title'],
							'post_name' => $cc['slug'],
							'post_parent' => $parent['ID'],
							'page_template' => $cc['template']
						));
						if ( $cc['image'] != '' ) { // if this content has image
							// do image insert
							$filename = $cc['image']; // image filename
							$filename = trim($filename); // removing spaces at the begining and end
							$filename = str_replace(" ", "-", $filename); // removing spaces inside the name
							$filename_url = ABIERTO_BLOGTHEME."images/".$filename;
							$attachment = wp_upload_bits( $filename, null, file_get_contents($filename_url), date("Y-m") );
							$uploadfile = $attachment['file'];
							$filetype = wp_check_filetype( basename( $uploadfile ), null );	
							$attachment_args = array(
								'post_mime_type' => $filetype['type'],
								'post_title' => $cc['title']." image",
								'post_content' => '',
								'post_status' => 'inherit'
							);
							$attach_id = wp_insert_attachment( $attachment_args, $uploadfile, $page_id );
							// you must first include the image.php file
							// for the function wp_generate_attachment_metadata() to work
							require_once(ABSPATH . "wp-admin" . '/includes/image.php');
							$attach_data = wp_generate_attachment_metadata( $attach_id, $uploadfile );
							wp_update_attachment_metadata( $attach_id,  $attach_data );
							// set this image as featured image
							set_post_thumbnail( $page_id, $attach_id );
						} // end if this content has image 
					} // end if this content doesn't exist
				} // end foreach contents array
			} else {
				// Theme is deactivate
			}
		}
// END create theme custom content
?>

