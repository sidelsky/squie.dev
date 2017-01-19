<?php
  //  _   _ _   _ _ _ _   _
  // | | | | |_(_) (_) |_(_)___ ___
  // | |_| |  _| | | |  _| / -_|_-<
  //  \___/ \__|_|_|_|\__|_\___/__/
  //

  //Highlight custom post type parent as active item in Wordpress Navigation (https://gist.github.com/gerbenvandijk/5253921)
  add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );

  function add_current_nav_class($classes, $item) {

   //Getting the current post details
   global $post;

   // Get post ID, if nothing found set to NULL
   $id = ( isset( $post->ID ) ? get_the_ID() : NULL );

   // Checking if post ID exist...
   if (isset( $id )){
     // Getting the post type of the current post
     $current_post_type = get_post_type_object(get_post_type($post->ID));
     $current_post_type_slug = $current_post_type->rewrite['slug'];

     // Getting the URL of the menu item
     $menu_slug = strtolower(trim($item->url));

     // If the menu item URL contains the current post types slug add the current-menu-item class
     if (strpos($menu_slug,$current_post_type_slug) !== false) {

       $classes[] = 'current-menu-item';

     }
   }
   // Return the corrected set of classes to be added to the menu item
   return $classes;

  }

  //Change default Wordpres WYSIWYG editor
  // add_action('admin_init', 'my_theme_add_editor_styles');
  //
  // function my_theme_add_editor_styles() {
  //   add_editor_style('editor-style.css');
  // }
?>
