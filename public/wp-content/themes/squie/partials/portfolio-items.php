<ul class="portfolio__list" id="portfolio-items" data-portfolio-items >
  <?php

        // Portfolio args
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'DEC'
        );

        // WP Query
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();

        // do not duplicate post
        if( is_singular('portfolio') ) {
            //if ( $post->ID == $do_not_duplicate ) continue;
        }


        // Get custom fields for images large & small
        // Sizes
        $thumbnail = 'thumbnail';
        $medium = 'medium';
        $medium_large = 'medium_large';
        $large = 'large';
        $image_desktop = get_field('image_large');
        $image_desktop_thumbnail = $image_desktop['sizes'][ $thumbnail ];
        $image_desktop_medium = $image_desktop['sizes'][ $medium ];
        $image_desktop_medium_large = $image_desktop['sizes'][ $medium_large ];
        $image_desktop_large = $image_desktop['sizes'][ $large ];
        // Mobile image
        $image_mobile = get_field('image_small');
        $image_mobile_thumbnail = $image_mobile['sizes'][ $thumbnail ];
        $image_mobile_medium = $image_mobile['sizes'][ $medium ];
        $image_mobile_medium_large = $image_mobile['sizes'][ $medium_large ];
        $image_mobile_large = $image_mobile['sizes'][ $large ];
        // Alt tag
        $alt = $image_desktop['alt'];
        // Project color
        $color = get_field('color');
        // Get ID
        $post_id = get_the_ID();
        // echo '<pre>';
        // var_dump( $image_desktop );
        // echo '</pre>';
    ?>

    <?php
        //Get the terms
        $terms = get_the_terms( $post->ID, 'project_type' );
        if ( $terms && ! is_wp_error( $terms ) ) :

        $links = array();

        foreach ( $terms as $term ) {
            $links[] = $term->name;
        }

        $tax_links = join( " ", str_replace(' ', '-', $links));
        $tax = strtolower($tax_links);
        else :
            $tax = '';
        endif;

        echo '<li id="portfolio-'.$post_id.'" class="portfolio__item visible mix '. $tax .'" data-portfolio-item >';
    ?>



    <!-- START: Spin loader -->
    <?php include('spinloader.php'); ?>
    <!-- END: Spin loader -->

    <!-- START: Show that this elem is active -->
    <div class="portfolio__item--active" style="background-color: <?php echo $color; ?>"></div>
    <!-- END: Show that this elem is active -->

            <a href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" class="portfolio__link" data-post-link style="color: <?php echo $color; ?>">
                <figure>
                    <img src="<?php echo $image_desktop['url']; ?>"
                         class="portfolio__image"
                         srcset="<?php echo $image_desktop['url']; ?> 2560w,
                                 <?php echo $image_mobile_large; ?> 1024w,
                                 <?php echo $image_mobile_medium_large; ?> 768w,
                                 <?php echo $image_mobile_medium; ?> 300w"
                         sizes="100vw"
                         alt="<?php echo $alt; ?>" />
                </figure>
            </a>
    </li>

  <?php endwhile; ?>

</ul>
