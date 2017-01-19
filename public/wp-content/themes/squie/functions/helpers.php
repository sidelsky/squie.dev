<?php
	//  _  _     _                 ___             _   _
	// | || |___| |_ __  ___ _ _  | __|  _ _ _  __| |_(_)___ _ _  ___
	// | __ / -_) | '_ \/ -_) '_| | _| || | ' \/ _|  _| / _ \ ' \(_-<
	// |_||_\___|_| .__/\___|_|   |_| \_,_|_||_\__|\__|_\___/_||_/__/
	//            |_|

	//Gets the URL of an image from a custom field
	function get_acf_image_url($fieldname, $imagesize = 'full', $postid = '') {

		 if ($postid == '') {
			 global $post;
			 $postid = $post->ID;
		 }

		 $image_id = get_post_meta($postid, $fieldname, true);
		 $image_array = wp_get_attachment_image_src($image_id, $imagesize);
		 return $image_array[0];

		}

		// Get the featured image URL for a given post
		function get_post_thumbnail_url($imagesize = 'full', $postid = '') {

		 if ($postid == '') {
			 global $post;
			 $postid = $post->ID;
		 }

		 $post_thumbnail_id = get_post_thumbnail_id($postid);
		 $image_array = wp_get_attachment_image_src($post_thumbnail_id, $imagesize);

		 return $image_array[0];

		 /*
		 	Usage:
		 	<div style="background-image: url(<?php echo get_acf_image_url('background_image', 'medium'); ?>);">
		 */

	}

	//Custom excerpts
	function get_excerpt($args) {

		 $defaults = array(
			 'length' => 50
			 , 'text' => ''
			 , 'permalink' => ''
			 , 'units' => 'letters'
			 , 'aftertext' => '&hellip;'
			 , 'moretext' => 'more'
		 );

		 $args = wp_parse_args( $args, $defaults );

		 if ($args['text'] != '') {
			 $excerpt = strip_tags($args['text']);
		 } else {
			 $excerpt = get_the_content();
		 }

		 $originalExcerptLength = strlen($excerpt);

		 if ($originalExcerptLength <= $args['length']) {
			 return $excerpt;
		 }

		 if ($args['units'] == 'letters' ) {
			 $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
			 $excerpt = strip_shortcodes($excerpt);
			 $excerpt = strip_tags($excerpt);
			 $excerpt = substr($excerpt, 0, $args['length']);
			 $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
			 $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));

		 } else if ($args['units'] == 'words') {
			 if (str_word_count($excerpt, 0) > $args['length']) {
				 $words = str_word_count($excerpt, 2);
				 $pos = array_keys($words);
				 $excerpt = substr($excerpt, 0, $pos[$args['length']]);
			 }
		 }

		 if ($originalExcerptLength > $args['length']) {

			 if ($args['permalink'] != '') {
				 $excerpt = $excerpt . $args['aftertext'] . ' <a href="' . $args['permalink'] . '">' . $args['moretext'] . '</a>';
			 } else {
				 $excerpt = $excerpt . $args['aftertext'];
			 }

		 }

		 return $excerpt;

	}
?>
