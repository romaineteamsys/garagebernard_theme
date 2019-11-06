<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ======

	Required external files

	========= */
define('VERSION', '2.0.3');

	require_once get_template_directory() . '/external/starkers-utilities.php';

  if ( ! file_exists( get_template_directory() . '/external/class-wp-bootstrap-navwalker.php' ) ) {
    // file does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
  } else {
    // file exists... require it.
    require_once get_template_directory() . '/external/class-wp-bootstrap-navwalker.php';
  }

	/* ======

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	========= */


	add_theme_support('post-thumbnails');

	function register_my_menu() {
	  register_nav_menus(
      array(
        'primary' => 'Navigation',
        'footer' =>  'Footer',
        'copyright' => 'Copyright',
      )
    );
	}
  add_action( 'init', 'register_my_menu' );  

  function eTeamsys_get_menu_items($menu_id) {
    
    $menu = [];

    $items =  wp_get_nav_menu_items($menu_id);
    foreach($items as $menuItem) {
        if($menuItem->menu_item_parent == 0){
          $menu[$menuItem->ID] = [
            'title' => $menuItem->title,
            'url'  => $menuItem->url,
            'id'    => $menuItem->ID,
            'type'  => $menuItem->type,
            'sublevel' => [],
          ];
        }
    }
    // echo "<pre>";
    // var_dump($items);
    // die();
    return $menu;
  }

  function get_nav_menu_item_children( $parent_id, $nav_menu_items, $depth = true ) {
    $nav_menu_item_list = array();
    foreach ( (array) $nav_menu_items as $nav_menu_item ) 
    {
      if ( $nav_menu_item->menu_item_parent == $parent_id ) 
      {
        $nav_menu_item_list[] = $nav_menu_item;
        if ( $depth ) 
        {
          if ( $children = get_nav_menu_item_children( $nav_menu_item->ID, $nav_menu_items ) )
          {
            $nav_menu_item_list = array_merge( $nav_menu_item_list, $children );
          }
        }
      }
    }
    // var_dump($nav_menu_item_list);
    return $nav_menu_item_list;
  }

  function ets_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'footer') {
      $classes[] = '';
    }
    if($args->theme_location == 'copyright') {
      $classes[] = '';
    }
    return $classes;
  }
  add_filter('nav_menu_css_class', 'ets_menu_classes', 1, 3);

  function ets_get_menu_by_location( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
  }

  /**
   * Register our sidebars and widgetized areas.
   *
   */
  function ets_widgets_init() {
    register_sidebar(
      array(
        'name'          => 'Footer newsletter widget',
        'id'            => 'newsletter',
        'before_widget' => '',
        'after_widget'  => ''
      )
    );
  }
  add_action( 'widgets_init', 'ets_widgets_init' );


	/* ======

	Actions and Filters

	========= */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ======

	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

  ========= */


	/* ========

	Scripts

	=========== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
    // jQuery script
		// wp_register_script( 'jquery', get_template_directory_uri().'/vendor/jquery/jquery.slim.min.js','', false, true );
		// wp_enqueue_script( 'jquery' );

    // Localize your script with server side data.
    global $sitepress;

    $data = [];


    // Bootstrap js
    wp_register_script( 'bootstrapjs', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.bundle.min.js', array( 'jquerymin'), VERSION, true );
    wp_enqueue_script( 'bootstrapjs' ); 

    // jquery js
    wp_register_script( 'jquerymin', get_template_directory_uri().'/vendor/jquery/jquery.min.js', '', VERSION, true );
    wp_enqueue_script( 'jquerymin' ); 

    // Main script
    wp_register_script( 'mainjs', get_template_directory_uri().'/assets/js/main.js', array( 'jquerymin' ), VERSION, true );
    wp_enqueue_script( 'mainjs' );

    wp_register_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDjX1ACEl--Sf_MwKg4WiOx-wEeghQL6ik&callback=initMap','', false, true );
    wp_enqueue_script( 'gmaps' );

    // AOS
		wp_register_script( 'AOS', 'https://unpkg.com/aos@next/dist/aos.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'AOS' ); 
    
    // Masonry
		wp_register_script( 'masonry', get_template_directory_uri().'/assets/js/masonry.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'masonry' ); 
    
    // imagesloaded
		wp_register_script( 'imagesloaded', get_template_directory_uri().'/assets/js/imagesLoaded.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'imagesloaded' ); 

    // lightbox
    wp_register_script( 'lightbox', get_template_directory_uri().'/assets/js/lightbox.min.js', array( 'jquery' ), VERSION, true );
    wp_enqueue_script( 'lightbox' );

    //slick
    wp_register_script( 'slick', get_template_directory_uri().'/vendor/slick/slick.js', array( 'jquerymin' ), VERSION, true );
    wp_enqueue_script( 'slick' );
    
    // pass Ajax Url to main.js and custom variables
    wp_localize_script('mainjs', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
    wp_localize_script( 'mainjs', 'util', $data );


    // Google Font stylesheet
    wp_register_style( 'googlefont', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic', '', '', 'screen' );
    wp_enqueue_style( 'googlefont' );

    // Font awesome css
    wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'fontawesome' );

    // Lightbox css
		wp_register_style( 'lightbox', get_stylesheet_directory_uri().'/assets/css/lightbox.min.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'lightbox' );

    // Slick css
    wp_register_style( 'slick', get_stylesheet_directory_uri().'/vendor/slick/slick.min.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'slick' );

    // Slick css
    wp_register_style( 'slicktheme', get_stylesheet_directory_uri().'/vendor/slick/slick-theme.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'slicktheme' );

    // AOS css
    wp_register_style( 'AOScss', get_template_directory_uri().'/assets/css/aos.min.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'AOScss' ); 

    // Main stylesheet
		wp_register_style( 'maincss', get_stylesheet_directory_uri().'/assets/css/main.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'maincss' );

    // WP Tiny MCE stylesheet
		wp_register_style( 'tinyMCE', '/wp-includes/js/tinymce/skins/wordpress/wp-content.css', '', VERSION, 'screen' );
    wp_enqueue_style( 'tinyMCE' );

	}

	/* =========

	Comments

	============ */

  // Disable support for comments and trackbacks in post types
  function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
      if(post_type_supports($post_type, 'comments')) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
      }
    }
  }
  add_action('admin_init', 'df_disable_comments_post_types_support');

  // Close comments on the front-end
  function df_disable_comments_status() {
    return false;
  }
  add_filter('comments_open', 'df_disable_comments_status', 20, 2);
  add_filter('pings_open', 'df_disable_comments_status', 20, 2);

  // Hide existing comments
  function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
  }
  add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

  // Remove comments page in menu
  function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
  }
  add_action('admin_menu', 'df_disable_comments_admin_menu');

  // Redirect any user trying to access comments page
  function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
      wp_redirect(admin_url()); exit;
    }
  }
  add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

  // Remove comments metabox from dashboard
  function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  }
  add_action('admin_init', 'df_disable_comments_dashboard');

  // Remove comments links from admin bar
  function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
      remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
  }
  add_action('init', 'df_disable_comments_admin_bar');

	/* ======

	Excerpt

	========= */

	function custom_excerpt_length( $length ) {
		return 15;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

  /**
  * Conditional function to check if post belongs to term in a custom taxonomy.
  *
  * @param    tax        string                taxonomy to which the term belons
  * @param    term    int|string|array    attributes of shortcode
  * @param    _post    int                    post id to be checked
  * @return             BOOL                True if term is matched, false otherwise
  */
  function pa_in_taxonomy($tax, $term, $_post = NULL) {
      // if neither tax nor term are specified, return false
      if ( !$tax || !$term ) { return FALSE; }
      // if post parameter is given, get it, otherwise use $GLOBALS to get post
      if ( $_post ) {
          $_post = get_post( $_post );
      } else {
          $_post =& $GLOBALS['post'];
      }
      // if no post return false
      if ( !$_post ) { return FALSE; }
      // check whether post matches term belongin to tax
      $return = is_object_in_term( $_post->ID, $tax, $term );
      // if error returned, then return false
      if ( is_wp_error( $return ) ) { return FALSE; }
      return $return;
  }

/************************************
**
**************************************/

add_filter('next_posts_link_attributes', 'get_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'get_previous_posts_link_attributes');

if (!function_exists('get_next_posts_link_attributes')){
    function get_next_posts_link_attributes($attr){
        $attr = 'rel="myrel" title="mytitle"';
        return $attr;
    }
}
if (!function_exists('get_previous_posts_link_attributes')){
    function get_previous_posts_link_attributes($attr){
        $attr = 'rel="myrel" title="mytitle"';
        return $attr;
    }
}

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

/*************************************************************
** Theme customization
**************************************************************/

$header_args = array(
  'width'         => 150,
  'height'        => 78,
  'flex-width'    => true,
  'flex-height'   => true,
  'header-text'   => false,
  'default-image' => get_template_directory_uri() . '/assets/img/logo.jpg',
  'uploads'       => true,
);
add_theme_support( 'custom-header', $header_args );

/** Allow SVG through WordPress Media Uploader */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/** Display svg thumbnail in the media library **/
function custom_admin_head() {
  $css = '';

  $css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';

  echo '<style type="text/css">'.$css.'</style>';
}
add_action('admin_head', 'custom_admin_head');

function include_svg($url){
	$svg = file_get_contents($url);
	$svg = preg_replace('/<!--(.|\s)*?-->/', '', $svg); // Strip comments in html
	$svg = preg_replace('/<\?(.|\s)*?\?>/', '', $svg); // Strip comments in html
	$doc = DOMDocument::loadHTML($svg);
	foreach($doc->getElementsByTagName('svg') as $image){
	    foreach(array('width', 'height', 'y', 'x') as $attribute_to_remove){
	        if($image->hasAttribute($attribute_to_remove)){
	            $image->removeAttribute($attribute_to_remove);
	        }
	    }
	}
	echo $doc->saveHTML();
}

/** Register more image sizes for responsive images */
function custom_image_setup() {
  add_image_size( 'xsml_size', 150 );
  add_image_size( 'sml_size', 650 , 480 , true );
  add_image_size( 'masonry', 400);
  add_image_size( 'blog', 300, 170, true);
  add_image_size( 'blog@2x', 600, 340, true);
  add_image_size( 'blog-mini', 96, 96, true);
  add_image_size( 'card-small', 200, 200, true);
  add_image_size( 'multi_block_size', 270 , 180 , true );
  add_image_size( 'small_block_size', 649 , 480 , true );
  add_image_size( 'large_block_size', 900 , 600 , true );
  add_image_size( 'quote_size', 192,192 , true );
  add_image_size( 'sup_size', 2400 );
  add_image_size( 'fullscreen', 1920 );
  add_image_size( 'banner', 1200, 600, true );
  add_image_size( 'contact-img', 330  );
}
add_action( 'after_setup_theme', 'custom_image_setup' );

add_filter( 'image_size_names_choose', 'my_custom_sizes' );
 
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'xsml_size' => 'Extra small (150px × auto)' ,
        'sml_size' => 'Small (300px × auto)' ,
        'mid_size' => 'Medium (600px × auto)' ,
        'lrg_size' => 'Large (1200px × auto)' ,
        'sup_size' => 'Extra Large (2400px × auto)' 
    ) );
}

// Sanitize file upload filenames
function sanitize_file_name_chars($filename) {

	$sanitized_filename = remove_accents($filename); // Convert to ASCII

	// Standard replacements
	$invalid = array(
		' '   => '-',
		'%20' => '-',
		'_'   => '-'
	);
	$sanitized_filename = str_replace(array_keys($invalid), array_values($invalid), $sanitized_filename);

	$sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
	$sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
	$sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
	$sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
	$sanitized_filename = strtolower($sanitized_filename); // Lowercase

	return $sanitized_filename;
}

add_filter('sanitize_file_name', 'sanitize_file_name_chars', 10);
/**********
ACF
**********/

// Add ACF Option page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( 
    array(
      'page_title' 	=> 'Options générales',
  		'menu_title' 	=> 'Options générales',
  		'redirect' 		=> false,
  		'icon_url' 		=> 'dashicons-info',
    )
  );
}

add_action('acf/init', 'my_acf_option_init');
function my_acf_option_init() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page( 
      array(
        'page_title'  => 'Options générales',
        'menu_title'  => 'Options générales',
        'redirect'    => false,
        'icon_url'    => 'dashicons-info',
      )
    );
  }  
}

// Display Yoast SEO box after all content elements
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

// Remove custom fields metabox for much faster admin page loading
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

// Change default height form ACF wysiwyg textareas & iframes
add_action('acf/input/admin_head', 'my_acf_admin_head');
function my_acf_admin_head() {
    ?>
    <style type="text/css">
      .acf-field-wysiwyg iframe, .acf-field-wysiwyg textarea{
        height: 150px !important;
        min-height: 150px !important;
      }

      .acf-field-5b1fe3c0c552e iframe, .acf-field-5b1fe3c0c552e textarea{
        height: 50px !important;
        min-height: 50px !important;
      }

      .acf-flexhibitorle-content .layout .acf-fc-layout-handle {
        /*background-color: #00B8E4;*/
        background-color: #505458;
        color: #F1F1F1;
      }

      .acf-repeater.-row > table > tbody > tr > td,
      .acf-repeater.-block > table > tbody > tr > td {
        border-top: 2px solid #202428;
      }

      .acf-repeater .acf-row-handle {
        vertical-align: top !important;
        padding-top: 16px;
      }

      .acf-repeater .acf-row-handle span {
        font-size: 20px;
        font-weight: bold;
        color: #202428;
      }

      .imageUpload img {
        width: 75px;
      }

      .acf-repeater .acf-row-handle .acf-icon.-minus {
        top: 30px;
      }
    </style>
    <?php    
}


// Quick fix for WPML language switcher width in admin pages 
add_action('admin_head', 'admin_styles');
function admin_styles() {
  ?>
  <style>
    select{
      width: auto;
    }
  </style>
  <?php
}

/**********
Count views for posts
**********/

function ets_set_post_views($postID) {
    $count_key = 'ets_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function ets_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    ets_set_post_views($post_id);
}
add_action( 'wp_head', 'ets_track_post_views');

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// numbered pagination
function ets_pagination($pages = '', $range = 4)
{  
  $showitems = ($range * 2)+1;  

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '')
  {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages)
    {
      $pages = 1;
    }
  }   

  if(1 != $pages)
  {
    echo '<div class="pagination">';
    if($paged - 1 != 0) {
      echo '<a href="'.get_pagenum_link($paged - 1).'">&laquo;</a>';
    }
    echo ' Page '.$paged;
    if($paged < $pages) {
      echo '<a href="'.get_pagenum_link($paged + 1).'">&raquo;</a></div>';
    }
     
    // echo '<ul class="list-group-horizontal list-unstyled mt-5 pagination justify-content-center">';
    // if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class=\"list-group-item\"><a href='".get_pagenum_link(1)."'>&laquo; &laquo;</a></li>";
    // if($paged > 1 && $showitems < $pages) echo "<li class=\"list-group-item\"><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

    // for ($i=1; $i <= $pages; $i++)
    // {
    //   if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
    //   {
    //     echo ($paged == $i)? "<li class=\"list-group-item active\"><a href='#' style='pointer-events: none; cursor: default;'>".$i."</a></li>":"<li class=\"list-group-item\"><a href=\"".get_pagenum_link($i)."\">".$i."</a></li>";
    //   }
    // }

    // if ($paged < $pages && $showitems < $pages) echo "<li class=\"list-group-item\"><a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a></li>";  
    // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class=\"list-group-item\"><a href='".get_pagenum_link($pages)."'>&rsaquo; &raquo;</a></li>";
    // echo "</ul>\n";
  }
}



add_filter( 'wp_nav_menu_objects', 'add_has_children_to_nav_items' );

function add_has_children_to_nav_items( $items )
{
    $parents = wp_list_pluck( $items, 'menu_item_parent');

    foreach ( $items as $item ){
      $item->has_children = "0";
      if(in_array( $item->ID, $parents )){
        $item->has_children = '1';
      }
    }        

    return $items;
}

function get_url_for_language( $postId )
{
    $current_site = get_permalink($postId);
    return apply_filters( 'wpml_permalink', $current_site , get_locale() , true);

}

/**********
Formats for the editor WYSIWYG
 **********/

//add custom styles to the WordPress editor
function my_custom_styles($init_array)
{

  $style_formats = array(
        // These are the custom styles
        array(
            'title' => 'Texte en petit',
            'selector' => 'p',
            'classes' => 'content__size--small',
        ),
  );
    // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode($style_formats);

  return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter('tiny_mce_before_init', 'my_custom_styles');

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

// add action for logged in users
add_action('wp_ajax_ets_repeater_show_more', 'ets_repeater_show_more');
// add action for non logged in users
add_action('wp_ajax_nopriv_ets_repeater_show_more', 'ets_repeater_show_more');

function ets_repeater_show_more() {
  // validate the nonce
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'acf_repeater_field_nonce')) {
    exit;
  }
  // make sure we have the other values
  if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
    return;
  }
  $show = 9; // how many more to show
  $start = $_POST['offset'];
  $end = $start+$show;
  $post_id = $_POST['post_id'];
  // use an object buffer to capture the html output
  // alternately you could create a varaible like $html
  // and add the content to this string, but I find
  // object buffers make the code easier to work with
  // ob_start();
  $content = '';
  if (have_rows('realisations', $post_id)) {
    $total = count(get_field('realisations', $post_id));
    $count = 0;
    while (have_rows('realisations', $post_id)) {
      the_row();
      if ($count < $start) {
        // we have not gotten to where
        // we need to start showing
        // increment count and continue
        $count++;
        continue;
      }
      $image = get_sub_field('image');
      $title = get_sub_field('title');
      $subtitle = get_sub_field('subtitle');
      $description = get_sub_field('description');
      $content .= '<div class="grid-item"><a href="'. $image['url'] .'" data-lity><img src="'.$image['url'].'" class="img-fluid"/><div class="hover-description"><h4>'.$title.'</h4><h5>'.$subtitle.'</h5></div><div class="hovering-description"><h4>'.$title.'</h4><h5>'.$subtitle.'</h5><p>'.$description.'</p></div></a></div>';
      ?>
      <?php 
      $count++;
      if ($count == $end) {
        // we've shown the number, break out of loop
        break;
      }
    } // end while have rows
  } // end if have rows
  // $content = ob_get_clean();
  // check to see if we've shown the last item
  $more = false;
  if ($total > $count) {
    $more = true;
  }
  // output our 3 values as a json encoded array
  header('Content-type: application/json');
  echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
  exit;
} // end function ets_repeater_show_more

// Get Relevanssi to display excerpts from your custom fields
add_filter('relevanssi_excerpt_content', 'custom_fields_to_excerpts', 10, 3);
function custom_fields_to_excerpts($content, $post, $query) {

  $content = '';

  $fields = get_field('page_builder', $post->ID);
  if($fields){
    foreach($fields as $custom_field){
      // $content .= " " . $custom_field['title'];
      if($custom_field['acf_fc_layout'] == 'two_column_content'){

        $content .= " " . $custom_field['title'];
        $content .= " " . $custom_field['subtitle'];

        $content .= " " . $custom_field['left_column']['title'];
        foreach($custom_field['left_column']['contents'] as $contentLeft){
          $content .= " " . $contentLeft['content_title'];
          $content .= " " . $contentLeft['content'];
        }
        
        $content .= " " . $custom_field['right_column']['title'];
        foreach($custom_field['right_column']['contents'] as $contentRight){
          $content .= " " . $contentRight['content_title'];
          $content .= " " . $contentRight['content'];
        }

      } elseif($custom_field['acf_fc_layout'] == 'custom_block'){

        $content .= " " . $custom_field['wysiwyg'];

      } elseif($custom_field['acf_fc_layout'] == 'featured_content'){

        $content .= " " . $custom_field['title'];
        $content .= " " . $custom_field['subtitle'];
        $content .= " " . $custom_field['content'];

      } elseif($custom_field['acf_fc_layout'] == 'content_cta'){

        $content .= " " . $custom_field['title'];
        $content .= " " . $custom_field['description'];

      } elseif($custom_field['acf_fc_layout'] == 'catalogue'){
        
        $content .= " " . $custom_field['title'];
        $content .= " " . $custom_field['intro'];
        
      }
    }
  }

  $content .= " " . get_field('product_name');
  if(get_field('actual_price')) {
    $content .= " " . get_field('actual_price') . "€";
  }
  if(get_field('original_price')) {
    $content .= " " . get_field('original_price') . "€";
  }
  $content .= " " . get_field('brand');
  $content .= " " . get_field('description');

  $content .= " " . get_field('city');
  $content .= " " . get_field('street');

  return $content;
}

/**
 * Register a private 'Genre' taxonomy for post type 'book'.
 *
 * @see register_post_type() for registering post types.
 */
function ets_register_private_taxonomy()
{
  $args = array(
    'label' => 'Menu Tag',
    'public' => true,
    'rewrite' => false,
    'hierarchical' => false,
    'show_admin_column' => true
  );

  register_taxonomy('menutag', array('megamenu'), $args);
}
add_action('init', 'ets_register_private_taxonomy', 0);

require_once('types/megamenu.php');
add_action( 'wp_footer', 'mycustom_wp_footer' );
 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '5' == event.detail.contactFormId || '1507' == event.detail.contactFormId) {
        dataLayer.push({'event': 'contact-send'});
    }
}, false );
</script>
<?php
}


add_filter('use_block_editor_for_post_type', 'ets_disable_wp_visual_editor');
function ets_disable_wp_visual_editor($use_block_editor) {
  return false;
}