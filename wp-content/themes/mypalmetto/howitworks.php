<?php
    /* Template Name: How it works */
    get_header();
?>
<div class="how-it-works text-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h1 class="main-title"><?php the_title(); ?></h1>
                <div class="how-content">
                    <?php 
                        while(have_posts()){
                            the_post();
                            the_content();
                        }
                     ?>
                </div>
                
                <div class="how-process">
                    <ul class="unstyled-list how-process-list">
                        <?php $i =1; while(have_rows('process')){ 
                                the_row(); 
                                $icon = get_sub_field('process_icon');
                                $content = get_sub_field('content');
                        ?>
                        <li>
                            <div class="process-icon">
                                <img src="<?php echo $icon['url']; ?>">
                            </div>
                            <div class="count"><?php echo $i; ?></div>
                            <div class="process-content">
                                <?php echo $content; ?>
                            </div>
                        </li>
                        <?php $i++; } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>