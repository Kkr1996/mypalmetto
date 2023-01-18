<?php 
    /* Template Name: Reset Password */
    get_header();
?>
<div class="reset-password">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="main-title-2">Reset Password</h2>
                <div class="reset-pass-form">
                    <?php echo do_shortcode('[profilepress-password-reset id="1"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>