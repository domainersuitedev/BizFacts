<?php
/**
 * The template for displaying the footer.
 */
?>

<!--Footer Starts -->
<div class="footerWrapper">
	<?php get_sidebar( 'footer' ); ?>
	<div class="footerBottomPan">
		<div class="row-fluid">
			<?php wp_nav_menu( array( 'menu_class' => 'footNav', 'container_class' => 'span9', 'theme_location' => 'footermenu' ) ); ?>
			<div class="span3 rightLink">
				<p><a href="<?php echo get_option('home'); ?>/"><?php echo $_SERVER['HTTP_HOST']; ?></a></p>
			</div>
		</div>
	</div>
</div>
<!--Footer Ends -->
<?php wp_footer(); ?>
</body>
</html>
