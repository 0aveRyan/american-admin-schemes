<?php
/**
 * Plugin Name: American Admin Schemes
 * Plugin URI: http://wordpress.org/plugins/usa-admin-schemes
 * Description: Six Color Schemes sourced from the official United States Web Design Standards and NASA brand guides.
 * Version: 1.0
 * Author: David Ryan
 * Author URI: http://twitter.com/dryanmedia
 * Text Domain: usadmin
 * Domain Path: /languages
 */

/*
Copyright 2016 David Ryan

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

class American_Admin_Schemes {

	/**
	 * List of colors registered in this plugin.
	 *
	 * @since 1.0
	 * @access private
	 * @var array $colors List of colors registered in this plugin.
	 * Needed for registering colors-fresh dependency.
	 */
	private $colors = array(
		'open-highway', 'shenandoah', 'old-glory', 'from-many-one',
		'nasa', 'nasa-1976'
	);

	function __construct() {
		add_action( 'admin_init' , array( $this, 'usa_color_schemes' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'save_schemes_into_option' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scheme_on_frontend' ) );
	}

	/**
	 * Register color schemes.
	 */
	function usa_color_schemes() {
	
		$suffix = is_rtl() ? '-rtl' : '';
		$debug  = (WP_DEBUG) ? '' : '.min';

		wp_admin_css_color(
			'open-highway', __( 'Open Highway', 'admin_schemes' ),
			plugins_url( "open-highway/colors$suffix$debug.css", __FILE__ ),
			array( '#212121', '#323a45', '#5b616b', '#fdb81e' ),
			array( 'base' => '#fad980', 'focus' => '#fdb81e', 'current' => '#fdb81e' )
		);

		wp_admin_css_color(
			'shenandoah', __( 'Shenandoah', 'admin_schemes' ),
			plugins_url( "shenandoah/colors$suffix$debug.css", __FILE__ ),
			array( '#212121', '#494440', '#2e8540', '#4aa564' ),
			array( 'base' => '#e4e5e7', 'focus' => '#212121', 'current' => '#212121' )
		);

		wp_admin_css_color(
			'old-glory', __( 'Old Glory', 'admin_schemes' ),
			plugins_url( "old-glory/colors$suffix$debug.css", __FILE__ ),
			array( '#112e51', '#205493', '#0071bc', '#cc2211' ),
			array( 'base' => '#e1f3f8', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'from-many-one', __( 'From Many One', 'admin_schemes' ),
			plugins_url( "from-many-one/colors$suffix$debug.css", __FILE__ ),
			array( '#212121', '#323a45', '#981b1e', '#9bdaf1' ),
			array( 'base' => '#f1f1f3', 'focus' => '#9bdaf1', 'current' => '#9bdaf1' )
		);

		wp_admin_css_color(
			'nasa', __( 'NASA', 'admin_schemes' ),
			plugins_url( "nasa/colors$suffix$debug.css", __FILE__ ),
			array( '#000', '#262626', '#0B3D91', '#FC3D21' ),
			array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'nasa-1976', __( 'NASA 1976', 'admin_schemes' ),
			plugins_url( "nasa-1976/colors$suffix$debug.css", __FILE__ ),
			array( '#0F1515', '#1e2a29', '#5D824B', '#a7b145' ),
			array( 'base' => '#f1f3f3', 'focus' => '#fff', 'current' => '#fff' )
		);

	}
	
	/**
	 * Save schemes to option allow front-end query
	 */
	function save_schemes_into_option() {
	  global $_wp_admin_css_colors;
	  
	  if( count( $_wp_admin_css_colors ) > 1 && has_action( 'admin_color_scheme_picker' ) )
	  	update_option( 'wp_admin_color_schemes', $_wp_admin_css_colors );
	}
	
	/**
	 * Load color schemes on front-end for logged-in users
	 */
	function load_scheme_on_frontend() {
		if( !is_admin_bar_showing() )
			return;
		
		$current_user_scheme = get_user_option( 'admin_color' );
		
		if( isset( $current_user_scheme ) ) {
			$all_registered_schemes = get_option( 'wp_admin_color_schemes' );
			wp_enqueue_style( $current_user_scheme, $all_registered_schemes[$current_user_scheme]->url );
		}
	}

}

global $usa_colors;
$usa_colors = new American_Admin_Schemes;
