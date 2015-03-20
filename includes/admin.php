<?php

namespace CG\Multisite_Clone\Admin;

/**
 * Initialize our actions and filters
 */
function init() {
	add_filter( 'manage_sites_action_links', __NAMESPACE__ . '\list_table_actions', 10, 3 );
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
	// Add our Clone button
	$actions['clone'] = sprintf(
		'<span class="clone"><a href="%s">%s</a></span>',
		esc_url( network_admin_url() ),
		esc_html__( 'Clone', 'msc' )
	);

	return $actions;
}