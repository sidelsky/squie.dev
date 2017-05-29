<?php

    /**
    * Show post ID in Publish meta
    */

    function ers_ShowPostId() {

        /**
        * Checks options if 'Show Post, Page or Cutom Post Type ID' is check
        */
        $options = get_option( 'fpp_settings' );
        if(isset($options['fpp_checkbox_field_0']) && (1 == $options['fpp_checkbox_field_0'])) {

            $post_id = get_the_ID();

            echo '<div class="misc-pub-section misc-pub-section-last fpp-post-id" id="fpp-post-id">' . 'ID:' . ' ' . '<strong>' . $post_id . '</strong>' . '</div>';
        }

    }
    add_action('post_submitbox_misc_actions', 'ers_ShowPostId');


?>
