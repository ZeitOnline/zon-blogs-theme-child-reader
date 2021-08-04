<?php

/**
 * Add themes stylesheet
 *
 */
function theme_enqueue_styles() {
	wp_enqueue_style(
		'zon-blogs-leserbriefe',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'zon-blogs-style' ),
		@filemtime( get_stylesheet_directory() . '/style.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function zb_topbar_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'TopSideBar', 'zb' ),
		'id'            => 'sidebar-top',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zb_topbar_widgets_init' );


function zb_search_excerpt_highlight() {
	$excerpt = get_the_content();
	$keys = implode('|', explode(' ', get_search_query()));
	$excerpt = preg_replace('/(' . $keys .')/iu', '<mark class="search-highlight">\0</mark>', $excerpt);
	echo $excerpt;
}

function zb_recentposts_dropdown() {
	$string .= '<select id="postcat" name="postcat" class="postform">
				<option value="" selected>Ausgabe wählen<option>';

	$args = array( 'numberposts' => '12', 'post_status' => 'publish' );

	$recent_posts = wp_get_recent_posts($args);
    foreach( $recent_posts as $recent ){
        $string .= '<option value="' . get_permalink($recent["ID"]) . '">'. $recent["post_title"] .'</option> ';
    }
	$string .= "</select><span class=\"cat-icon-helper\">&nbsp;</span>
				<script>
					document.getElementById( 'postcat' ).addEventListener('change', function( event ) {
						window.location.href=event.target.options[ event.target.selectedIndex ].value
					});
				</script>";
	return $string;
}
add_shortcode('zb_dropdown', 'zb_recentposts_dropdown');
add_filter('widget_text','do_shortcode');
