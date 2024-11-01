<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );  // Prevent direct access to the plugin.

	class TreeratingWidget extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'treerating_widget', 
				__('Display Treerating Rating', 'treerating'),
				array(
					'description' => __( 'Widget used to display your rating at Treerating.', 'treerating' )
				)
			);
		}
		public function widget($args, $instance) {
			$treerating = new Treerating(false);
			// Get all the rating information about the user
			$rating = $treerating->get_rating();

			// We include it instead of using load_template to keep all
			// the variables in the context of the HTML.
			include(dirname(__FILE__).'/templates/widget.php');
			
			//load_template(dirname(__FILE__).'/templates/widget.php');
		}
	}

	function register_treerating_widget() {
		register_widget('TreeratingWidget');
	}

	add_action('widgets_init', 'register_treerating_widget');
?>