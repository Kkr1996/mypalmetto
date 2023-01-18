<?php
/* Template Name: Login */
get_header();
?>

<?php 
$current_user = wp_get_current_user();
    if(is_user_logged_in()){
       wp_redirect( get_option( 'siteurl' ) . '/dashboard');
        exit;
    }
?>
<?php if (has_post_thumbnail( $post->ID ) ): ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>                 
<?php endif; ?>
<section class="login-page background-image" style="background-image:url(<?php echo $image[0]; ?>);">
    <div class="login-wrap">
        <div class="div-6 login-l">
            <div class="login-wrap-inner">
                <div class="login-page-logo">
                    <?php
                        the_custom_logo();
                    ?>
                </div>
                <div class="login-content">
                    <?php
                        if(have_posts()){
                            while(have_posts()){
                                the_post();
                                the_content();
                            }
                        }
                    ?>
                </div>
                <div class="login-form-c">
                    <?php echo do_shortcode('[profilepress-login id="1"]'); ?>
                   <!-- <@?php echo do_shortcode('[profilepress-login id="11"]'); ?>-->
                </div>
            </div>
        </div>
        <div class="login-right div-6">
            <div class="login-image-right">                
                <img src="<?php echo $image[0]; ?>">
            </div>
        </div>
    </div>
</section>