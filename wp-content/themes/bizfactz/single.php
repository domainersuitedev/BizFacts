<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<!--Body Panel Starts -->
<div class="bodyPanel">
	<?php get_sidebar( 'blog' ); ?>
	<!--LeftPanel Starts -->
	<div class="bodyLeftPan">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="blogRow">
				<h1><?php the_title(); ?></h1>
				<h3>Published on <?php the_time('j') ?> <?php the_time('M') ?>, <?php the_time('Y') ?> By <?php the_author() ?></h3>
				<?php if ( has_post_thumbnail()) {?>
					<div class="postImgArea">			
						<?php echo get_the_post_thumbnail($post->ID, array(150,150)); ?>						
					</div>
				<?php } ?>
				<?php the_content(); ?>
				<div class="spacer"><!-- --></div>
			</div>
			<div class="msgCommentsArea">
				<?php comments_template(); ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<!--LeftPanel Ends -->        
</div>
<!--Body Panel Starts -->

<?php get_footer(); ?>
