<?php
/**
 * The template for displaying all pages.
 * Template Name: Login Page
 */

get_header(); ?>

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
			<div class="loginForm">
				<form action="" method="post" name="" enctype="multipart/form-data" class="form-horizontal">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Username</label>
							<div class="controls">
							  <input type="text" class="span3">
							</div>
						 </div>
						<div class="control-group">
							<label class="control-label">Password</label>
							<div class="controls">
							  <input type="password" class="span3">
							</div>
						 </div>
						 <div class="form-actions">
							<button type="submit" class="btn">Submit</button>
						  </div>
					 </fieldset>
				</form>
			</div>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
	</div>
	<!--LeftPanel Ends -->        
</div>
<!--Body Panel Starts -->

<?php get_footer(); ?>
