<?php

namespace CG\Multisite_Clone\Admin;

/**
 * Initialize our actions and filters
 */
function init() {
	add_action( 'network_admin_menu', __NAMESPACE__ . '\admin_page' );

	add_filter( 'manage_sites_action_links', __NAMESPACE__ . '\list_table_actions', 10, 3 );
}

/**
 * Adds our settings page to the Network Admin
 *
 * @return void
 */
function admin_page() {
	add_submenu_page(
		'settings.php',
		esc_html_x( 'Multisite Clone', 'Admin Page Title', 'msc' ),
		esc_html_x( 'Multisite Clone', 'Admin Menu Title', 'msc' ),
		'manage_sites',
		'multisite-clone',
		__NAMESPACE__ . '\admin_page_container'
	);
}

/**
 * Filters 'manage_sites_action_links' in the Network admin's Site settings screen.
 *
 * @param array  $actions  An array of action links to be displayed.
 * @param int    $blog_id  The site ID.
 * @param string $blogname Site path, formatted depending on whether it is a sub-domain
 *                         or subdirectory multisite install.
 *
 * @return mixed
 */
function list_table_actions( $actions, $blog_id, $blogname ) {
	// Double check that a user has the right privileges.
	if ( current_user_can( 'manage_sites' ) ) {
		$actions['clone'] = sprintf(
			'<span class="clone"><a href="%s">%s</a></span>',
			esc_url( network_admin_url( 'settings.php?page=multisite-clone&amp;action=clone&amp;site=' . absint( $blog_id ) ) ),
			esc_html__( 'Clone', 'msc' )
		);
	}

	return $actions;
}

/**
 * The main container for the Network admin settings page.
 */
function admin_page_container() {
	echo 'YO';
}