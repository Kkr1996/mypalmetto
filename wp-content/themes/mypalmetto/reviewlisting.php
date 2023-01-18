<?php
/* Template Name: User Review Listing */
get_header();
$currentUser = wp_get_current_user();
?>
<section class="user-review-listing">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="main-title-2">Your reviews</h2>
                <div class="review-list">
                    <?php $reviews = new WP_Query(array('post_type' => 'reviews', 'author' => $currentUser->ID, 'posts_per_page' => 20)); 
                       if($reviews->have_posts()){
                           while($reviews->have_posts()){
                           $reviews->the_post();
                        $rating = get_field('rating', $review->ID);
                        $content = get_field('review', $review->ID);
                    ?>
                    <div class="review-box">
                        <h5><?php echo the_title(); ?> - <span><?php echo get_the_date(); ?></span></h5>
                        <ul class="rating-meter unstyled-list review-stars">
                            <?php 
                                $i = $rating;
                                while($i >= 0){
                                    echo '<li><i class="fas fa-star"></i></li>';                                
                                    $i--;
                                }
                            ?>                        
                        </ul>
                        <div class="badge-description">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <?php
                           }
                        wp_reset_query();
                       }
                    else{
                        echo '<h5>You have not reviewed any beers. Be sure to leave a review and let us know which brews are your favorite!</h5>';
                    }
                    ?>
                </div>                
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>