<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); ?>

<!--Body Panel Starts -->
<div class="bodyPanel">
	<?php get_sidebar( 'blog' ); ?>
	<!--LeftPanel Starts -->
	<div class="bodyLeftPan">
		<h1><?php printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="blogRow">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<h3>Published on <?php the_time('j') ?> <?php the_time('M') ?>, <?php the_time('Y') ?> By <?php the_author() ?></h3>
			<?php if ( has_post_thumbnail()) {?>
				<div class="postImgArea">			
					<?php echo get_the_post_thumbnail($post->ID, array(150,150)); ?>						
				</div>
			<?php } ?>
			<?php the_excerpt(); ?>
			<div class="spacer"><!-- --></div>
			<p class="continue"><a href="<?php the_permalink(); ?>">Continue reading</a></p>
	   </div>
	   <?php endwhile; else: ?>
			<p><strong>No Post found!</strong></p>
	   <?php endif; ?>
	   <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	</div>
	<!--LeftPanel Ends -->        
</div>
<!--Body Panel Starts -->
		
<?php get_footer(); ?>
