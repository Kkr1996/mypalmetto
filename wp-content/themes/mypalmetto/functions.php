<?php
/**
 * MyCatawba functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MyCatawba
 */

if ( ! function_exists( 'mycatawba_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mycatawba_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MyCatawba, use a find and replace
		 * to change 'mycatawba' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mycatawba', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'Main Menu' => esc_html__( 'Primary', 'mycatawba' ),
		) );
        register_nav_menus( array(
			'Footer' => esc_html__( 'Footer', 'mycatawba' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mycatawba_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mycatawba_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mycatawba_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mycatawba_content_width', 640 );
}
add_action( 'after_setup_theme', 'mycatawba_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mycatawba_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mycatawba' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mycatawba' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Description', 'mycatawba' ),
		'id'            => 'footer-desc',
		'description'   => esc_html__( 'Edit your footer description here.', 'mycatawba' ),
		'before_widget' => '<div class="footer-desc">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title" style="display:none;">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Contact Information', 'mycatawba' ),
		'id'            => 'contact-info',
		'description'   => esc_html__( 'Edit your contact information here.', 'mycatawba' ),
		'before_widget' => '<div class="contact-info">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title" style="display:none;">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Copyright', 'mycatawba' ),
		'id'            => 'copyright',
		'description'   => esc_html__( 'Edit your copyright content here.', 'mycatawba' ),
		'before_widget' => '<div class="copyright">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title" style="display:none;">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mycatawba_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mycatawba_scripts() {
	wp_enqueue_style( 'mycatawba-style', get_stylesheet_uri() );
    
    wp_enqueue_style( 'bootstrap4-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    
    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/css/slick.css' );
    
    wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/assets/css/slick-theme.css' );
    
    wp_enqueue_style( 'fonts-css', get_template_directory_uri() . '/assets/css/fonts.css' );
    
    wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/assets/css/custom.css' );

	wp_enqueue_script( 'mycatawba-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mycatawba-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
    
    wp_enqueue_script( 'jquery-js', get_template_directory_uri() . '/assets/js/jquery.min.js');
    
    wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/js/popper.min.js');
    
    wp_enqueue_script( 'bootstrap4-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js');  
    
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/js/slick.min.js');    
    
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/js/custom.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mycatawba_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function custom_remove_dashboard () {
    global $current_user, $menu, $submenu;
    get_currentuserinfo();

    if( ! in_array( 'administrator', $current_user->roles ) ) {
        reset( $menu );
        $page = key( $menu );
        while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
            $page = key( $menu );
        }
        if( __( 'Dashboard' ) == $menu[$page][0] ) {
            unset( $menu[$page] );
        }
        reset($menu);
        $page = key($menu);
        while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
            $page = key( $menu );
        }
        if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) &&
            ( 'index.php' != $menu[$page][2] ) ) {
            	if (current_user_can('subscriber')) {
	            	wp_redirect( get_option( 'siteurl' ) . '/dashboard');
            	}
        }
    }
}
add_action('admin_menu', 'custom_remove_dashboard');

function create_badge() {
	$labels = array(
		'name'               => __( 'Stamps' ),
		'singular_name'      => __( 'Stamps' ),
		'add_new'            => __( 'Add New Stamps' ),
		'add_new_item'       => __( 'Add New' ),
		'edit_item'          => __( 'Edit Stamp' ),
		'new_item'           => __( 'Add New Stamp' ),
		'view_item'          => __( 'View Stamp' ),
		'search_items'       => __( 'Search Stamp' ),
		'not_found'          => __( 'No Stamps found' ),
		'not_found_in_trash' => __( 'No Stamps found in trash' )
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail',
	);
	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'badges' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-tickets-alt',
        'has_archive'   => true,
        'register_meta_box_cb' => 'badge_reward'
	);
	register_post_type( 'badges', $args );
}
add_action( 'init', 'create_badge' );

function badge_reward(){
     add_meta_box(
		'badgeReward',
		'Reward',
		'badgeReward',
		'badges',
		'normal',
		'default'
	);
}

function badgeReward($post) {	
    $rewardField = maybe_unserialize( get_post_meta($post->ID, "rewardField", true) );

    // Nonce to verify intention later
    wp_nonce_field( 'save_quote_meta', 'custom_nonce' ); 

    $post_type_object = get_post_type_object('rewards');
    $label = $post_type_object->label;
    $posts = get_posts(array('post_type'=> 'rewards', 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));
    echo '<div class="avail-b">';     ?>
    
    <div class="form-check-inline">
      <label class="form-check-label">
          <select id="rewardField" name="rewardField">
               <?php foreach ($posts as $post) { ?>
                    <option value="<?php echo $post->ID; ?>" <?php if ( in_array($post->ID, (array) $rewardField) ) { ?> selected <?php } ?>><?php echo $post->post_title ?></option>
                <?php } ?>
          </select>
         
      </label>
    </div>      
   
  <?php echo '</div>';  
}

function myplugin_meta_save($post_id, $post){   
    if ( isset($_POST['rewardField']) ) { // if we get new data
        update_post_meta($post_id, "rewardField", $_POST['rewardField'] );
    }     
}
add_action( 'save_post', 'myplugin_meta_save', 10, 2 );

function user_rewards() {
	$labels = array(
		'name'               => __( 'Rewards' ),
		'singular_name'      => __( 'Rewards' ),
		'add_new'            => __( 'Add New Reward' ),
		'add_new_item'       => __( 'Add New' ),
		'edit_item'          => __( 'Edit Reward' ),
		'new_item'           => __( 'Add New Reward' ),
		'view_item'          => __( 'View Reward' ),
		'search_items'       => __( 'Search Rewards' ),
		'not_found'          => __( 'No Rewards found' ),
		'not_found_in_trash' => __( 'No Rewards found in trash' )
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail',
	);
	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'rewards' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-awards',
        'has_archive'   => true
	);
	register_post_type( 'rewards', $args );
}
add_action( 'init', 'user_rewards' );


function reviews() {
	$labels = array(
		'name'               => __( 'Reviews' ),
		'singular_name'      => __( 'Review' ),
		'add_new'            => __( 'Add New Review' ),
		'add_new_item'       => __( 'Add New' ),
		'edit_item'          => __( 'Edit Review' ),
		'new_item'           => __( 'Add New Review' ),
		'view_item'          => __( 'View Review' ),
		'search_items'       => __( 'Search Reviews' ),
		'not_found'          => __( 'No reviews found' ),
		'not_found_in_trash' => __( 'No reviews found in trash' )
	);
	$supports = array(
		'title',
		'editor',
	);
	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'reviews' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-star-filled',
        'has_archive'   => true,
        'register_meta_box_cb' => 'custom_reviews'
	);
	register_post_type( 'reviews', $args );
}
add_action( 'init', 'reviews' );

add_filter( 'wp_default_scripts', $af = static function( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
    }    
}, PHP_INT_MAX );
unset( $af );
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

add_filter('manage_edit-reviews_columns', 'my_columns');

function my_columns($columns) {    
    $columns['userid'] = 'Review by';
    $columns['rating'] = 'Rating';
    return $columns;
}

add_action('manage_posts_custom_column',  'my_show_columns');
function my_show_columns($name) {
    global $post;
    switch ($name) {
        case 'userid':
            $views = get_post_meta($post->ID, 'user', true);
            echo $views;
            break;
        case 'rating': 
            $views = get_post_meta($post->ID, 'rating', true);
            if($views){
                echo $views. '<span class="dashicons-before dashicons-star-filled"></span>';
            }            
            break;
    }
}

add_action( 'pp_after_social_signup', 'pp_after_social_reg_custom', 999, 3 );
function pp_after_social_reg_custom(){   
   
}

add_action( 'admin_print_scripts', function() {
    // I'm using NOWDOC notation to allow line breaks and unescaped quotation marks.
    echo <<<'EOT'
<script>
jQuery(function($){
    $('.post-type-reviews #titlewrap input, .post-type-reviews .postbox-container input, .post-type-reviews .postbox-container textarea').attr('disabled', true);
});
</script>
EOT;
}, PHP_INT_MAX );
add_filter('pp_new_user_notification', '__return_false');
add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
function logout_without_confirm($action, $result)
{
    /**
     * Allow logout without confirmation
     */
    if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : 'http://my.catawbabrewing.com/';
        $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
        header("Location: $location");
        die;
    }
}

add_filter('manage_edit-badges_columns', 'badges_date');

function badges_date($columns) {    
    $columns['start_date'] = 'Start Date';
   /* unset($columns['date']);*/
    return $columns;
}

add_action('manage_posts_custom_column',  'badges_date_col');
function badges_date_col($name) {
    global $post;
    switch ($name) {
        case 'start_date':
            $views = get_post_meta($post->ID, 'start_date', true);
            $date_format = 'j M, Y';
            
            $bdate = date( $date_format, strtotime($views));            
            echo $bdate;
            break;
    }
}

function my_column_register_sortable( $columns )
{
	$columns['start_date'] = 'start_date';
	return $columns;
}

add_filter("manage_edit-badges_sortable_columns", "my_column_register_sortable" );


add_action( 'pre_get_posts', 'badges_orderby_meta' );
function badges_orderby_meta( $query ) {
	if( ! is_admin() )
		return;
 
	$orderby = $query->get( 'orderby');
 
	if( 'start_date' == $orderby ) {
		$query->set('meta_key','start_date');
		$query->set('orderby','start_date'); // or meta_value_num for numbers
	}
}

add_filter('pp_avatar_upload_size', function() {
	return 5000;
});

function site_popup() {
	$labels = array(
		'name'               => __( 'Popup' ),
		'singular_name'      => __( 'Popup' ),
		'add_new'            => __( 'Add New Popup' ),
		'add_new_item'       => __( 'Add New Popup' ),
		'edit_item'          => __( 'Edit Popup' ),
		'new_item'           => __( 'Add New Popup' ),
		'view_item'          => __( 'View Popup' ),
		'search_items'       => __( 'Search Popup' ),
		'not_found'          => __( 'No Popups found' ),
		'not_found_in_trash' => __( 'No Popups found in trash' )
	);
	$supports = array(
		'title',
		'editor',
		'thumbnail',
	);
	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'popup' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-lightbulb',
        'has_archive'   => true
	);
	register_post_type( 'popup', $args );
}
add_action( 'init', 'site_popup' );

add_filter( 'password_change_email', 'custom_password_change', 10, 3 );

function custom_password_change( $pass_change_mail, $user, $userdata ) {

 $new_message_txt =__( 'Hi'. $user->first_name.' '.$user->last_name.',

 This notice confirms that your email was changed on MyCatawba.
 If you did not change your email, please contact the Site Administrator at admin@my.catawbabrewing.com
 
 Regards,
 MyCatawba Team' );
     
        
    $headers  = "From: Catawba Brewing- MyCatawba < admin@my.catwababrewing.com >\n";
    $headers .= "X-Sender: Catawba Brewing- MyCatawba < admin@my.catwababrewing.com >\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "Return-Path: admin@my.catwababrewing.com\n"; // Return path for errors
    

    $pass_change_mail[ 'message' ] = $new_message_txt;
    $pass_change_mail['headers'] = $headers;
    return $pass_change_mail;
}
if ( !function_exists( 'wp_password_change_notification' ) ) {
    function wp_password_change_notification() {}
}
/*
 * Let Editors manage users, and run this only once.
 */
function isa_editor_manage_users() {
 
    if ( get_option( 'isa_add_cap_editor_once' ) != 'done' ) {
     
        // let editor manage users
 
        $edit_editor = get_role('editor'); // Get the user role
        $edit_editor->add_cap('edit_users');
        $edit_editor->add_cap('list_users');
        $edit_editor->add_cap('promote_users');
        $edit_editor->add_cap('create_users');
        $edit_editor->add_cap('add_users');
        $edit_editor->add_cap('delete_users');
 
        update_option( 'isa_add_cap_editor_once', 'done' );
    }
 
}
add_action( 'init', 'isa_editor_manage_users' );

//prevent editor from deleting, editing, or creating an administrator
// only needed if the editor was given right to edit users
 
class ISA_User_Caps {
 
  // Add our filters
  function __construct() {
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }
  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }
  // If someone is trying to edit or delete an
  // admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){
    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }
 
}
 
$isa_user_caps = new ISA_User_Caps();

// Hide all administrators from user list.
 
add_action('pre_user_query','isa_pre_user_query');
function isa_pre_user_query($user_search) {
 
    $user = wp_get_current_user();
     
    if ( ! current_user_can( 'manage_options' ) ) {
   
        global $wpdb;
     
        $user_search->query_where = 
            str_replace('WHERE 1=1', 
            "WHERE 1=1 AND {$wpdb->users}.ID IN (
                 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
                    WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
                    AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')", 
            $user_search->query_where
        );
 
    }
}

add_action('admin_menu', 'custom_user_listing');

 
function custom_user_listing() {
     add_menu_page(
        'User Info',
        'User Info',
        'manage_options',
        'userlisting',
        'custom_user_render',
        'dashicons-admin-users',
        70
    );
} 
add_action('admin_menu', 'user_data_detail');

function custom_user_render() {
    require 'user-info.php';
 }

function user_data_detail() {
    add_submenu_page(
        '',
        'User Details',
        'User Details',
        'manage_options',
        'user-details',
        'user_details'        
    );
}

function user_details() {
    require 'user-data.php';
}


add_action('admin_head', 'backend_css');
function backend_css() {
  echo '<style>
    #ratings {display: none;}
    .post-type-reviews #wp-content-wrap, .post-type-reviews #postdivrich, .post-type-reviews #titlediv .inside{display: none;}
    .post-type-reviews input:disabled, .post-type-reviews textarea:disabled{color: #000 !important;}
    .post-type-reviews td.column-rating, .post-type-reviews td.column-userid{font-weight: bold; }
    .post-type-reviews .column-rating .dashicons-star-filled:before{color: #FFC02B;font-size: 18px;padding-left: 5px;}
    #menu-comments{display: none;}
    .user-table-wrap{overflow-x: auto;}
    .user-listing-table{min-width: 767px; }
    .user-listing-table th{border: 1px solid #ddd; padding: 10px 12px;}
    .user-listing-table td{border: 1px solid #ddd; padding: 8px 12px;}
    .user-listing-table{background: #FFF; border-collapse: collapse;}
    .user-listing-table input[type="submit"]{background: transparent;border: none;font-size: inherit;color: inherit;cursor: pointer;font-weight: bold;outline:none; box-shadow: none;}
    .userdataTable{margin: 30px; box-shadow: 0 0 10px #ddd; padding: 30px; background: #FFF;}
    .userdataTable .user-name {display: flex;flex-wrap: wrap;width: 100%;justify-content: space-between;align-content: flex-start;align-items: center; margin: 0 0 15px;border-bottom: 1px solid #f1f1f1;padding: 0 0 20px;}     
    .userdataTable .user-name h3{margin: 0;}     
    .userdataTable .user-name button{background: #147fbe;color: #FFF;border: none;padding: 10px 15px;border-radius: 3px;font-size: 13px;font-weight: 500;
    cursor: pointer;}
    .user-data-inner{max-width: 650px;}
    .user-data-inner ul {margin: 30px 0 0;}
    .user-data-inner ul li {display: flex;flex-wrap: wrap;justify-content: flex-start;margin: 0;}
    .user-data-inner ul li > div.__bd{width: 50%;}
    .user-data-inner ul li div.data{padding: 12px 15px;font-size: 14px;border: 1px solid #ecebeb;}
    .user-data-inner ul li div.field {border-right: none;}
    .export-data-btn{background: #147fbe;color: #FFF;border: none;padding: 10px 15px;border-radius: 3px;font-size: 13px;font-weight: 500;cursor: pointer;min-width: 100px;}
    .export-data-btn-all{background: #147fbe;color: #FFF;border: none;padding: 10px 15px;border-radius: 3px;font-size: 13px;font-weight: 500;cursor: pointer;min-width: 100px;float:right;}
    .export-data{text-align: right;margin: 0 0 15px;display: flex;flex-wrap: wrap;justify-content: space-between;align-items:center;}
    .export-data h5{font-size: 15px;font-weight: bold !important;margin: 0;}
    .user-table-filters{display: flex;width: 100%;flex-wrap: wrap; align-content: flex-start; align-items: center;}
    .user-table-filters #nameFilter{width: 20%;border-bottom: 1px solid #ddd;margin-bottom: 20px;padding: 8px 0;box-shadow: none !important;min-width: 200px;}
    .user-table-filters > * {margin: 0 15px;}
    .user-table-filters > button {padding: 8px 15px;background: #147fbe;border: none;color: #FFF;border-radius: 3px;cursor: pointer;}
    #search-u{float: right; background: #147fbe; color: #FFF;border: none; padding: 10px 15px;border-radius: 3px;font-size: 13px;font-weight: 500;cursor: pointer;min-width: 100px;text-align: center;}
    
  </style>';
}

function customize_post_admin_menu_labels() {
    global $menu;
    global $submenu;
    $menu[70][0] = 'Manage Users';
    echo '';
}
add_action( 'admin_menu', 'customize_post_admin_menu_labels' );



add_action( 'admin_notices', 'export_btn' );
function export_btn() {

        
?>
<style>
    .simple_csv_exporter_wra .ccsve_button a
    {
        display: none;
    }
    .alignright{
    color: #fff;
    background: #0091ea;
    padding: 10px 10px;
    cursor: pointer;
    border: 1px solid;

    }
    .alignright a
    {
        color: #fff !important;
    }
</style>
  <div class="wrap alignright">
      <a href="<?php echo site_url();?>/wp-admin/tools.php?page=simple_csv_exporter_settings">Export</a>
        </div>
<?php

       
    
}

/*
wp_set_current_user(748); 
if (wp_validate_auth_cookie()==FALSE)
{
    wp_set_auth_cookie($user_id, true, false);
}
*/



//
//$current_user = wp_get_current_user();
//if (user_can( $current_user, 'administrator' )) {
//	 wp_set_current_user(326); 
//	if (wp_validate_auth_cookie()==FALSE)
//	{	
//	    wp_set_auth_cookie($user_id, true, false);
//	}
//}