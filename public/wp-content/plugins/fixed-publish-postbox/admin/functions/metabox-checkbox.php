<?php


    /**
    * Adds checkbox
    */

    function ers_createCustomField()
    {
        $post_id = get_the_ID();

        $value = get_post_meta($post_id, '_my_custom_field', true);
        wp_nonce_field('my_custom_nonce_'.$post_id, 'my_custom_nonce');
        ?>
        <div class="misc-pub-section misc-pub-section-last" id="fpp-check">
            <label class="fpp__switch"><input class="fpp__checkbox" type="checkbox" value="1" <?php checked($value, true, true); ?> name="_my_custom_field" /><div class="fpp__slider"></div><span class="fpp__label"></span></label>
        </div>
        <?php
    }
    add_action('post_submitbox_misc_actions', 'ers_createCustomField');


    /**
    * Saves to databse
    */
    function ers_saveCustomField($post_id)
   {
       if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
           return;
       }

       if (!isset($_POST['my_custom_nonce']) || !wp_verify_nonce($_POST['my_custom_nonce'], 'my_custom_nonce_'.$post_id)) {
           return;
       }

       if (!current_user_can('edit_post', $post_id)) {
           return;
       }

       if (isset($_POST['_my_custom_field'])) {
           update_post_meta($post_id, '_my_custom_field', $_POST['_my_custom_field']);
       } else {
           delete_post_meta($post_id, '_my_custom_field');
       }

   }
    add_action('save_post', 'ers_saveCustomField');

?>
