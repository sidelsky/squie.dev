<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>

		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />

		<link href="<?php echo get_template_directory_uri(); ?>/assets/build/img/favicon.png" rel="shortcut icon" />

		<?php wp_head(); ?>
	</head>

        <?php
            //$className = ( is_home() or is_front_page() or is_page( 'lost-password' ) ) ? 'gradient' : $pagename;
            $noscript = 'noscript';
        ?>
        <body <?php body_class( array($noscript) ); ?> id="top">

        <script type="text/javascript">
            // If JS is not loaded
            document.body.className = document.body.className.replace("noscript","");

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-28559223-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>

		<?php
			//Include SVG Sprite
			include('assets/build/svg-sprite.svg');
		?>


		<div class="page-wrap">

    		<header class="page-header" data-header >

                <!-- Logo -->
                <a href="<?php echo home_url(); ?>" class="page-header__href hide-on-mobile" data-logo >
                  <svg class="icon page-header__icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape-squie" viewBox="0 0 32 32"></use>
                  </svg>
                  <span class="page-header__dot" data-logo-dot ></span>
                </a>

                <!-- Info button -->
                <button class="info-button" data-info-button >
                  <svg class="icon info-button__info-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape-info" viewBox="0 0 32 32"></use>
                  </svg>
                </button>

                <div class="ani-color"></div>

    	</header>
