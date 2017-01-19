<?php
  //  ___                        __      __          _                      ___       __           _ _
  // | _ \___ _ __  _____ _____  \ \    / /__ _ _ __| |_ __ _ _ ___ ______ |   \ ___ / _|__ _ _  _| | |_ ___
  // |   / -_) '  \/ _ \ V / -_)  \ \/\/ / _ \ '_/ _` | '_ \ '_/ -_|_-<_-< | |) / -_)  _/ _` | || | |  _(_-<
  // |_|_\___|_|_|_\___/\_/\___|   \_/\_/\___/_| \__,_| .__/_| \___/__/__/ |___/\___|_| \__,_|\_,_|_|\__/__/
  //                                    |_|

  //Remove width and height dynamic attributes to thumbnails
  add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
  //Remove width and height dynamic attributes to post images
  add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

  //Remove emojis
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );

  //Additional removals
  remove_action( 'wp_head', 'rest_output_link_wp_head' );
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
  remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
  remove_action ('wp_head', 'rsd_link');
  remove_action( 'wp_head', 'wlwmanifest_link');

  //Remove excerpt auto <p> tags
  remove_filter( 'the_excerpt', 'wpautop' );

  //Remove dashboard widgets
  add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
  remove_action( 'welcome_panel', 'wp_welcome_panel' );

  //Remove menu items
  add_action( 'admin_menu', 'remove_menus' );

  // Deregister footer scripts
  function deregister_footer_scripts() {
    wp_deregister_script( 'wp-embed' );
  }

  add_action( 'wp_footer', 'deregister_footer_scripts' );


  //Function to remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
  function remove_thumbnail_dimensions($html) {

    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;

  }

  //Remove default Wordpress widgets
  function remove_dashboard_widgets() {

    global $wp_meta_boxes;
  	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
  	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

  }

  //Cleanup admin menu
  function remove_menus() {

    //Comments menu
    remove_menu_page( 'edit-comments.php' );

  }

?>
