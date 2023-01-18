<?php
    get_header();
?>
<?php $backgroundImage =  get_field('banner_image');?>
<section class="review-banner background-image" style="background-image:url(<?php echo $backgroundImage['url']; ?>);">    
</section>
<section class="review-section">
    <div class="container text-center">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">              
                <?php
                        while(have_posts()){ the_post(); ?>
                            <div class="badge-icon">
                                <?php $badgeIcon =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'single-post-thumbnail' )[0]);?>
                                <img src="<?php echo ($badgeIcon ? $badgeIcon : get_template_directory_uri().'/assets/images/default.png'); ?>">
                            </div>
                            <h2 class="badge-title"><?php the_title(); ?></h2>
                            <div class="badge-description"><?php the_content(); ?></div>
                      <?php }   ?>                     
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>