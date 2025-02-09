<?php
/**
 Plugin Name: Classic Editor And Classic Widgets Enabler
Description: The Classic Editor And Classic Widget Enabler plugin is used for eabling classic editor and widgets by the same plugin.
Version: 1.0
Author: Vaibhav Gangrade
Author URI: 
Stable Version: 1.0
Tested Up To: 6.6
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Short Description: A plugin that eanbles classic editor and classic widgets by a same plugin.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enable Classic Widgets
function enable_classic_widgets() {
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'enable_classic_widgets');

// Force Classic Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Ensure Classic Editor is used for post types
function enable_classic_editor() {
    remove_filter('the_content', 'wpautop');
}
add_action('init', 'enable_classic_editor');

// Ensure Classic Widgets Plugin is enforced
function enforce_classic_widgets_plugin() {
    if (!is_plugin_active('classic-widgets/classic-widgets.php')) {
        activate_plugin('classic-widgets/classic-widgets.php');
    }
}
add_action('admin_init', 'enforce_classic_widgets_plugin');

// Ensure Classic Editor Plugin is enforced
function enforce_classic_editor_plugin() {
    if (!is_plugin_active('classic-editor/classic-editor.php')) {
        activate_plugin('classic-editor/classic-editor.php');
    }
}
add_action('admin_init', 'enforce_classic_editor_plugin');
