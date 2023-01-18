<?php
/* Template Name: Dashboard */
    get_header();    
?>

<?php 
    global $wpdb;
    $currentUser = wp_get_current_user();    
    $allowed_roles = array('editor', 'administrator');
    if(!is_user_logged_in() ){
        wp_redirect( get_option( 'siteurl' ));
    }        
    if( array_intersect($allowed_roles, $currentUser->roles ) ) {
        wp_redirect( get_option( 'siteurl' ) . '/wp-admin');        
    }
    else{
        $role = 1;
        echo '<style> html{margin: 0 !important;} </style>';
    }
    $currentUser = wp_get_current_user();    
    $currentID = $currentUser->ID;

    $users = $wpdb->get_results("SELECT user_id FROM user_badges WHERE user_id = '$currentID' ");    
    $badges = $wpdb->get_results("SELECT badge FROM user_badges WHERE user_id = '$currentID' ");  
    $shirtsize = get_user_meta ($currentID, 'shirtsize');
  //  echo '<pre>',var_dump($shirtsize); echo '</pre>';
    foreach($badges as $badge){
        $claimedBadges[] = $badge->badge;        
    }
    if($claimedBadges == NULL){
        $claimedBadges[] = 0;
    }

    $rewards = $wpdb->get_results("SELECT reward_id FROM user_rewards WHERE userid = '$currentID' ");        
    foreach($rewards as $reward){
        $claimedRewards[] = $reward->reward_id;
    }
    if($claimedRewards == NULL){
        $claimedRewards[] = 0;
    }
    $cl = $array = array_values($claimedBadges);
?>

<!-- All Badges -->
<section class="all-badges">
     <?php if($shirtsize[0]=="Select One" ||$shirtsize[0]==null ):?>
    <div class="display-message">
   
        <p>To get your Reward, please enter your T-Shirt Size! <a href="<?php echo get_the_permalink(320);?>/?s=l">Click here</a></p>

    </div>
        <?php endif;?>
    <div class="container">
        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">                
                <div class="all-badges-heading">
                    
                    <h3 class="all-badge-small">
                        <?php echo get_field('first_title'); ?>
                    </h3>
                    <h1 class="main-title">
                        <?php echo get_field('main_title'); ?>
                    </h1>
                    <?php
		                while ( have_posts() ) :
		                	the_post();
		                	get_template_part( 'template-parts/content', get_post_type() );
	                	endwhile;
	                   	?>
                </div>
                <h2 class="main-title-2"><?php echo get_field('all_badges_heading'); ?></h2>
                <div class="badges-slider-outer">
                    <button class="slick-prev slide-prev"><img src="<?php echo get_template_directory_uri().'/assets/images/arrow-prev.png'?>"></button>
                    <button class="slick-next slide-next"><img src="<?php echo get_template_directory_uri().'/assets/images/arrow-next.png'?>"></button>
                    <div class="badges-slider">
                        <?php                            
                            $today = date('Ymd');
                            $dateT = date('d/m/Y');                            
                            $args = array(
                                'post_type' => 'badges', 
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                       array(
                                        'key' => 'start_date',
                                        'compare' => '>=',
                                        'value' => $startDate,
                                        )
                                        ),
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'post__not_in' => $cl,
                            );
                            $badges = get_posts($args);
                            if($badges){
                                                      
                                foreach($badges as $badge){
                                    setup_postdata( $badge );                                  
                                    $startDate = get_field('start_date', $badge->ID);
                                    $endDate = get_field('ending_date', $badge->ID);
                                    
                                    $sdbadge = strtotime($startDate);
                                    $sd_badge = date('Ymd',$sdbadge);
                                    
                                    $edbadge = strtotime($endDate);
                                    $ed_badge = date('Ymd',$edbadge);
                                    
                                    ?>
                                    <div class="badge-col <?php echo($sd_badge <= $today && $ed_badge >= $today ? 'active' : 'disabled'); ?> <?php echo (in_array($badge->ID, $claimedBadges) ? 'claimed': ''); ?>">                                        
                                        <form class="claim-form" action="<?php echo site_url(); ?>/review" method="post">
                                            <input type="hidden" name="userid" value="<?php echo $currentID; ?>">
                                            <input type="hidden" name="badgeid" value="<?php echo $badge->ID; ?>">
                                        <div class="badge-inner-wrap">
                                            <div class="badge-icon">
                                                <?php $badgeIcon =  wp_get_attachment_image_src( get_post_thumbnail_id( $badge->ID ), 'single-post-thumbnail' )[0];?>
                                                <img src="<?php echo ($badgeIcon ? $badgeIcon : get_template_directory_uri().'/assets/images/default.png'); ?>">
                                            </div>
                                            <h2 class="badge-title"><?php echo $badge->post_title; ?></h2>
                                            <div class="badge-description"><?php the_content(); ?></div>
                                            <div class="login-btn badge-claim">
                                               
                             <?php if($shirtsize[0]=="Select One" || $shirtsize[0]==null){?>
                                                
                                                <p data-backdrop="static" data-keyboard="false"  class="validate-shirt" data-toggle="modal" data-target="#myModal"  id="<?php echo $badge->ID; ?>" class="<?php echo (in_array($badge->ID, $claimedBadges) ? 'disabled': ''); ?>" value="<?php echo (in_array($badge->ID, $claimedBadges) ? 'Claimed': 'Claim'); ?> " >Claim</p>
                                                
                                                    
                                    <?php }
                                    
                                    
                                    
                                      else{
                                        ?>
                                     <input type="submit" id="<?php echo $badge->ID; ?>" class="<?php echo (in_array($badge->ID, $claimedBadges) ? 'disabled': ''); ?>" value="<?php echo (in_array($badge->ID, $claimedBadges) ? 'Claimed': 'Claim'); ?>" >
                                        <?php
                                      }?>            
                                                
                                                
                                             
                                                <div class="validate" style="display:none"><strong>To get your Reward, please enter your T-Shirt Size!</strong></div>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                            <?php } wp_reset_postdata();
                            }
                        ?>           
                        <?php                                                 
                            $claimedArgs = array(
                                'post_type' => 'badges', 
                                'posts_per_page' => -1,
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'include' => $cl,
                            );
                            $Clbadges = get_posts($claimedArgs);
                            if($Clbadges){
                                                      
                                foreach($Clbadges as $Clb){
                                    setup_postdata( $Clb );                                    
                                    ?>
                                    <div class="badge-col disabled claimed">                                        
                                        <div class="claim-form">
                                        <div class="badge-inner-wrap">
                                            <div class="badge-icon">
                                                <?php $badgeIcon =  wp_get_attachment_image_src( get_post_thumbnail_id( $Clb->ID ), 'single-post-thumbnail' )[0];?>
                                                <img src="<?php echo ($badgeIcon ? $badgeIcon : get_template_directory_uri().'/assets/images/default.png'); ?>">
                                            </div>
                                            <h2 class="badge-title"><?php echo $Clb->post_title; ?></h2>
                                            <div class="badge-description"><?php the_content(); ?></div>
                                            <div class="login-btn badge-claim">
                                                <input type="submit" id="<?php echo $Clb->ID; ?>" class="<?php echo (in_array($Clb->ID, $claimedBadges) ? 'disabled': ''); ?>" value="<?php echo (in_array($Clb->ID, $claimedBadges) ? 'Claimed': 'Claim'); ?>" >
                                            </div>
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
<!-- All Badges Ends -->

<!-- Claimed Badges -->
<section class="claimed-badges">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="main-title-2"><?php echo get_field('claimed_badges_heading'); ?></h2>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="claimed-badge-listing">
                    <?php  
                   // echo "today".$today.'<br>';
                    $rewardsQ = array('post_type' => 'rewards', 'posts_per_page' => 1, 'meta_query' => array(array(
                    'key'		=> 'start_date',
                    'compare'	=> '<=',
                    'value'		=> $today,
                    ),
                     array(
                        'key'		=> 'ending_date',
                        'compare'	=> '>=',
                        'value'		=> $today,
                    )),);
                $rewards_q = get_posts($rewardsQ);
              
                foreach($rewards_q as $rq){
                    $rewardID  = $rq->ID;
                    $startdate = get_field('start_date', $rq->ID);
                    $enddate = get_field('ending_date', $rq->ID);
                }
                   wp_reset_query();
                 //  echo "Reward Start date".$startdate.'</br>';
              //  echo "Reward End date".$enddate.'</br>';
                   // echo "enddate".$enddate.'</br>';
                ?>
                
                    
                <?php  
                    
                    $startdate2 = strtotime($startdate);
                  //  echo "Reward Start date".$startdate2.'</br>';
                    $newsd = date('Ymd',$startdate2);
                   //echo "newsd".$newsd.'<br>';
            
                    $enddate2 = strtotime($enddate);
                    //  echo "Reward End date".$enddate2.'</br>';
                    $newed = date('Ymd',$enddate2);    
                  // echo "newed".$newed.'<br>';   
                    
                        $args = array('post_type' => 'badges', 'include' => $claimedBadges, 'meta_query' => array(
//                        array(
//                            'key'		=> 'start_date',
//                            'compare'	=> '<=',
//                            'value'		=> $newed,
//                        ),
//                        array(
//                            'key'		=> 'start_date',
//                            'compare'	=> '<=',
//                            'value'		=> $newsd,
//                        ),
                        array(
                            'key'		=> 'rewardField',
                            'compare'	=> LIKE,
                            'value'		=> $rewardID,
                        )
                        ), 'posts_per_page' => -1);
                        $badges = get_posts($args);
                    
                    
                       // echo '<pre>',var_dump($badges); echo '</pre>';
                    
                    
                        $claimedCount = count($badges);
                        //echo "claimed count".$claimedCount;
                        if($badges){
                            foreach($badges as $badge){
                                
                       $stamp_startdate = get_field('start_date', $badge->ID);
                        //   echo  $stamp_startdate;    
                                
                 //  echo "End Date".$enddate = get_field('ending_date', $badge->ID);  
//$start_date = $startdate2;
////echo "start_date".strtotime($start_date).'<br>';
////
//$end_date   =   $enddate2;
//
//echo "end_date".strtotime($end_date).'<br>';
//echo strtotime($end_date).'<br>';
//$date_from_user = '2009-06-16';
//
                    if(check_in_range($startdate, $enddate, $stamp_startdate))
                        {
                                setup_postdata( $badge ); 
                                ?>
                                <div class="badge-col">
                                    <div class="badge-inner-wrap">
                                        <div class="badge-icon">
                                            <?php $badgeIcon =  wp_get_attachment_image_src( get_post_thumbnail_id( $badge->ID ), 'single-post-thumbnail' )[0];?>
                                            <img src="<?php echo ($badgeIcon ? $badgeIcon : get_template_directory_uri().'/assets/images/default.png'); ?>">
                                        </div>
                                        <h2 class="badge-title"><?php echo $badge->post_title; ?></h2>
                                        <div class="badge-description"><?php the_content(); ?></div>
                                    </div>
                                </div>
                        <?php
                           }
                            } wp_reset_postdata();
                        }
                        else{
                            echo '<h4>Uh-oh, looks like you have some stamp-collecting to do!</h4>';
                        }
                    ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-m-12 col-sm-12 col-12">                    
                <?php
                    $tbadge = array('post_type' => 'badges', 'meta_query' => array(array(
                            'key'		=> 'start_date',
                            'compare'	=> '<=',
                            'value'		=> $newed,
                        ),
                        array(
                            'key'		=> 'rewardField',
                            'compare'	=> LIKE,
                            'value'		=> $rewardID,
                        )
                        )
                            ,'posts_per_page' => -1,
                        );
                    
                    $totalBadges = count(get_posts($tbadge));
                ?>
                <div class="badge-col reward-col">
                    <div class="badge-inner-wrap">
                        <?php                            
                            $rewardsQuery = array('post_type' => 'rewards', 'posts_per_page' => 1, 'meta_query' => array(array(
                            'key'		=> 'start_date',
                            'compare'	=> '<=',
                            'value'		=> $today,
                        ),
                         array(
                            'key'		=> 'ending_date',
                            'compare'	=> '>=',
                            'value'		=> $today,
                        )),);
                            $rewards = get_posts($rewardsQuery);
                            if($rewards){
                                foreach($rewards as $reward){ ?>
                                <?php $rewardIcon =  wp_get_attachment_image_src( get_post_thumbnail_id( $reward->ID ), 'single-post-thumbnail' )[0];  ?>
                                    <div class="reward-image">
                                        <img src="<?php echo ($rewardIcon ? $rewardIcon : get_template_directory_uri().'/assets/images/reward.png'); ?>">
                                    </div>
                                    <div class="reward-title">
                                        <h2 class=""><?php echo $reward->post_title; ?></h2>
                                    </div>
                            <?php } ?>             
                        <?php }
                            else{
                                echo '<div class="reward-title">
                                        <h2 class="">No rewards available right now.</h2>
                                    </div>';
                            }                        
                        ?>
                        <div class="reward-progress">
                            <div class="completed-badge">
                                <span class="title">Stamps Collected</span><span class="count"><?php echo $claimedCount; ?></span>
                            </div>
                            <div class="total-badge">
                                <span class="title">Stamps Required</span><span class="count"><?php echo $totalBadges; ?></span>
                            </div>
                        </div>                        
                        <div class="reward-progress-bar">
                            <div class="reward-bar">
                                <div class="reward-bar-cal"></div>
                            </div>
                            <div class="reward-t">
                                Completed <span></span>
                            </div>
                        </div>                        
                        <div class="">
                            <form action="<?php echo site_url(); ?>/claim-reward" method="post"   class="login-btn badge-claim reward-claim">
                                <input type="submit" value="<?php echo (in_array($reward->ID, $claimedRewards) ? 'Claimed': 'Claim Reward'); ?>" class="claim-rew <?php echo (in_array($reward->ID, $claimedRewards) ? 'claimed-rew': ''); ?>">
                                <input type="hidden" value="<?php echo $reward->ID; ?>" name="rewardID">
                                <input type="hidden" value="<?php echo $shirtsize[0]; ?>" class="shirtsize" name="shirtsize">
                                    <?php if($shirtsize[0]=="Select One" || $shirtsize[0]==null){?>
                              
                                       <p data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#myModal" class="view-reward">View Reward</p> 
                                    <?php }
                                      else{
                                        ?>
                                        <a href="<?php the_permalink(360); ?>" class="view-reward">View Reward</a>
                                        <?php
                                      }?>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?php 


function check_in_range($startdate, $enddate, $stamp_startdate)
{
  // Convert to timestamp
  $start_ts = strtotime($startdate);
  $end_ts = strtotime($enddate);
  $user_ts = strtotime($stamp_startdate);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}
?>
<!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal reward-message" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"></button>
      <div class="modal-body">
          <h3>Update your profile</h3>
          <p>A shirt size is required for claiming your reward.</p>
          <a href="https://my.catawbabrewing.com/edit-profile/?s=l">Edit Profile</a>
      </div>
    </div>
  </div>
</div>
  
<!-- Claimed Badges Ends -->

<script>
    jQuery(document).ready(function(){
        var role = '<?php echo $role; ?>';        
        if(role == 1){
            jQuery("#wpadminbar").remove();
            jQuery('html').css('margin', '0 !important');
        }
        var totalBadges = jQuery('.total-badge > .count').html();
        var claimedBadges = jQuery('.completed-badge > .count').html();
        var badgePercent = (claimedBadges / totalBadges) * 100;
        jQuery('.reward-t > span').html(Math.round(badgePercent * 100) / 100+'%');
        jQuery('.reward-bar-cal').css('width', Math.round(badgePercent * 100) / 100+'%');
        if(totalBadges == claimedBadges){
           jQuery('.reward-claim > .claim-rew').addClass('active');
            jQuery('.reward-claim > .view-reward').remove();
        }
        else{
           jQuery('.reward-claim > .claim-rew').remove();
       }
//        jQuery('.login-btn').on('click', function() {
//        // do validation here
//           var size = jQuery(".shirtsize").val();
//            if(size=="Shirt Size")
//            {
//                 //alert("ok");
//                // alert("To get your Reward, please enter your T-Shirt Size!");
//                jQuery(this).children(".validate").show();
//                return false; 
//            }
//          
//        });
        
//          jQuery('.view-reward').on('click', function() {
//        // do validation here
//           var size = jQuery(".shirtsize").val();
//            if(size=="Shirt Size")
//            {
//                //alert("To get your Reward, please enter your T-Shirt Size!");
//                document.getElementById("validate").innerHTML ="To get your Reward, please enter your T-Shirt Size!";
//                return false; 
//            }
//          
//        });
    });
</script>
<?php get_footer();
?>