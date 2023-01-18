<?php
    /* Template Name: Edit Profile */
    get_header();
if(!is_user_logged_in() ){
wp_redirect( get_option( 'siteurl' ));
} 
?>
<div class="edit-profile">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="main-title-2">Edit Profile</h2>
                <div class="change-password"><i class="fas fa-key"></i><a href="<?php the_permalink(571); ?>">Change password</a></div>
                <?php echo do_shortcode('[profilepress-edit-profile id="3"]'); ?>
                <span class="edit-back back-btn"><a href="<?php echo home_url(); ?>"> Cancel</a></span>
            </div>
        </div>
    </div>
</div>
<?php 
$shirt=$_GET['s'];
?>

<script>

 jQuery(window).on('load', function(){
  
    var shirtsize = jQuery("#Shirt-size").val();
    var shirtedit = '<?php echo $shirt;?>';
    if(shirtsize == null & shirtedit == "l")
    {
            jQuery("#Shirt-size").css("border","1px solid red");
            jQuery("HTML, BODY").animate({scrollTop:1500},1000); 
          //  jQuery("HTML, BODY").scrollTop(700);
            // window.scroll(700,0);
    }
    else
        {
            return true;
        }
    //var shirtsize = jQuery('#Shirt-size').attr('selected','selected');
    
});
</script>
<?php get_footer(); ?>