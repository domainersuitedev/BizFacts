<?php
/**
 * The Footer widget areas.
 */
?>

<!--Right Panel Starts -->
<div class="registrationOuter">
	<div class="registration">
		<?php if ( is_active_sidebar( 'register-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'register-widget-area' ); ?>
		<?php endif; ?>
		<div class="blogLinkBox">
			<?php if ( is_active_sidebar( 'blog-widget-area' ) ) : ?>
				<?php dynamic_sidebar( 'blog-widget-area' ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<!--Right Panel Ends -->