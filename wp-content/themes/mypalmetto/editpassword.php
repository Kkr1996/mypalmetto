<?php
    /* Template Name: Edit Password */
    get_header();
    
?>
<div class="edit-profile">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="main-title-2">Change Password</h2>                
                <?php echo do_shortcode('[profilepress-edit-profile id="5"]'); ?>
                <span class="edit-back back-btn"><a href="<?php echo home_url(); ?>"> Cancel</a></span>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>