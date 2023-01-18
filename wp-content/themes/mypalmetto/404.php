<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MyCatawba
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found no-beer">
				<div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="mug">
                                <div class="no-404">404</div>
                                <div class="ear"></div>
                                <div class="beer"></div>
                                <!--<div class="shine"></div>-->
                                <div class="top">    
                              </div>
                            </div>
                            <div class="error-message">
                                <h5>Oops! We couldn't find what you're looking for. But you can check out our beers <a href="<?php echo get_site_url(); ?>">here.</a></h5>
                            </div>
                        </div>
                    </div>                    
                </div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
