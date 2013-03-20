<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/custom-style.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/flexislider.css" rel="stylesheet" type="text/css" />

<script src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-transition.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-alert.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-modal.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-dropdown.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-scrollspy.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-tab.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-tooltip.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-popover.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-button.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-collapse.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-carousel.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap-typeahead.js"></script>

<?php if(is_front_page()){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.anythingslider.js"></script>
<script type="text/javascript">

	function formatText(index, panel) {
	  return index + "";
	}

	$(function () {
	
		$('.anythingSlider').anythingSlider({
			easing: "easeInOutExpo",          // Anything other than "linear" or "swing" requires the easing plugin
			autoPlay: false,                   // This turns off the entire FUNCTIONALY, not just if it starts running or not.
			delay: 6000,                      // How long between slide transitions in AutoPlay mode
			startStopped: false,              // If autoPlay is on, this can force it to start stopped
			animationTime: 600,               // How long the slide transition takes
			hashTags: true,                   // Should links change the hashtag in the URL?
			buildNavigation: true,            // If true, builds and list of anchor links to link to each slide
			pauseOnHover: false,               // If true, and autoPlay is enabled, the show will pause on hover
			startText: "Play",                // Start text
			stopText: "Pause",                // Stop text
			navigationFormatter: formatText   // Details at the top of the file on this use (advanced use)
		});
		
		$("#slide-jump").click(function(){
			$('.anythingSlider').anythingSlider(5);
		});
		
	});
</script>

<script type="text/javascript">
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>

<script type="text/javascript">
function customMainNav(){
	//Main Navigation
	$("ul.mainNav").each(function(){
		var navWidth = $(this).width();
		//alert(navWidth);		
		var navListCount = $(this).children("li").length;
		var textWidth = 0;
		var totalLiPad = 2;
		
		$(this).children("li:first").addClass("first");
		$(this).children("li:last").addClass("last");
		
		$(this).children("li").each(function(){
			textWidth += $(this).children("a").width();
		});
		
		var oriPadding = parseInt((((navWidth - textWidth) - (totalLiPad*navListCount))/navListCount)/2);
		
		$(this).children("li").each(function(){
			textWidth += $(this).children("a").css("padding", "0px "+oriPadding+"px");
		});
		
	});
}

$(document).ready(function(){	
	//Main Navigation
	customMainNav();
	
});

$(window).resize(function() {	
	//Main Navigation
	customMainNav();
	
});
</script>
<!--New Slider-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/flexislider.js"></script>
<script type="text/javascript">
$(function(){
      //SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      }); 
	  
});
</script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<!--Top Panel Starts -->
<div class="topPanel">
	<div class="topPanelInner">
		<div class="row-fluid">
			<div class="span5">
				<a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
			</div>
			<div class="span7">
				<div class="email">
					<p><span>Email us:</span>
					<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a></p>
				</div>        
			</div>
		</div>
	</div>
</div>
<!--Top Panel Ends -->
<!--Nav Panel -->
<div class="navPanel">
	<div class="navPaneInner">
		<?php wp_nav_menu( array( 'menu_class' => 'mainNav', 'container_class' => 'mainNavContainer', 'theme_location' => 'primary' ) ); ?>
		<a class="btn loginBtn" href="http://50.57.186.147/?page_id=54">Login</a>
	</div>
</div>
<!--Nav Panel -->
