<?php
	if(!function_exists('wp_head')) {

    function getWPContent() {
        // Gets all the Wordpress goodies.
        //file_exists('../../../../wp-load.php')
        define('WP_USE_THEMES', false);
        $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
        $wpLoad = require_once( $parse_uri[0] . 'wp-load.php' );
    }

        getWPContent();

        // Current post ID
        $postId = $_POST['id'];

		// Get Slug and pass to magic-door
		// $post = get_post($_POST['id']);
        //
		// global $post;
		// $post_slug = $post->post_name;
        //
		// // Convert PHP variable into one that can be accessed in jQuery
		// echo '<script>';
		// echo 'var post_slug = ' . json_encode($post_slug) . ';';
		// echo '</script>';

		//Query the database
        $args = array(
            'post_type' => 'portfolio',
            'p' => $postId,
            'posts_per_page' => 1
        );
        $loop = new WP_Query( $args );

	} ?>

    <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
        $do_not_duplicate = $post->ID;
    ?>

    <!--BEGIN #magic-door-wrap-->
    <div class="single-portfolio post-<?php the_ID(); ?>">

        <!--CLOSE Close button -->
        <?php include('partials/close.php'); ?>
        <!--CLOSE Close button -->

        <!--START: Portfolio post content -->
        <?php include('partials/portfolio-post-item-content.php'); ?>
        <!--END: Portfolio post content -->

        <!-- BEGIN #portfolio-nav -->
        <?php include('partials/prev-next-navigation.php'); ?>
        <!-- END #portfolio-nav -->

    <!--END #magic-door-wrap-->
    </div>
<?php endwhile; endif; ?>
