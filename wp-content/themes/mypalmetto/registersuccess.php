<?php
    /* Template Name: Register Success */
    get_header();
?>
<div class="register-success">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="success-message text-center">
                    <h3><i class="far fa-check-circle"></i>Congratulations! Your registration was successful.</h3>
                    <div class="login-btn badge-claim">
                       <a href="<?php echo get_site_url(); ?>">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>