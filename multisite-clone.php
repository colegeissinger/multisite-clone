<?php
/**
 * Plugin Name: Multisite Clone
 * Plugin URI:  http://wordpress.org/plugins
 * Description: Simple WordPress Multisite Site clone tool
 * Version:     0.1.0
 * Author:      Cole Geissinger
 * Author URI:  http://www.colegeissinger.com
 * License:     GPLv2+
 * Text Domain: msc
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2015 Cole Geissinger (email : colegeissinger@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using yo wp-make:plugin
 * Copyright (c) 2015 10up, LLC
 * https://github.com/10up/generator-wp-make
 */

// Useful global constants
define( 'MSC_VERSION', '0.1.0' );
define( 'MSC_URL',     plugin_dir_url( __FILE__ ) );
define( 'MSC_PATH',    dirname( __FILE__ ) . '/' );
define( 'MSC_INC',     MSC_PATH . 'includes/' );

// Include files
require_once MSC_INC . 'core.php';
require_once MSC_INC . 'admin.php';


// Activation/Deactivation
register_activation_hook( __FILE__, '\CG\Multisite_Clone\Core\activate' );
register_deactivation_hook( __FILE__, '\CG\Multisite_Clone\Core\deactivate' );

// Bootstrap
CG\Multisite_Clone\Core\setup();
CG\Multisite_Clone\Admin\init();