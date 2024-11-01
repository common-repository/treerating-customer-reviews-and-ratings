<?php
	/**
	 * Plugin Name: Treerating
	 * Plugin URI: https://treerating.com/integrations/
	 * Description: Integration to Treerating that help you collect customer reviews.
	 * Version: 1.0.0
	 * Author: Treerating
	 * Author URI: https://treerating.com
	 * Requires at least: 4.3.1
	 * Tested up to: 4.3.1
	 *
	 * Text Domain: treerating
	 * Domain Path: /i18n/languages/
	 *
	 * @package WooCommerce
	 * @category Core
	 * @author Treerating
	 */
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );  // Prevent direct access to the plugin.
	class Treerating {
		public function __construct($includes=True) {
			$this->options = get_option('treerating_api');

			if($includes){
				$this->get_includes();
			}
		}

		public function get_includes() {
			include('treerating-admin.php');
			include('treerating-widget.php');
		}

		public function add_order($id_order) {
			$order = new WC_Order($id_order);

			$fields = array();
			$fields['username'] = $this->options['api_username'];
			$fields['apikey'] = $this->options['api_key'];
			$fields['first_name'] = $order->billing_first_name;
			$fields['last_name'] = $order->billing_last_name;
			$fields['email'] = $order->billing_email;
			$fields['order_id'] = $order->id;
			$fields['order_date'] = $order->order_date;

			// If we get a language on the site, set the language field.
			if(($language = get_bloginfo('language')) !== ""){
				// If language is over 2 characters, its a "en-US" format.
				// We don't want that. So explode it and only get first part.
				if(strlen($language) > 2) {
					$language = explode('-', $language);
					$language = $language[0];
				}
				
				$fields['language'] = $language;
			}

			// Do our POST call to the API.
			$result = $this->do_post_call('https://treerating.com/api/v1/create/', $fields);
		}

		public function get_rating() {
			$fields = array();
			$fields['username'] = $this->options['api_username'];
			$fields['apikey'] = $this->options['api_key'];
			$fields['get'] = 'rating_block';

			// If we get a language on the site, set the language field.
			if(($language = get_bloginfo('language')) !== ""){
				// If language is over 2 characters, its a "en-US" format.
				// We don't want that. So explode it and only get first part.
				if(strlen($language) > 2) {
					$language = explode('-', $language);
					$language = $language[0];
				}
				
				$fields['language'] = $language;
			}

			// Execute our POST call and get JSON response
			$result = $this->do_post_call('https://treerating.com/api/v1/read/', $fields);
			// Decode to be able to use the data in our template later.
			$result = json_decode($result, true);

			// If OK, means it was success. 
			if($result['status'] == 'OK') {
				return $result;
			}
			// If no OK in the result, return False
			else {
				return false;
			}
		}

		public function do_post_call($url, $fields) {
			//open connection
			try {
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Use instead of _POST because we want redirects to work, _POST will become GET on redirect.
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Force the curl call to follow any redirect
				curl_setopt($ch, CURLOPT_POSTREDIR, 3); // Include the POSTFIELDS if its either a 301 or a 302 redirect
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); 
				$result = curl_exec($ch);

				if($result == false) {
					throw new Exception(curl_error($ch), curl_errno($ch));
				}

				curl_close($ch);
			} catch(Exception $e) {
				error_log("Treerating Error: ".$e->getMessage());
				return false;
			}

			return $result;
		}

		public function enqueue_style() {
			wp_register_style('treerating_css', plugins_url('style.css', __FILE__));
			wp_enqueue_style('treerating_css');
		}
	}

	// Add actions outside of class.
	$treerating = new Treerating();
	add_action('woocommerce_order_status_completed', array($treerating, 'add_order'));
	add_action('wp_enqueue_scripts', array($treerating, 'enqueue_style'));
?>