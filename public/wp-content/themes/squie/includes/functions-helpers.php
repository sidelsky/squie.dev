<?php // Various helper functions


// Gets the URL of an image from a custom field
function get_cf_image_url($fieldname, $imagesize = 'full', $postid){

	if($postid == ''){
		global $post;
		$postid = $post->ID;
	}

	$image_id = get_post_meta($postid, $fieldname, true);
	$image_array = wp_get_attachment_image_src($image_id, $imagesize);
	return $image_array[0];
}

// Get the featured image URL for a given post
function get_post_thumbnail_url($imagesize = 'full', $postid){

	if($postid == ''){
		global $post;
		$postid = $post->ID;
	}

	$post_thumbnail_id = get_post_thumbnail_id($postid);
	$image_array = wp_get_attachment_image_src($post_thumbnail_id, $imagesize);
	return $image_array[0];
}
