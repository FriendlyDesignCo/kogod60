<?php
add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup() {
	load_theme_textdomain('blankslate', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
	);
}
add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
function blankslate_load_scripts() {
	wp_enqueue_script('jquery');
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script() {
	if (get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title) {
	if ($title == '') {
		return '&rarr;';
	} else {
		return $title;
	}
}
add_filter('wp_title', 'blankslate_filter_wp_title');
function blankslate_filter_wp_title($title) {
	return $title . esc_attr(get_bloginfo('name'));
}
add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init() {
	register_sidebar( array (
		'name' => __('Sidebar Widget Area', 'blankslate'),
	'id' => 'primary-widget-area',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
}
function blankslate_custom_pings($comment) {
	$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter('get_comments_number', 'blankslate_comments_number');
function blankslate_comments_number($count) {
	if (!is_admin()) {
	global $id;
	$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
	return count($comments_by_type['comment']);
} else {
	return $count;
}
}

//
//	CUSTOM POSTS
//

//	TIMELINE EVENTS
add_action('init', 'timeline_events_custom_post'); // Add our HTML5 Blank Custom Post Type
function timeline_events_custom_post()
{
	register_taxonomy_for_object_type('category', 'timeline-events'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'timeline-events');
	register_post_type('timeline-events', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Timeline Events', 'timeline_events'), // Rename these to suit
			'singular_name' => __('Timeline Events', 'timeline_events'),
			'add_new' => __('Add New Event', 'timeline_events'),
			'add_new_item' => __('Add New Event', 'timeline_events'),
			'edit' => __('Edit', 'timeline_events'),
			'edit_item' => __('Edit Event', 'timeline_events'),
			'new_item' => __('New Event', 'timeline_events'),
			'view' => __('View Event', 'timeline_events'),
			'view_item' => __('View Event', 'timeline_events'),
			'search_items' => __('Search Events', 'timeline_events'),
			'not_found' => __('No events found', 'timeline_events'),
			'not_found_in_trash' => __('No events found in Trash', 'timeline_events')
		),
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'excerpt',
			'revisions',
			'comments',
		), // Go to Dashboard Custom HTML5 Blank post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
 			'post_tag',
 			'category'
 		) // Add Category and Post Tags support
	));
	// flush_rewrite_rules();
}	

//	60TH ANNIVERSARY EVENTS
add_action('init', 'anniversary_events_custom_post'); // Add our HTML5 Blank Custom Post Type
function anniversary_events_custom_post()
{
	register_taxonomy_for_object_type('category', 'anniversary-events'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'anniversary-events');
	register_post_type('anniversary-events', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Anniversary Events', 'anniversary_events'), // Rename these to suit
			'singular_name' => __('Anniversary Events', 'anniversary_events'),
			'add_new' => __('Add New Event', 'anniversary_events'),
			'add_new_item' => __('Add New Event', 'anniversary_events'),
			'edit' => __('Edit', 'anniversary_events'),
			'edit_item' => __('Edit Event', 'anniversary_events'),
			'new_item' => __('New Event', 'anniversary_events'),
			'view' => __('View Event', 'anniversary_events'),
			'view_item' => __('View Event', 'anniversary_events'),
			'search_items' => __('Search Events', 'anniversary_events'),
			'not_found' => __('No events found', 'anniversary_events'),
			'not_found_in_trash' => __('No events found in Trash', 'anniversary_events')
		),
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'excerpt',
			'revisions',
			'comments',
		), // Go to Dashboard Custom HTML5 Blank post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
 			'post_tag',
 			'category'
 		) // Add Category and Post Tags support
	));
	// flush_rewrite_rules();
}	

//	SIGNATURE EVENTS
add_action('init', 'signature_events_custom_post'); // Add our HTML5 Blank Custom Post Type
function signature_events_custom_post()
{
	register_taxonomy_for_object_type('category', 'signature-events'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'signature-events');
	register_post_type('signature-events', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Signature Events', 'signature_events'), // Rename these to suit
			'singular_name' => __('Signature Events', 'signature_events'),
			'add_new' => __('Add New Event', 'signature_events'),
			'add_new_item' => __('Add New Event', 'signature_events'),
			'edit' => __('Edit', 'signature_events'),
			'edit_item' => __('Edit Event', 'signature_events'),
			'new_item' => __('New Event', 'signature_events'),
			'view' => __('View Event', 'signature_events'),
			'view_item' => __('View Event', 'signature_events'),
			'search_items' => __('Search Events', 'signature_events'),
			'not_found' => __('No events found', 'signature_events'),
			'not_found_in_trash' => __('No events found in Trash', 'signature_events')
		),
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'excerpt',
			'revisions',
			'comments',
		), // Go to Dashboard Custom HTML5 Blank post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
 			'post_tag',
 			'category'
 		) // Add Category and Post Tags support
	));
	// flush_rewrite_rules();
}	