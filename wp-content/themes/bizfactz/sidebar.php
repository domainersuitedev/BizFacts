<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 */
?>

<!--Right Panel Starts -->
<div class="registrationOuter">
	<div class="registration">
		<?php if ( is_active_sidebar( 'register-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'register-widget-area' ); ?>
		<?php endif; ?>
	</div>
</div>
<!--Right Panel Ends -->