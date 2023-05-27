# Clrm-WooCommerce-Birthday-Discount
=== clrm WooCommerce Birthday Discount ===
Contributors: cuelli luca
Tags: ecommerce, e-commerce, commerce, woocommerce, shop, virtual shop, WooCommerce enhancements, discount, birthday, email
Requires at least: 4.5
Tested up to: 5.7
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin sends a birthday email to customers with a discount code.

== Description ==

This WooCommerce plugin helps you to create a more personal relationship with your customers. The plugin will automatically send an email to your customers on their birthday with a discount code. This code will be valid for a single order with a discount of 15%.

== Installation ==

1. Upload `woocommerce-birthday-discount.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Make sure you have a birthday field during registration or checkout
4. Test the plugin to ensure it works as expected

== Frequently Asked Questions ==

= How is the birthday information collected? =

You should have a birthday field during registration or checkout. The plugin assumes that the birthday is stored as user meta with the key 'birthday'.

= How is the discount code generated? =

The discount code is generated using the user ID and the current date. It starts with 'BDAY', followed by the user ID, an underscore, and the current date in 'Ymd' format.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
* Initial release.
