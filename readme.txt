=== Treerating Customer Reviews and Ratings ===
Contributors: marcuslind90
Tags: treerating, reviews, rating, woocommerce
Requires at least: 4.3.1
Tested up to: 4.3.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin to integrate with Treerating's services that offer customer reviews and ratings for Woocommerce.

== Description ==

<a href="https://treerating.com/" target="_blank">Treerating</a> is a customer review and rating service for ecommerce businesses that wants to automatically collect reviews from their customers.

This is an integration between Wordpress WooCommerce and Treerating services that automatically sends new customer's data to Treerating's API. The module also offers a Widget in the Appearance -> Widget section where you can present your aggregated rating from Treerating in your sidebar on your own website.

The plugin's widget is using proper Rich Snippets following Schema.org standards, which allows Google to collect your rating and present it in the SERP (Search Engine Result Page), which has been proven to improve click through rates by magnitudes.

A few notes:
* This plugin is made for WooCommerce. It uses WooCommerce hooks to send the customer's data to the API when an order status is set to "Completed".
* This plugin requires API Credentials from <a href="https://treerating.com/" target="_blank">Treerating</a>. Registration is free and includes a free 30 day trial.
* The plugin does not automatically add the widget to your sidebar. If you want to use the widget to present your rating on your website, you have to go to your Appearance tab and add it in your Widgets by yourself.

== Installation ==

The installation is very simple and very little configuration is required.

1. Use Wordpress "Add New" functionality in the Plugins-tab to search and install the plugin, or to use the "Upload Plugin" button to upload the plugin's .zip file to your server.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to Settings -> Treerating to find the plugin's settings.
4. Add your API Username and API Key (Acquired from <a href="https://treerating.com/" target="_blank">Treerating</a>) and save your settings. The plugin is now working.
5. (Optional) Go to Appearance -> Widgets and drag-and-drop the Treerating widget to your sidebar to present your aggregated rating to your visitors on your website. This is required for Google to be able to display your rating in the SERP (Search Engine Result Page).