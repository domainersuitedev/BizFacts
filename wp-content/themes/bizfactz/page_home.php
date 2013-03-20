<?php
/**
 * The template for displaying all pages.
 * Template Name: Home Page
 */

get_header(); ?>

<?php if(get_post_custom_values("slider_info", $post->ID)){ ?>
<!--Header Starts -->
<div class="header">
	<div class="sliderPanel">
		<div class="flexslider">
			<ul class="slides">
				<?php $slider_info = get_post_custom_values("slider_info", $post->ID);
				$slider_info_num = count($slider_info);						
				for($i = 0; $i < $slider_info_num; $i++){
				$objs = explode("|", $slider_info[$i]); ?>
					<li>
						<div class="slide<?php echo $i+1; ?>">
							<div class="headerTxt">
                            	<div class="headerCont">
                                    <h2><?php echo $objs[0]; ?></h2>
                                    <p><?php echo $objs[1]; ?></p>
                                    <div class="getStartedBtn">
                                        <a href="http://50.57.186.147/?page_id=41">Get Started Now!</a>
                                    </div>
                                </div>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>
		</div>
	 </div>
</div>
<!--Header Ends -->
<?php } ?>
<!--Body Panel Starts -->
<div class="bodyPanel">
	<?php get_sidebar(); ?>
	<!--LeftPanel Starts -->
	<div class="bodyLeftPan">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php if(get_post_custom_values("custom_heading", $post->ID)){
			$custom_heading = get_post_custom_values("custom_heading", $post->ID); ?>
				<h1><?php echo $custom_heading[0]; ?></h1>
			<?php }else{ ?>
				<h1><?php the_title(); ?></h1>
			<?php } ?>
			<?php if(get_post_custom_values("custom_sub_heading", $post->ID)){
			$custom_sub_heading = get_post_custom_values("custom_sub_heading", $post->ID); ?>
				<h2><?php echo $custom_sub_heading[0]; ?></h2>
			<?php } ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
	</div>
	<!--LeftPanel Ends -->        
</div>
<!--Body Panel Starts -->
<!--Facebook Twitter Panel Starts-->
<div class="fbTwitterConatiner">
	<div class="facebookBlock">
		<?php if ( is_active_sidebar( 'facebook-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'facebook-widget-area' ); ?>
		<?php endif; ?>
	</div>
	<div class="twitterBlock">
		<?php if ( is_active_sidebar( 'twitter-widgets' ) ) : ?>	
			<?php dynamic_sidebar( 'twitter-widgets' ); ?>							
		<?php endif; ?>
	</div>
</div>
<!--Facebook Twitter Panel Ends -->

<?php get_footer(); ?>
