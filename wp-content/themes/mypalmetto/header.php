<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MyCatawba
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <?php
    $currUser = wp_get_current_user();
$meta = get_user_meta($currUser->ID, 'fav_beer', true);
if (current_user_can('subscriber')) {
    $args = array('post_type' => 'popup', 'posts_per_page' => 1);
    $popup = get_posts($args);
    foreach($popup as $pop){
        setup_postdata( $pop );
        echo '<div class="popup container">        
                <div class="content-pop">
                   <i class="fas fa-exclamation-circle"></i> '.get_the_content().'</div>
                <div class="close-popup-btn">
                    &times;
                </div>
            </div>';
    }    
    if($meta == "" && !is_page(320)){
        wp_redirect( get_option( 'siteurl' ) . '/edit-profile');
    }
    if($meta == "" && is_page(320)){
        echo '<div class="emp-info">Your profile information seems incomplete. Please enter all the information. </div>';
    }
} ?>
    <div class="loader-wrap">
        <div class="loader-inner">
            <div class="spinner">
            
            </div>
            <div class="logo">
                <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
            </div>
        </div>
    </div>    
    <?php if( !is_page( array( 27, 56 ) ) ) {?>
	<header id="masthead" class="site-header">
        <div class="container">
            <div class="header-main">
                <div class="site-branding">
                    <a href="<?php echo home_url().'/dashboard'; ?>">
                        <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
                    </a>                    
                </div><!-- .site-branding -->                
                <?php if(is_user_logged_in()) {?>
                <div class="user-toggle">                    
                    <button class="user-btn" class="toggle-btn" data-toggle="dropdown" aria-expanded="true">
                        <?php
                            $user = wp_get_current_user();
                            
                            if ( $user ) {
                                ?>
                                <img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" />
                        <?php } else { ?>
                        <i class="fas fa-user"></i>       
                        <?php } ?>
                    </button>
                   <nav id="site-navigation" class="main-navigation dropdown-menu menu">			
                    <?php
                        wp_nav_menu( array(
                            'menu' => 'Main Menu',
                            'menu_class' => 'unstyled-list main-menu',
                            'container' => '<ul>'
                        ) );
                    ?>
                  </nav> 
                </div>
                <?php } ?>
            </div>
        </div>
	</header><!-- #masthead -->
     <?php } ?>
	<div id="content" class="site-content">
