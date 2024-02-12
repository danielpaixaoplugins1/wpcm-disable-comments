<?php
/*
Plugin Name: WPCM Disable Comments
Plugin URI: https://centralmidia.net.br/
Description: This plugin disables comments on your WordPress site.
Author: Daniel Oliveira da Paixao
Author URI: https://example.com/
Version: 1.1
*/

/**
 * Disable comments on posts and pages.
 */
function disable_comments() {
    // Check if the current user can manage options
    if (!current_user_can('manage_options')) {
        return;
    }

    // Disable comments on posts if supported
    if (post_type_supports('post', 'comments')) {
        remove_post_type_support('post', 'comments');
        remove_post_type_support('post', 'trackbacks');
    }

    // Disable comments on pages if supported
    if (post_type_supports('page', 'comments')) {
        remove_post_type_support('page', 'comments');
        remove_post_type_support('page', 'trackbacks');
    }

    // Close comments on existing items
    update_option('default_comment_status', 'closed');
}

// Add the function to the 'init' hook to disable comments on site load
add_action('init', 'disable_comments');
