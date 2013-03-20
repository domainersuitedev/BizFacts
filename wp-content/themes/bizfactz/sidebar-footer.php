<?php
/**
 * The Footer widget areas.
 */
?>

<?php wp_nav_menu( array( 'menu_class' => 'secondaryNav', 'container_class' => 'footerMenu', 'theme_location' => 'secondary' ) ); ?>
<div class="footerTopPan">
	<div class="row-fluid">
		<div class="span6">
			<p><?php bloginfo('description'); ?></p>
		</div>
		<div class="span6 emailLink">
			<p><span>email support</span> <a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a></p>
		</div>
	</div>
</div>