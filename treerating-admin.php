<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );  // Prevent direct access to the plugin.
	add_action('admin_menu', 'treerating_menu');

	function register_settings() {
		register_setting('treerating-settings', 'treerating_api');
		add_settings_section(
			'api_creds', 
			'API Credentials', 
			'print_section_info', 
			'treerating'
		);
		add_settings_field(
			'api_username', 
			'API Username', 
			'api_username_callback', 
			'treerating', 
			'api_creds'
		);
		add_settings_field(
			'api_key', 
			'API Key', 
			'api_key_callback', 
			'treerating', 
			'api_creds'
		);
		//register_setting('treerating-settings', 'api_key');
	}

	function print_section_info() {
		print "API Credentials Information";
	}

	function api_username_callback() {
		$options = get_option('treerating_api');
		printf(
			'<input type="text" id="api_username" name="treerating_api[api_username]" value="%s" placeholder="API Username" />',
			isset( $options['api_username'] ) ? esc_attr( $options['api_username']) : ''
		);
	}

	function api_key_callback() {
		$options = get_option('treerating_api');
		printf(
			'<input type="text" id="api_key" name="treerating_api[api_key]" value="%s" placeholder="API Key" />',
			isset( $options['api_key'] ) ? esc_attr( $options['api_key']) : ''
		);
	}

	function treerating_menu() {
		
		add_options_page(
			'Treerating Options', 
			'Treerating', 
			'manage_options', 
			'treerating', 
			'treerating_options'
		);
		add_action('admin_init', 'register_settings');
		
	}

	function treerating_options() {
		// Check permissions, die if permissions not met.
		if (!current_user_can( 'manage_options' ))  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		// Handle POST requests
		if($_POST['action'] == 'treerating_admin_save'){
			treerating_admin_save();
		}

		// Load the admin template
		load_template(dirname(__FILE__).'/templates/admin-form.php');
	}
?>	
