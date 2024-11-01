<div class="wrap">
	<h2>Treerating Settings</h2>
	<div class="notice"><?php echo __("Before you can use this plugin, you need to get API Credentials from"); ?> <a href="https://treerating.com" target="_blank">Treerating</a>.</div>
	<form method="post" action="options.php">
		<?php settings_fields('treerating-settings'); ?>
		<?php do_settings_sections('treerating'); ?>
		<?php submit_button(); ?>
	</form>
</div>