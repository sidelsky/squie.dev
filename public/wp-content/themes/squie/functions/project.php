<?php
  //  ___          _        _
  // | _ \_ _ ___ (_)___ __| |_
  // |  _/ '_/ _ \| / -_) _|  _|
  // |_| |_| \___// \___\__|\__|
  //            |__/

  //Theme support
  if (function_exists('add_theme_support')) {

    //Menus
    add_theme_support('menus');

    //Custom thumbnails
    add_theme_support('post-thumbnails');
    //Custom image sizes
    //add_image_size('medium-cropped', 900, 500, true);

  }

  //ACF Options page
  if( function_exists('acf_add_options_page') ) {

      acf_add_options_page(array(
          'page_title'     => 'General Settings',
          'menu_title'    => 'Settings',
          'menu_slug'     => 'theme-general-settings',
          'capability'    => 'edit_posts',
          'redirect'        => false
      ));

      acf_add_options_sub_page(array(
          'page_title'     => 'Header Settings',
          'menu_title'    => 'Header',
          'parent_slug'    => 'theme-general-settings',
      ));

      acf_add_options_sub_page(array(
          'page_title'     => 'Footer Settings',
          'menu_title'    => 'Footer',
          'parent_slug'    => 'theme-general-settings',
      ));

  }

  // Allow the custom login URL to work with the Google Apps Login plugin
  function my_gal_login_url($login_url) {

     return home_url() . '/manage';

  }

  add_filter('gal_login_url', 'my_gal_login_url', 10, 1);


?>
