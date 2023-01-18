<?php 
    get_header();
?>
<section class="review-section reward-c-section">
    <div class="container text-center">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                 <div class="back-btn">
                    <a href="<?php the_permalink(58); ?>"><i class="fa fa-angle-left"></i> Back</a>
                </div>               
                    <?php        
                        while(have_posts()){
                            the_post();
                            $rewardIcon =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0];
                        } ?>
                        <div class="reward-image">
                            <img src="<?php echo ($rewardIcon ? $rewardIcon : get_template_directory_uri().'/assets/images/reward.png'); ?>">
                        </div>
                        <div class="reward-title">
                            <h2 class=""><?php echo the_title(); ?></h2>
                        </div>
                        <div class="badge-description"><?php the_content(); ?></div>
                        <?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>

<section class="review-section upcoming-rewards">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                 <h2 class="main-title-2">Upcoming Rewards</h2>              
                    <div class="badges-slider-outer">
                    <button class="slick-prev slide-prev"><img src="<?php echo get_template_directory_uri().'/assets/images/arrow-prev.png'?>"></button>
                    <button class="slick-next slide-next"><img src="<?php echo get_template_directory_uri().'/assets/images/arrow-next.png'?>"></button>
                    <div class="badges-slider">
                        <?php
                            $today = date('Ymd');
                            $rewardsQuery2 = array('post_type' => 'rewards', 'posts_per_page' => -1, 'meta_query' => array(array(
                            'key'		=> 'start_date',
                            'compare'	=> '>=',
                            'value'		=> $today,
                            )), 'order' => 'ASC', 'exclude' => $post->ID);
                           $rewards2 = get_posts($rewardsQuery2);
                            if($rewards2){
                                                      
                                foreach($rewards2 as $reward2){
                                    setup_postdata( $reward2 );
                                ?>
                                    <div class="badge-col">                                        
                                        <div class="badge-inner-wrap">
                                            <?php $rewardIcon =  wp_get_attachment_image_src( get_post_thumbnail_id( $reward2->ID ), 'single-post-thumbnail' )[0];  ?>
                                            <div class="reward-image">
                                                <img src="<?php echo ($rewardIcon ? $rewardIcon : get_template_directory_uri().'/assets/images/reward.png'); ?>">
                                            </div>
                                            
                                            <div class="reward-title">
                                                <h2 class=""><?php echo $reward2->post_title; ?></h2>
                                            </div>
                                            <div class="login-btn badge-claim reward-claim">
                                                <a href="<?php the_permalink($reward2->ID); ?>">View Reward</a>
                                            </div>
                                        </div>                                       
                                    </div>
                            <?php } wp_reset_postdata();
                            }
                        ?>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>