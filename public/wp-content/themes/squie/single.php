<?php
	//If it's an event
	if (get_post_type() == "custom-post-type") {
	
		//Include the single event template
		//include (TEMPLATEPATH . '/single_event.php');
		
	} else {
		
		//Standard single
		include(TEMPLATEPATH . "/single_post.php");
		
	}
?>